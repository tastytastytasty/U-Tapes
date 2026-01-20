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
	}

   public function index()
{
    $viewData = [
        'logged_in' => $this->session->userdata('logged_in')
    ];

    $data['contents'] = $this->load->view('pesanan', $viewData, TRUE);

    $this->load->view('navbar', array_merge($this->global_data, $data));
}


   
}