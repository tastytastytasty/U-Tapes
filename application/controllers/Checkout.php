<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AlamatModel');
        $this->load->model('Checkout_model');
        $this->load->model('Promo_model');
        $this->load->library('session');

        if (!$this->session->userdata('id_customer')) {
            if ($this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'valid' => false,
                    'message' => 'Silakan login terlebih dahulu',
                    'redirect' => site_url('login')
                ]);
                exit;
            }
            redirect('login');
        }
    }

    public function index()
    {
        $id_customer = $this->session->userdata('id_customer');

        // ========== ALAMAT ==========
        $id_alamat_checkout = $this->session->userdata('id_alamat_checkout');

        if ($id_alamat_checkout) {
            $alamat_checkout = $this->AlamatModel->getByIdWithNames($id_alamat_checkout);
        } else {
            $alamat_checkout = $this->AlamatModel->getDefaultAddressWithNames($id_customer);
        }

        // ✅ FIX: Kalau ga ada default, ambil alamat pertama
        if (!$alamat_checkout) {
            $all_alamat = $this->AlamatModel->getAlamatWithNames($id_customer);
            if (!empty($all_alamat)) {
                $alamat_checkout = $all_alamat[0];
            }
        }

        $alamat_list = $this->AlamatModel->getAlamatWithNames($id_customer);
        $has_no_address = empty($alamat_list);

        // ========== CART ITEMS ==========
        // ✅ FIX: Always ambil dari database (direct checkout sudah di-insert ke cart)
        $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);
        $summary = $this->Checkout_model->calculate_summary($checkout_items);

        // ========== REKENING LIST ==========
        // ✅ GET ALL REKENING from database
        $rekening_list = $this->db
            ->select('id_rekening, bank, nomor_rekening, atas_nama, gambar')
            ->get('rekening')
            ->result();

        // ========== NAVBAR CART ==========
        $this->load->model('Keranjang_model');
        $all_cart_items = $this->Keranjang_model->get_by_customer($id_customer);

        // ========== PREPARE DATA ==========
        $data = [
            'alamat_checkout' => $alamat_checkout,
            'alamat_list' => $alamat_list,
            'has_no_address' => $has_no_address,
            'checkout_items' => $checkout_items,
            'summary' => $summary,
            'checkout_model' => $this->Checkout_model,
            'cart_items' => $all_cart_items,
            'rekening_list' => $rekening_list  // ✅ Pass to view
        ];

        $data['contents'] = $this->load->view('checkout', $data, TRUE);
        $this->load->view('navbar', array_merge($this->global_data, $data));
    }

    public function set_alamat()
    {
        $id_alamat = $this->input->post('id_alamat');
        $id_customer = $this->session->userdata('id_customer');

        if (empty($id_alamat)) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'ID alamat tidak valid'
            ]);
            return;
        }

        $alamat = $this->AlamatModel->getById($id_alamat);
        if (!$alamat || $alamat->id_customer != $id_customer) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Alamat tidak ditemukan'
            ]);
            return;
        }

        $this->session->set_userdata('id_alamat_checkout', $id_alamat);
        $alamat_baru = $this->AlamatModel->getByIdWithNames($id_alamat);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'ok',
            'message' => 'Alamat pengiriman dipilih',
            'alamat' => $alamat_baru
        ]);
    }

    public function process()
    {
        $id_customer = $this->session->userdata('id_customer');
        $id_alamat_checkout = $this->session->userdata('id_alamat_checkout');

        if (!$id_alamat_checkout) {
            $alamat = $this->AlamatModel->getDefaultAddress($id_customer);
        } else {
            $alamat = $this->AlamatModel->getById($id_alamat_checkout);
        }

        if (!$alamat) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Silakan pilih alamat pengiriman'
            ]);
            return;
        }

        $catatan = $this->input->post('catatan');
        $total = $this->input->post('total');
        $this->session->unset_userdata('id_alamat_checkout');

        echo json_encode([
            'status' => 'ok',
            'message' => 'Checkout berhasil',
            'order_id' => 'ORD-' . time()
        ]);
    }

    public function get_promos()
    {
        header('Content-Type: application/json');
        $jenis = $this->input->get('jenis');

        if (!$jenis || !in_array($jenis, ['item', 'ongkir'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Jenis promo tidak valid'
            ]);
            return;
        }

        $promos = $this->Promo_model->get_active_promos($jenis);
        echo json_encode([
            'success' => true,
            'data' => $promos
        ]);
    }

    public function apply_promo()
    {
        header('Content-Type: application/json');

        try {
            $kode_promo = $this->input->post('kode_promo');
            $jenis = $this->input->post('jenis');
            $total_belanja = (int) $this->input->post('total_belanja');

            if (!$kode_promo || !$jenis) {
                echo json_encode([
                    'valid' => false,
                    'message' => 'Data tidak lengkap',
                    'debug' => [
                        'kode_promo' => $kode_promo,
                        'jenis' => $jenis,
                        'total_belanja' => $total_belanja
                    ]
                ]);
                return;
            }

            $result = $this->Promo_model->validate_promo($kode_promo, $jenis, $total_belanja);
            $result['debug_request'] = [
                'kode_promo' => strtoupper($kode_promo),
                'jenis' => $jenis,
                'total_belanja' => $total_belanja
            ];

            echo json_encode($result);

        } catch (Exception $e) {
            echo json_encode([
                'valid' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage(),
                'trace' => ENVIRONMENT === 'development' ? $e->getTraceAsString() : null
            ]);
        }
    }
    public function direct()
    {
        $id_customer = $this->session->userdata('id_customer');

        $id_item_detail = $this->input->post('id_item_detail');
        $qty = (int) $this->input->post('qty');
        $warna = $this->input->post('warna');
        $ukuran = $this->input->post('ukuran');

        if (!$id_item_detail || $qty <= 0) {
            redirect('produk');
            return;
        }

        // ✅ FIX: INSERT ke keranjang dengan checklist='Yes' (permanent di database)
        $this->load->model('Keranjang_model');
        
        // Cek apakah item sudah ada di keranjang
        $existing = $this->db
            ->where('id_customer', $id_customer)
            ->where('id_item_detail', $id_item_detail)
            ->get('cart')
            ->row();

        if ($existing) {
            // Update qty jika sudah ada
            $this->db->set('qty', $existing->qty + $qty);
            $this->db->where('id_cart', $existing->id_cart);
            $this->db->update('cart');
        } else {
            // ✅ GENERATE id_cart sebelum insert
            $id_cart = $this->generate_id_cart();
            
            // Insert baru dengan checklist='Yes'
            $this->db->insert('cart', [
                'id_cart' => $id_cart,  // ✅ TAMBAH id_cart
                'id_customer' => $id_customer,
                'id_item_detail' => $id_item_detail,
                'qty' => $qty,
                'checklist' => 'Yes'
            ]);
        }

        redirect('checkout');
    }

    // ✅ GENERATE UNIQUE id_cart
    private function generate_id_cart()
    {
        $prefix = 'CART-' . date('Ym') . '-';
        
        $last_cart = $this->db
            ->select('id_cart')
            ->from('cart')
            ->like('id_cart', $prefix, 'after')
            ->order_by('id_cart', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        if ($last_cart) {
            $last_number = intval(substr($last_cart->id_cart, -4));
            $new_number  = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return $prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }
}