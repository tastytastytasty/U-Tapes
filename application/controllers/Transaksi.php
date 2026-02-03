<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->library('session');
        
        // Pastikan user sudah login
        if (!$this->session->userdata('id_customer')) {
            redirect('login');
        }
    }

    /**
     * Simpan transaksi baru
     * Menerima data dari AJAX POST
     */
    public function simpan() {
        // Set header JSON
        header('Content-Type: application/json');

        try {
            // Ambil data dari POST
            $total = $this->input->post('total');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $bayar = $this->input->post('bayar');
            $kembali = $this->input->post('kembali');
            $ongkir = $this->input->post('ongkir');

            // Validasi data
            if (empty($total) || empty($metode_pembayaran)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
                return;
            }

            // Validasi metode pembayaran
            $valid_methods = ['Tunai', 'E-wallet', 'Rekening'];
            if (!in_array($metode_pembayaran, $valid_methods)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Metode pembayaran tidak valid'
                ]);
                return;
            }

            // Generate ID Transaksi
            $id_transaksi = $this->generate_id_transaksi();

            // Ambil ID Customer dari session
            $id_customer = $this->session->userdata('id_customer');

            // Prepare data untuk insert
            $data_transaksi = [
                'id_transaksi' => $id_transaksi,
                'tanggal' => date('Y-m-d'),
                'id_customer' => $id_customer,
                'total' => intval($total),
                'metode_pembayaran' => $metode_pembayaran,
                'bayar' => intval($bayar),
                'kembali' => intval($kembali),
                'ongkir' => intval($ongkir)
            ];

            // Insert ke database
            $insert = $this->Transaksi_model->insert($data_transaksi);

            if ($insert) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Transaksi berhasil disimpan',
                    'id_transaksi' => $id_transaksi,
                    'data' => $data_transaksi
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan transaksi'
                ]);
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Generate ID Transaksi unik
     * Format: TRX-YYYYMMDD-XXXXXX
     */
    private function generate_id_transaksi() {
        $prefix = 'TRX-' . date('Ymd') . '-';
        
        // Cek transaksi terakhir hari ini
        $last_trx = $this->db
            ->select('id_transaksi')
            ->from('transaksi')
            ->like('id_transaksi', $prefix, 'after')
            ->order_by('id_transaksi', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        if ($last_trx) {
            // Ambil nomor urut terakhir
            $last_number = intval(substr($last_trx->id_transaksi, -6));
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format dengan leading zeros (6 digit)
        $id_transaksi = $prefix . str_pad($new_number, 6, '0', STR_PAD_LEFT);

        return $id_transaksi;
    }

    /**
     * Get detail transaksi (opsional)
     */
    public function detail($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id_transaksi);
        
        if (!$data['transaksi']) {
            show_404();
        }

        $this->load->view('transaksi/detail', $data);
    }
}