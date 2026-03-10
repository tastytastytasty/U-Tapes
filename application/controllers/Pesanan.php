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
    
    // ✅ Get all transaksi customer, sorted by terbaru
    $transaksi_list = $this->Transaksi_model->get_by_customer($id_customer, 50, 0);
    
    // ✅ Get payment status untuk setiap transaksi
    foreach ($transaksi_list as &$transaksi) {
        $pembayaran = $this->M_pembayaran->get_by_transaksi($transaksi->id_transaksi);
        $transaksi->payment_status = $pembayaran ? $pembayaran->status : 'Menunggu';
        $transaksi->has_paid = ($pembayaran && $pembayaran->status == 'Berhasil');
    }
    
    $viewData = [
        'logged_in' => $this->session->userdata('logged_in'),
        'transaksi_list' => $transaksi_list
    ];

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
    
    // Get transaksi items
    $items = $this->db
        ->select('
            item.nama_item,
            item.gambar_item,
            item_detail.ukuran,
            item_detail.warna,
            item_detail.harga,
            transaksi_item.qty,
            transaksi_item.Total as subtotal,
            MAX(promo.persen_promo) AS persen_promo,
            MAX(promo.harga_promo) AS harga_promo,
            MAX(
                CASE 
                    WHEN promo.id_promo IS NOT NULL 
                    AND CURDATE() BETWEEN promo.dari AND promo.hingga
                    AND promo.kuota > 0 
                    THEN 1 ELSE 0 
                END
            ) AS is_sale
        ')
        ->from('transaksi_item')
        ->join('item_detail', 'transaksi_item.id_item_detail = item_detail.id_item_detail')
        ->join('item', 'item_detail.id_item = item.id_item')
        ->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left')
        ->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left')
        ->where('transaksi_item.id_transaksi', $transaksi->id_transaksi)
        ->group_by('transaksi_item.id_transaksi_item')
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