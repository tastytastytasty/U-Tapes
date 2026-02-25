<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('M_pembayaran');
        $this->load->model('Checkout_model'); // ✅ TAMBAHAN: Load Checkout_model
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

        // ✅ START DATABASE TRANSACTION
        $this->db->trans_start();

        try {
            // Ambil data dari POST
            $total             = $this->input->post('total');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $bayar             = $this->input->post('bayar');
            $ongkir            = $this->input->post('ongkir');

            // Validasi data
            if (empty($total) || empty($metode_pembayaran)) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
                return;
            }

            // Validasi metode pembayaran
            $valid_methods = ['Tunai', 'E-wallet', 'Rekening'];
            if (!in_array($metode_pembayaran, $valid_methods)) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Metode pembayaran tidak valid'
                ]);
                return;
            }

            // Ambil ID Customer dari session
            $id_customer = $this->session->userdata('id_customer');

            // ===== 1. AMBIL CART ITEMS (CHECKLIST YES) =====
            $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);

            if (empty($checkout_items)) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Keranjang kosong atau tidak ada item yang dipilih'
                ]);
                return;
            }

            // Generate ID Transaksi
            $id_transaksi = $this->generate_id_transaksi();

            // Generate No Nota (Invoice)
            $no_nota = $this->generate_no_nota();

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

            // ===== 2. INSERT TRANSAKSI =====
            $insert = $this->Transaksi_model->insert($data_transaksi);

            if (!$insert) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan transaksi'
                ]);
                return;
            }

            // ===== 3. INSERT PEMBAYARAN =====
            $insert_payment = $this->M_pembayaran->insert([
                'tanggal'      => date('Y-m-d H:i:s'),
                'id_transaksi' => $id_transaksi,
                'status'       => 'Menunggu'
            ]);

            if (!$insert_payment) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal membuat pembayaran'
                ]);
                return;
            }

            // ===== 4. KURANGI STOK ITEM =====
            $reduce_stock = $this->Checkout_model->reduce_stock($checkout_items);

            if (!$reduce_stock) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal mengurangi stok. Mungkin stok tidak cukup.'
                ]);
                return;
            }

            // ===== 5. HAPUS ITEM DARI CART (CHECKLIST YES) =====
            $clear_cart = $this->Checkout_model->clear_checkout_items($id_customer);

            if (!$clear_cart) {
                $this->db->trans_rollback();
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menghapus item dari keranjang'
                ]);
                return;
            }

            // ✅ COMMIT TRANSACTION
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Transaksi gagal. Silakan coba lagi.'
                ]);
                return;
            }

            // ✅ SUCCESS
            echo json_encode([
                'success'      => true,
                'message'      => 'Transaksi berhasil! Item sudah dihapus dari keranjang.',
                'id_transaksi' => $id_transaksi,
                'no_nota'      => $no_nota,
                'data'         => $data_transaksi
            ]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
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