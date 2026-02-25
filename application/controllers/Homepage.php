<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller
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
	public function index()
	{
		$this->load->model(['Item_model']);
		$id_customer = $this->session->userdata('id_customer');
		$items = $this->Item_model->get_items_with_wishlist($id_customer, null, 8, 0);
		foreach ($items as &$item) {
			$item->warna = $this->Item_model->get_warna($item->id_item);
		}
		$data['items'] = $items;
		$data['promo_items'] = array_values(array_filter($items, function($i) { return $i->is_sale == 1; }));
    	$data['new_items']   = array_values(array_filter($items, function($i) { return $i->is_new == 1; }));
		$data['kategori'] = $this->Item_model->get_kategori();
		$data['banners'] = $this->Item_model->get_banners();
		$data['contents'] = $this->load->view('homepage', $data, TRUE);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}
}
