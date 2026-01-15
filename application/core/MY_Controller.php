<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $global_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $id_customer = $this->session->userdata('id_customer');
        $this->global_data['logged_in'] = (bool) $this->session->userdata('logged_in');
        $this->global_data['user'] = $this->session->userdata('user');
        $this->global_data['wishlist_count'] = 0;
        $this->global_data['wishlist_items'] = [];
        if ($id_customer) {
            $this->load->model('Wishlist_model');

            $items = $this->Wishlist_model->get_by_customer($id_customer);

            $this->global_data['wishlist_items'] = $items;
            $this->global_data['wishlist_count'] = count($items);
        }
    }
}

