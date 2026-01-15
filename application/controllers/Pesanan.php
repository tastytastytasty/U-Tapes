<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends MY_Controller {

    

    public function index()
    {
        $data['contents'] = $this->load->view('pesanan', [], TRUE);
        $this->load->view('navbar', array_merge($this->global_data, $data));
    }

   
}