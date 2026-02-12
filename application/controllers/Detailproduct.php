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
		$this->load->model('Keranjang_model');

		$id_customer = $this->session->userdata('id_customer');
		$warna_selected = $this->input->get('warna');

		$item = $this->Item_model->get_item($id_item);
		$termurah = $this->Item_model->get_termurah($id_item);
		$warna_list = $this->Item_model->get_warna($id_item);
		$total_stok = $this->Item_model->total_stok_item($id_item);

		$detail_aktif = null;
		if ($warna_selected) {
			$detail = $this->Item_model->get_detail_by_warna($id_item, $warna_selected);
			if ($detail) {
				$detail_aktif = $detail;
				$gambar_detail = $detail->gambar;
				$default_warna = $detail->warna;
				$default_ukuran = $detail->ukuran;
				$harga = $detail->harga;
				$stok = $detail->stok;
			} else {
				$detail_aktif = $termurah;
				$gambar_detail = $termurah->gambar;
				$default_warna = $termurah->warna;
				$default_ukuran = $termurah->ukuran;
				$harga = $termurah->harga;
				$stok = $termurah->stok;
			}
		} else {
			$detail_aktif = $termurah;
			$gambar_detail = $termurah->gambar;
			$default_warna = $termurah->warna;
			$default_ukuran = $termurah->ukuran;
			$harga = $termurah->harga;
			$stok = $termurah->stok;
		}

		$in_wishlist = false;
		$is_in_cart = false;

		if ($id_customer && $detail_aktif) {
			$in_wishlist = $this->Wishlist_model->is_exist($id_customer, $id_item);
			$is_in_cart = $this->Keranjang_model->is_in_cart($id_customer, $detail_aktif->id_item_detail);
		}

		$data = [
			'item' => $item,
			'warna' => $warna_list,
			'default_warna' => $default_warna,
			'default_ukuran' => $default_ukuran,
			'gambar_detail' => $gambar_detail,
			'harga' => $harga,
			'stok' => $stok,
			'total_stok' => (int) $total_stok,
			'in_wishlist' => $in_wishlist,
			'is_in_cart' => $is_in_cart,
			'detail_aktif' => $detail_aktif
		];

		$data['contents'] = $this->load->view('detailproduct', $data, TRUE);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}

}
