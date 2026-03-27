<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->library(['email']);
		$this->load->database();
		$this->load->model('Transaksi_model');
		$this->load->model('M_pembayaran');
	}

   public function index()
{
    $id_customer = $this->session->userdata('id_customer');
    
    // ✅ Get all transaksi customer
    $transaksi_list = $this->Transaksi_model->get_by_customer($id_customer, 50, 0);
    
    // ✅ Determine status display untuk setiap transaksi
    foreach ($transaksi_list as &$transaksi) {
        // Get payment status
        $pembayaran = $this->M_pembayaran->get_by_transaksi($transaksi->id_transaksi);
        $transaksi->payment_status = $pembayaran ? $pembayaran->status : 'Menunggu';
        $transaksi->has_paid = ($pembayaran && $pembayaran->status == 'Berhasil');
        
        // ✅ LOGIC PRIORITY:
        // 1. Cek transaksi.status_transaksi (Menunggu/Berhasil/Ditolak/Gagal)
        // 2. Kalau Berhasil → cek pengiriman.status
        
        if ($transaksi->status_transaksi == 'Menunggu') {
            // ❶ BELUM BAYAR - Show status dari transaksi
            $transaksi->show_status = 'Menunggu Pembayaran';
            $transaksi->can_pay = true;  // Show "Bayar Sekarang" button
            $transaksi->can_view_invoice = false;
            
        } elseif ($transaksi->status_transaksi == 'Berhasil') {
            // ❷ SUDAH BAYAR & ACC - Show status dari pengiriman
            $pengiriman = $this->db
                ->where('id_transaksi', $transaksi->id_transaksi)
                ->get('pengiriman')
                ->row();
            
            if ($pengiriman) {
                // Ada data pengiriman - use shipping status
                $transaksi->show_status = $pengiriman->status;
                $transaksi->delivery_status = $pengiriman->status;
            } else {
                // Belum ada pengiriman (baru ACC) - default
                $transaksi->show_status = 'Diproses';
                $transaksi->delivery_status = null;
            }
            
            $transaksi->can_pay = false;
            $transaksi->can_view_invoice = true;  // Show "Lihat Invoice" button
            
        } elseif (in_array($transaksi->status_transaksi, ['Ditolak', 'Gagal'])) {
            // ❸ DITOLAK/GAGAL
            $transaksi->show_status = $transaksi->status_transaksi;
            $transaksi->can_pay = false;
            $transaksi->can_view_invoice = false;
        }
    }
    
    $viewData = array_merge($this->global_data, [
        'logged_in' => $this->session->userdata('logged_in'),
        'transaksi_list' => $transaksi_list
    ]);

    $data['contents'] = $this->load->view('pesanan', $viewData, TRUE);

    $this->load->view('navbar', array_merge($this->global_data, $data));
}

/**
 * Display Invoice untuk transaksi yang sudah dibayar
 * URL: /pesanan/invoice/INV-202603-0001
 */
public function invoice($no_nota = null)
{
    if (!$no_nota) {
        show_404();
        return;
    }

    $id_customer = $this->session->userdata('id_customer');
    
    // Get transaksi by no_nota
    $transaksi = $this->Transaksi_model->get_by_no_nota($no_nota);
    
    if (!$transaksi || $transaksi->id_customer != $id_customer) {
        show_404();
        return;
    }
    
    // Get payment info
    $pembayaran = $this->M_pembayaran->get_by_transaksi($transaksi->id_transaksi);
    
    // Only show invoice if payment is successful
    if (!$pembayaran || $pembayaran->status != 'Berhasil') {
        // Redirect to payment page instead
        redirect('pembayaran/' . $no_nota);
        return;
    }
    
    // ✅ Get transaksi items WITH SNAPSHOT from transaksi_promo_item
    $items = $this->db
        ->select('
            item.nama_item,
            item.gambar_item,
            item_detail.ukuran,
            item_detail.warna,
            item_detail.harga,
            transaksi_item.qty,
            transaksi_item.Total as subtotal,
            transaksi_promo_item.nilai as diskon_snapshot
        ')
        ->from('transaksi_item')
        ->join('item_detail', 'transaksi_item.id_item_detail = item_detail.id_item_detail')
        ->join('item', 'item_detail.id_item = item.id_item')
        ->join('transaksi_promo_item', 'transaksi_promo_item.id_transaksi_item = transaksi_item.id_transaksi_item', 'left')
        ->where('transaksi_item.id_transaksi', $transaksi->id_transaksi)
        ->get()
        ->result();
    
    // Get customer address (if available)
    $this->load->model('AlamatModel');
    $alamat = $this->AlamatModel->getDefaultAddressWithNames($id_customer);
    
    $data = [
        'transaksi' => $transaksi,
        'pembayaran' => $pembayaran,
        'items' => $items,
        'alamat' => $alamat
    ];
    
    // Load invoice view (standalone, no navbar)
    $this->load->view('invoice', $data);
}


   
}