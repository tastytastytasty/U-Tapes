<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AlamatModel');
        $this->load->library('session');
        
        // Pastikan user sudah login
        if (!$this->session->userdata('id_customer')) {
            redirect('login');
        }
    }

    public function index()
    {
        $id_customer = $this->session->userdata('id_customer');

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

        // Jika tidak ada alamat sama sekali, redirect ke halaman tambah alamat
        if (empty($alamat_list)) {
            $this->session->set_flashdata('warning', 'Silakan tambahkan alamat pengiriman terlebih dahulu');
            redirect('profile/alamat');
        }

        $data = [
            'alamat_checkout' => $alamat_checkout,
            'alamat_list' => $alamat_list
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
}