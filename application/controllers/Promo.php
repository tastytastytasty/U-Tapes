<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller
{
	public function index()
	{
		$this->load->model(['Item_model']);
		$this->load->model(['Wishlist_model']);
		$promos = $this->Wishlist_model->get_promo_items();
		foreach ($promos as &$promo) {
			$promo->warna = $this->Item_model->get_warna($promo->id_item);
		}
		$data['promos'] = $promos;
		$data['kategori'] = $this->Item_model->get_kategori();
		$data['contents'] = $this->load->view('promo', $data, TRUE);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}
}
