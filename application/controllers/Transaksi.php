<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('M_pembayaran');  // ← tambahan
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
            $total             = $this->input->post('total');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $bayar             = $this->input->post('bayar');
            $ongkir            = $this->input->post('ongkir');

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

            // Generate No Nota (Invoice)
            $no_nota = $this->generate_no_nota();

            // Ambil ID Customer dari session
            $id_customer = $this->session->userdata('id_customer');

            // Prepare data untuk insert
            $data_transaksi = [
                'id_transaksi'      => $id_transaksi,
                'no_nota'           => $no_nota,
                'tanggal'           => date('Y-m-d'),
                'id_customer'       => $id_customer,
                'total'             => intval($total),
                'metode_pembayaran' => $metode_pembayaran,
                'bayar'             => intval($bayar),
                'ongkir'            => intval($ongkir),
                'status_transaksi'  => 'dikemas'
            ];

            // Insert transaksi ke database
            $insert = $this->Transaksi_model->insert($data_transaksi);

            if (!$insert) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan transaksi'
                ]);
                return;
            }

            // ===== INSERT PEMBAYARAN =====
            $this->M_pembayaran->insert([
                'tanggal'      => date('Y-m-d H:i:s'),
                'id_transaksi' => $id_transaksi,
                'status'       => 'Menunggu'
            ]);

            echo json_encode([
                'success'      => true,
                'message'      => 'Transaksi berhasil disimpan',
                'id_transaksi' => $id_transaksi,
                'no_nota'      => $no_nota,
                'data'         => $data_transaksi
            ]);

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
     * Generate No Nota (Invoice)
     * Format: INV/YYYY/MM/XXXX
     */
    private function generate_no_nota() {
        $prefix = 'INV/' . date('Y') . '/' . date('m') . '/';
        
        // Cek nota terakhir bulan ini
        $last_nota = $this->db
            ->select('no_nota')
            ->from('transaksi')
            ->like('no_nota', $prefix, 'after')
            ->order_by('no_nota', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        if ($last_nota) {
            // Ambil nomor urut terakhir
            $last_number = intval(substr($last_nota->no_nota, -4));
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format dengan leading zeros (4 digit)
        $no_nota = $prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);

        return $no_nota;
    }

    /**
     * Update status transaksi
     */
    public function update_status() {
        header('Content-Type: application/json');

        try {
            $id_transaksi = $this->input->post('id_transaksi');
            $status = $this->input->post('status');

            // Validasi
            if (empty($id_transaksi) || empty($status)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
                return;
            }

            // Validasi status
            $valid_status = ['dikemas', 'dikirim', 'diterima', 'dibatalkan'];
            if (!in_array($status, $valid_status)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Status tidak valid'
                ]);
                return;
            }

            // Update status
            $update = $this->Transaksi_model->update($id_transaksi, [
                'status_transaksi' => $status
            ]);

            if ($update) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Status berhasil diupdate'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal update status'
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
     * Get detail transaksi (opsional)
     */
    public function detail($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id_transaksi);
        
        if (!$data['transaksi']) {
            show_404();
        }

        $this->load->view('transaksi/detail', $data);
    }

    /**
     * Get riwayat transaksi customer
     */
    public function riwayat() {
        $id_customer = $this->session->userdata('id_customer');
        $data['transaksi_list'] = $this->Transaksi_model->get_by_customer($id_customer);
        
        $this->load->view('transaksi/riwayat', $data);
    }
}