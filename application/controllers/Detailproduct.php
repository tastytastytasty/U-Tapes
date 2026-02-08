<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detailproduct extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index($id_item)
	{
		$this->load->model('Item_model');
		$this->load->model('Wishlist_model');
		$id_customer = $this->session->userdata('id_customer');
		$item = $this->Item_model->get_item($id_item);
		$termurah = $this->Item_model->get_termurah($id_item);
		$warna = $this->Item_model->get_warna($id_item);
		$total_stok = $this->Item_model->total_stok_item($id_item);
		$in_wishlist = false;
		if ($id_customer) {
			$in_wishlist = $this->Wishlist_model
				->is_exist($id_customer, $id_item);
		}
		$data = [
			'item' => $item,
			'warna' => $warna,
			'default_warna' => $termurah->warna,
			'default_ukuran' => $termurah->ukuran,
			'gambar_detail' => $termurah->gambar,
			'harga' => $termurah->harga,
			'stok' => $termurah->stok,
			'total_stok' => (int)$total_stok,
			'in_wishlist' => $in_wishlist
		];
		$data['contents'] = $this->load->view('detailproduct', $data, TRUE);
		$this->load->view('navbar',array_merge($this->global_data, $data));
	}

}
