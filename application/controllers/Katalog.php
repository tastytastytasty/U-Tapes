<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends MY_Controller
{
	private function _getKatalogData($page)
	{
		$this->load->model(['Item_model', 'Kategori_model']);

		$limit = 12;
		$offset = ($page - 1) * $limit;
		$id_customer = $this->session->userdata('id_customer');

		$filter = [
			'keyword' => $this->input->get('keyword'),
			'sort' => $this->input->get('sort'),
			'sex' => $this->input->get('sex'),
			'kategori' => $this->input->get('kategori')
		];
		$items = $this->Item_model->get_items_with_wishlist(
			$id_customer,
			$filter,
			$limit,
			$offset
		);
		foreach ($items as &$item) {
			$item->warna = $this->Item_model->get_warna($item->id_item);
		}
		$total = $this->Item_model->count_items_with_filter(
			$filter
		);

		$per_group = 5;
		$total_page = ceil($total / $limit);
		$group = ceil($page / $per_group);
		$start = ($group - 1) * $per_group + 1;
		$end = min($start + $per_group - 1, $total_page);

		return [
			'items' => $items,
			'kategori' => $this->Kategori_model->get_kategori(),
			'page' => $page,
			'limit' => $limit,
			'total' => $total,
			'total_page' => $total_page,
			'start' => $start,
			'end' => $end
		];
	}
	public function index($page = 1)
	{
		$data = $this->_getKatalogData($page);

		$data['contents'] = $this->load->view('katalog', $data, TRUE);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}
	public function ajax_katalog($page = 1)
	{
		$data = $this->_getKatalogData($page);

		$html = $this->load->view('katalog_items', $data, TRUE);
		$pagination = $this->load->view('katalog_pagination', $data, TRUE);

		echo json_encode([
			'html' => $html,
			'pagination' => $pagination
		]);
	}
}
