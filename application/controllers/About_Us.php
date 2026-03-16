<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_Us extends MY_Controller
{
	public function index()
	{
		$this->load->model(['Item_model']);
		$data['tentang'] = $this->Item_model->tentang_kami();
		$data['contents'] = $this->load->view('about_us', $data, TRUE);
		$this->load->view('navbar', array_merge($this->global_data, $data));
	}
}