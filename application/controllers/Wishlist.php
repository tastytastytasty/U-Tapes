<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Wishlist_model');
	}
	public function index()
	{
		$id_customer = $this->session->userdata('id_customer');

		$data['need_login'] = !$id_customer;
		$data['wishlist'] = $id_customer
			? $this->Wishlist_model->get_by_customer($id_customer)
			: [];

		$data['contents'] = $this->load->view('wishlist', $data, true);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}

	public function add()
	{
		if (!$this->session->userdata('logged_in')) {
			echo json_encode(['status' => 'login']);
			return;
		}
		$id_item = $this->input->post('id_item');
		$id_customer = $this->session->userdata('id_customer');

		$this->Wishlist_model->insert_wishlist($id_customer, $id_item);
		echo json_encode(['status' => 'success']);
	}
	public function delete()
	{
		$id_wishlist = $this->input->post('id_wishlist');
		if (empty($id_wishlist)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'ID wishlist tidak ditemukan'
			]);
			return;
		}
		$this->db->where('id_wishlist', $id_wishlist)->delete('wishlist');

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function toggle()
	{
		if (!$this->session->userdata('id_customer')) {
			echo json_encode(['status' => 'login']);
			return;
		}

		$id_customer = $this->session->userdata('id_customer');
		$id_item = $this->input->post('id_item');

		if ($this->Wishlist_model->is_exist($id_customer, $id_item)) {
			$this->Wishlist_model->delete_by_item($id_customer, $id_item);
			echo json_encode(['status' => 'removed']);
		} else {
			$this->Wishlist_model->insert_wishlist($id_customer, $id_item);
			echo json_encode(['status' => 'added']);
		}
	}
}


