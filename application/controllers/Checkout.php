<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AlamatModel');
        $this->load->model('Checkout_model');
        $this->load->model('Promo_model'); // TAMBAHAN: Load promo model
        $this->load->library('session');

        // Pastikan user sudah login
        if (!$this->session->userdata('id_customer')) {
            redirect('login');
        }
    }

    public function index()
    {
        $id_customer = $this->session->userdata('id_customer');

        // ========== ALAMAT ==========
        // Ambil alamat yang dipilih untuk checkout (dari session)
        // Kalau belum pilih, pakai alamat default
        $id_alamat_checkout = $this->session->userdata('id_alamat_checkout');

        if ($id_alamat_checkout) {
            $alamat_checkout = $this->AlamatModel->getByIdWithNames($id_alamat_checkout);
        } else {
            $alamat_checkout = $this->AlamatModel->getDefaultAddressWithNames($id_customer);
        }

        // Ambil semua alamat untuk modal
        $alamat_list = $this->AlamatModel->getAlamatWithNames($id_customer);

        // Set flag jika tidak ada alamat
        $has_no_address = empty($alamat_list);

        // ========== CART ITEMS (CRITICAL!) ==========
        // Ambil cart items customer yang login (SEMUA, ga peduli checklist)
        $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);
        
        // Hitung summary (total, diskon, dll)
        $summary = $this->Checkout_model->calculate_summary($checkout_items);

        // ========== NAVBAR CART ==========
        // Ambil SEMUA cart items untuk navbar (ga peduli checklist)
        $this->load->model('Keranjang_model');
        $all_cart_items = $this->Keranjang_model->get_by_customer($id_customer);

        // ========== PREPARE DATA ==========
        $data = [
            'alamat_checkout' => $alamat_checkout,
            'alamat_list' => $alamat_list,
            'has_no_address' => $has_no_address,
            'checkout_items' => $checkout_items,        // PENTING: Untuk halaman checkout
            'summary' => $summary,                       // PENTING: Untuk ringkasan
            'checkout_model' => $this->Checkout_model,   // PENTING: Untuk helper functions
            'cart_items' => $all_cart_items              // Untuk navbar
        ];

        $data['contents'] = $this->load->view('checkout', $data, TRUE);
        $this->load->view('navbar', array_merge($this->global_data, $data));
    }

    /**
     * Set alamat untuk checkout (hanya session, tidak ubah database)
     */
    public function set_alamat()
    {
        $id_alamat = $this->input->post('id_alamat');
        $id_customer = $this->session->userdata('id_customer');

        // Validasi input
        if (empty($id_alamat)) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'ID alamat tidak valid'
            ]);
            return;
        }

        // Cek apakah alamat milik customer ini
        $alamat = $this->AlamatModel->getById($id_alamat);
        if (!$alamat || $alamat->id_customer != $id_customer) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Alamat tidak ditemukan'
            ]);
            return;
        }

        // TIDAK UBAH DATABASE, hanya simpan di session
        $this->session->set_userdata('id_alamat_checkout', $id_alamat);

        // Ambil data alamat lengkap untuk dikirim ke frontend
        $alamat_baru = $this->AlamatModel->getByIdWithNames($id_alamat);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'ok',
            'message' => 'Alamat pengiriman dipilih',
            'alamat' => $alamat_baru
        ]);
    }

    /**
     * Proses checkout (contoh)
     */
    public function process()
    {
        $id_customer = $this->session->userdata('id_customer');

        // Ambil alamat yang dipilih
        $id_alamat_checkout = $this->session->userdata('id_alamat_checkout');
        if (!$id_alamat_checkout) {
            // Jika belum pilih, pakai default
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

        // Ambil data dari POST
        $catatan = $this->input->post('catatan');
        $total = $this->input->post('total');

        // Proses checkout (sesuaikan dengan logic Anda)
        // Contoh: simpan order, kurangi stok, dll

        // Hapus session alamat checkout setelah berhasil order
        $this->session->unset_userdata('id_alamat_checkout');

        echo json_encode([
            'status' => 'ok',
            'message' => 'Checkout berhasil',
            'order_id' => 'ORD-' . time()
        ]);
    }

    /**
     * TAMBAHAN: Get promo aktif (untuk frontend)
     */
    public function get_promos()
    {
        header('Content-Type: application/json');

        $jenis = $this->input->get('jenis'); // 'item' atau 'ongkir'

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

    /**
     * TAMBAHAN: Validate & apply promo code
     */
    public function apply_promo()
    {
        header('Content-Type: application/json');

        $kode_promo = $this->input->post('kode_promo');
        $jenis = $this->input->post('jenis'); // 'item' atau 'ongkir'
        $total_belanja = (int) $this->input->post('total_belanja');

        // Validasi input
        if (!$kode_promo || !$jenis) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap'
            ]);
            return;
        }

        // Validate promo
        $result = $this->Promo_model->validate_promo($kode_promo, $jenis, $total_belanja);

        echo json_encode($result);
    }
}