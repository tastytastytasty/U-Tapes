<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {  // ✅ SIMPLIFIED: Pakai CI_Controller dulu

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('M_pembayaran');
        $this->load->library('session');
    }
    
    /**
     * TEST METHOD DULU - GA PERLU LOGIN, GA PERLU DATABASE
     * URL: /pembayaran/test
     */
    public function test() {
        echo "<h1 style='color: green;'>✅ PEMBAYARAN CONTROLLER WORKS!</h1>";
        echo "<p>File: " . __FILE__ . "</p>";
        echo "<p>Class: " . get_class($this) . "</p>";
        echo "<hr>";
        
        echo "<h2>Test Links:</h2>";
        echo "<ul>";
        echo "<li><a href='" . site_url('pembayaran/debug/TRX001') . "'>Test parameter: TRX001</a></li>";
        echo "<li><a href='" . site_url('pembayaran/debug/12345') . "'>Test parameter: 12345</a></li>";
        echo "</ul>";
    }
    
    /**
     * DEBUG METHOD - Terima parameter
     * URL: /pembayaran/debug/TRX-20260302-000001
     */
    public function debug($no_nota = null) {
        echo "<h1>DEBUG MODE</h1>";
        echo "<p>No Nota received: <strong>" . ($no_nota ? $no_nota : 'NONE') . "</strong></p>";
        echo "<p>Session ID Customer: <strong>" . ($this->session->userdata('id_customer') ? $this->session->userdata('id_customer') : 'NOT LOGGED IN') . "</strong></p>";
        
        echo "<hr>";
        
        if ($no_nota) {
            echo "<h2>Trying to load transaksi by no_nota...</h2>";
            
            // ✅ Try load transaksi by NO_NOTA
            $transaksi = $this->Transaksi_model->get_by_no_nota($no_nota);
            
            if ($transaksi) {
                echo "<p style='color: green;'>✅ TRANSAKSI FOUND!</p>";
                echo "<pre>";
                print_r($transaksi);
                echo "</pre>";
            } else {
                echo "<p style='color: red;'>❌ Transaksi dengan no_nota {$no_nota} tidak ditemukan!</p>";
                echo "<p>Check apakah no_nota ini ada di database:</p>";
                echo "<code>SELECT * FROM transaksi WHERE no_nota = '{$no_nota}'</code>";
            }
        }
        
        echo "<p><a href='" . site_url('pembayaran/test') . "'>Back to test</a></p>";
    }

    /**
     * Halaman pembayaran (setelah checkout)
     * Accept no_nota sebagai parameter (format: TRX-20260302-000001)
     * 
     * URL: /pembayaran/TRX-20260302-000001
     * Or: /pembayaran?id=TRX-20260302-000001
     */
    public function index($no_nota = null) {
        $id_customer = $this->session->userdata('id_customer');
        
        // ✅ Accept dari query string ATAU URL segment
        if (!$no_nota) {
            $no_nota = $this->input->get('id');
        }
        
        // Validasi no_nota
        if (!$no_nota) {
            echo "<h1 style='color: red;'>❌ NO TRANSACTION ID!</h1>";
            echo "<p>URL should be: /pembayaran/TRX-20260302-000001</p>";
            echo "<p>Or: /pembayaran?id=TRX-20260302-000001</p>";
            die();
        }
        
        // ✅ Ambil transaksi by NO_NOTA (bukan id_transaksi!)
        $transaksi = $this->Transaksi_model->get_by_no_nota($no_nota);
        
        // Validasi: transaksi exist & milik customer ini
        if (!$transaksi) {
            echo "<h1 style='color: red;'>❌ TRANSAKSI NOT FOUND!</h1>";
            echo "<p>No Nota: <strong>{$no_nota}</strong></p>";
            echo "<p>Cek database apakah transaksi dengan no_nota ini ada?</p>";
            echo "<hr>";
            echo "<p><strong>Debug Info:</strong></p>";
            echo "<ul>";
            echo "<li>Query: Transaksi_model->get_by_no_nota('{$no_nota}')</li>";
            echo "<li>Session ID Customer: " . ($id_customer ?: 'NOT LOGGED IN') . "</li>";
            echo "</ul>";
            die();
        }
        
        // Validasi ownership (comment dulu untuk debug)
        if ($id_customer && $transaksi->id_customer != $id_customer) {
            show_404();
            return;
        }
        
        // ✅ Ambil items WITH SNAPSHOT DISCOUNT dari transaksi_promo_item
        $items = $this->db
            ->select('
                item.nama_item,
                item.gambar_item,
                item_detail.ukuran,
                item_detail.warna,
                item_detail.harga AS harga,
                transaksi_item.qty,
                transaksi_item.Total AS subtotal_final,
                transaksi_promo_item.nilai AS nilai_diskon
            ')
            ->from('transaksi_item')
            ->join('item_detail', 'transaksi_item.id_item_detail = item_detail.id_item_detail')
            ->join('item', 'item_detail.id_item = item.id_item')
            ->join('transaksi_promo_item', 'transaksi_promo_item.id_transaksi_item = transaksi_item.id_transaksi_item', 'left')
            ->where('transaksi_item.id_transaksi', $transaksi->id_transaksi)
            ->get()
            ->result();
        
        // ✅ Get payment status
        $pembayaran = $this->db
            ->where('id_transaksi', $transaksi->id_transaksi)
            ->get('pembayaran')
            ->row();
        
        // ✅ Get rekening info (if metode = Rekening)
        $rekening = null;
        if ($transaksi->metode_pembayaran == 'Rekening' && !empty($transaksi->id_rekening)) {
            $rekening = $this->db
                ->where('id_rekening', $transaksi->id_rekening)  // ✅ Database field: id_rekening
                ->get('rekening')
                ->row();
        }
        
        // ✅ Check if bukti_transfer already exists
        $has_bukti = !empty($transaksi->bukti_transfer);
        
        $data = [
            'transaksi' => $transaksi,
            'items' => $items,
            'pembayaran' => $pembayaran,
            'rekening' => $rekening,  // ✅ Pass rekening info
            'has_bukti' => $has_bukti
        ];
        
        // ✅ Load standalone view
        $this->load->view('pembayaran', $data);
    }

    /**
     * Upload bukti transfer
     * Accept no_nota sebagai parameter
     */
    public function upload_bukti($no_nota) {
        header('Content-Type: application/json');
        
        // ✅ Debug log
        error_log("📤 UPLOAD BUKTI - no_nota: " . $no_nota);
        error_log("📤 FILES: " . print_r($_FILES, true));
        
        $id_customer = $this->session->userdata('id_customer');
        
        // Get transaksi by no_nota
        $transaksi = $this->Transaksi_model->get_by_no_nota($no_nota);
        
        if (!$transaksi || $transaksi->id_customer != $id_customer) {
            error_log("❌ Transaksi tidak valid");
            echo json_encode([
                'success' => false,
                'message' => 'Transaksi tidak valid'
            ]);
            return;
        }
        
        error_log("✅ Transaksi found: id_transaksi = " . $transaksi->id_transaksi);
        
        // Check status pembayaran
        $pembayaran = $this->db
            ->where('id_transaksi', $transaksi->id_transaksi)
            ->get('pembayaran')
            ->row();
        
        if (!$pembayaran) {
            error_log("❌ Pembayaran tidak ditemukan");
            echo json_encode([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ]);
            return;
        }
        
        error_log("✅ Pembayaran status: " . $pembayaran->status);
        
        // ✅ Cek status - hanya bisa upload kalau Menunggu
        if ($pembayaran->status != 'Menunggu') {
            error_log("❌ Status bukan Menunggu");
            echo json_encode([
                'success' => false,
                'message' => 'Pembayaran sudah diproses, tidak dapat upload bukti lagi'
            ]);
            return;
        }
        
        // ✅ Handle file upload
        $config['upload_path'] = './assets/bukti_transfer/';  // ✅ Changed to assets
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        
        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        error_log("📁 Upload config: " . print_r($config, true));
        
        if (!$this->upload->do_upload('bukti_transfer')) {
            $errors = $this->upload->display_errors('', '');
            error_log("❌ Upload failed: " . $errors);
            echo json_encode([
                'success' => false,
                'message' => $errors
            ]);
            return;
        }
        
        $upload_data = $this->upload->data();
        $filename = $upload_data['file_name'];
        
        error_log("✅ Upload success: " . $filename);
        
        // ✅ Update transaksi.bukti_transfer
        $update_transaksi = $this->db->where('id_transaksi', $transaksi->id_transaksi)
            ->update('transaksi', [
                'bukti_transfer' => $filename
            ]);
        
        error_log("✅ Update transaksi: " . ($update_transaksi ? 'SUCCESS' : 'FAILED'));
        
        // ✅ Update pembayaran status ke "Diproses"
        $update_pembayaran = $this->db->where('id_transaksi', $transaksi->id_transaksi)
            ->update('pembayaran', [
                'status' => 'Menunggu'
            ]);
        
        error_log("✅ Update pembayaran: " . ($update_pembayaran ? 'SUCCESS' : 'FAILED'));
        
        echo json_encode([
            'success' => true,
            'message' => 'Bukti transfer berhasil diupload',
            'filename' => $filename
        ]);
    }

    /**
     * Cek status pembayaran
     */
    public function cek_status($id_transaksi) {
        header('Content-Type: application/json');
        
        $id_customer = $this->session->userdata('id_customer');
        
        $pembayaran = $this->db
            ->select('pembayaran.*, transaksi.id_customer')
            ->from('pembayaran')
            ->join('transaksi', 'pembayaran.id_transaksi = transaksi.id_transaksi')
            ->where('pembayaran.id_transaksi', $id_transaksi)
            ->where('transaksi.id_customer', $id_customer)
            ->get()
            ->row();
        
        if ($pembayaran) {
            echo json_encode([
                'success' => true,
                'status' => $pembayaran->status
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ]);
        }
    }
}