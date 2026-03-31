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

        if (!$alamat_checkout) {
            $all_alamat = $this->AlamatModel->getAlamatWithNames($id_customer);
            if (!empty($all_alamat)) {
                $alamat_checkout = $all_alamat[0];
            }
        }

        $alamat_list = $this->AlamatModel->getAlamatWithNames($id_customer);
        $has_no_address = empty($alamat_list);

        // ========== CART ITEMS ==========
        $direct = $this->session->userdata('direct_checkout');

        if ($direct) {
            $this->session->unset_userdata('direct_checkout');
            $checkout_items = $this->Checkout_model->get_direct_item(
                $direct['id_item_detail'],
                $direct['qty']
            );

            $this->session->set_userdata('_direct_checkout_data', [
                'id_item_detail' => $direct['id_item_detail'],
                'qty' => $direct['qty'],
            ]);
        } else {
            $this->session->unset_userdata('_direct_checkout_data');
            $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);
        }

        $summary = $this->Checkout_model->calculate_summary($checkout_items);

        // ========== REKENING LIST ==========
        $rekening_list = $this->db
            ->select('id_rekening, bank, nomor_rekening, atas_nama, gambar, status')
            ->where('status', 'active')
            ->get('rekening')
            ->result();

        // ========== PROMO LOGIC ==========
        // ✅ Get cart item details
        $cart_item_details = array_column($checkout_items, 'id_item_detail');

        // ✅ Initialize promo variables
        $auto_promo_item = null;
        $auto_promo_ongkir = null;
        $voucher_items = [];
        $voucher_ongkir = [];

        // ✅ PROMO LOGIC: 
        // - kode_promo kosong/NULL → Tampilkan sebagai BADGE (voucher_items) untuk user lihat
        // - kode_promo ada/tidak kosong → JANGAN tampilkan badge (user input kode manual)
        try {
            // ✅ 1. GET NO-CODE PROMOS (kode_promo kosong/NULL) - untuk display sebagai BADGE di offcanvas
            // NAMA VARIABLE VOUCHER_ITEMS tapi berisi promo TANPA kode
            if (method_exists($this->Promo_model, 'get_auto_apply_promos')) {
                $auto_item_promos = $this->Promo_model->get_auto_apply_promos('item');
                $voucher_items = $auto_item_promos; // ✅ Display all auto-apply promos as cards
                
                $auto_ongkir_promos = $this->Promo_model->get_auto_apply_promos('ongkir');
                $voucher_ongkir = $auto_ongkir_promos; // ✅ Display all auto-apply promos as cards
            }

            // ✅ 2. AUTO-APPLY BEST ONE (choose best from no-code promos)
            // Ambil yang terbaik dari no-code promos untuk auto-apply
            $auto_promo_item = !empty($voucher_items) ? $voucher_items[0] : null;
            $auto_promo_ongkir = !empty($voucher_ongkir) ? $voucher_ongkir[0] : null;

        } catch (Exception $e) {
            log_message('error', 'Promo loading error: ' . $e->getMessage());
            // Keep empty arrays
            $voucher_items = [];
            $voucher_ongkir = [];
            $auto_promo_item = null;
            $auto_promo_ongkir = null;
        }

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
            'rekening_list' => $rekening_list,
            
            // ✅ PROMO VARIABLES (always defined, might be null/empty)
            'auto_promo_item' => $auto_promo_item,
            'auto_promo_ongkir' => $auto_promo_ongkir,
            'voucher_items' => $voucher_items,
            'voucher_ongkir' => $voucher_ongkir
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

        try {
            if (method_exists($this->Promo_model, 'get_voucher_cards')) {
                $id_customer = $this->session->userdata('id_customer');
                
                $direct = $this->session->userdata('_direct_checkout_data');
                if ($direct) {
                    $checkout_items = $this->Checkout_model->get_direct_item(
                        $direct['id_item_detail'],
                        $direct['qty']
                    );
                } else {
                    $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);
                }
                
                $cart_item_details = array_column($checkout_items, 'id_item_detail');
                $vouchers = $this->Promo_model->get_voucher_cards($jenis, $cart_item_details);
            } else {
                // Fallback to old method
                $vouchers = $this->Promo_model->get_active_promos($jenis);
            }

            echo json_encode([
                'success' => true,
                'data' => $vouchers
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error loading promos: ' . $e->getMessage()
            ]);
        }
    }

    public function apply_promo()
    {
        header('Content-Type: application/json');

        try {
            $kode_promo = $this->input->post('kode_promo');
            $jenis = $this->input->post('jenis');
            $total_belanja = (int) $this->input->post('total_belanja');
            $id_customer = $this->session->userdata('id_customer');

            if (!$kode_promo || !$jenis) {
                echo json_encode([
                    'valid' => false,
                    'message' => 'Data tidak lengkap'
                ]);
                return;
            }

            // Get cart items
            $direct = $this->session->userdata('_direct_checkout_data');
            if ($direct) {
                $checkout_items = $this->Checkout_model->get_direct_item(
                    $direct['id_item_detail'],
                    $direct['qty']
                );
            } else {
                $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);
            }
            
            $cart_item_details = array_column($checkout_items, 'id_item_detail');

            // Validate promo (with or without new validation)
            if (method_exists($this->Promo_model, 'validate_promo')) {
                // Check if validate_promo accepts 5 parameters (with id_customer)
                $reflection = new ReflectionMethod($this->Promo_model, 'validate_promo');
                $paramCount = $reflection->getNumberOfParameters();
                
                if ($paramCount >= 5) {
                    // NEW: With cart items validation AND user tracking
                    $result = $this->Promo_model->validate_promo(
                        $kode_promo, 
                        $jenis, 
                        $total_belanja,
                        $cart_item_details,
                        $id_customer // ✅ NEW: For usage tracking
                    );
                } elseif ($paramCount >= 4) {
                    // MEDIUM: With cart items validation
                    $result = $this->Promo_model->validate_promo(
                        $kode_promo, 
                        $jenis, 
                        $total_belanja,
                        $cart_item_details
                    );
                } else {
                    // OLD: Without cart items
                    $result = $this->Promo_model->validate_promo(
                        $kode_promo, 
                        $jenis, 
                        $total_belanja
                    );
                }
            } else {
                // Fallback: Basic validation
                $result = [
                    'valid' => false,
                    'message' => 'Promo validation not available'
                ];
            }

            echo json_encode($result);

        } catch (Exception $e) {
            echo json_encode([
                'valid' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
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

        // Simpan ke session sebagai direct checkout
        $this->session->set_userdata('direct_checkout', [
            'id_item_detail' => $id_item_detail,
            'qty' => $qty,
            'warna' => $warna,
            'ukuran' => $ukuran,
        ]);

        redirect('checkout');
    }
}