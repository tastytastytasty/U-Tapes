<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends MY_Controller
{
    public function index()
    {
        $this->load->model('Keranjang_model');
        $id_customer = $this->session->userdata('id_customer');
        $data['cart'] = $this->Keranjang_model->get_by_customer($id_customer);

        $data['contents'] = $this->load->view('keranjang', $data, TRUE);
        $this->load->view('navbar', array_merge($this->global_data, $data));
    }
    public function add()
    {

        $this->load->model('Keranjang_model');

        $id_customer = $this->session->userdata('id_customer');
        $id_item = $this->input->post('id_item');
        $warna = $this->input->post('warna');
        $ukuran = $this->input->post('ukuran');
        $qty = (int) $this->input->post('qty');

        if (!$id_customer) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan login dulu']);
            return;
        }

        if ($qty <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Stok barang sedang habis']);
            return;
        }

        $item_detail = $this->Keranjang_model->get_item_detail($id_item, $warna, $ukuran);

        if (!$item_detail) {
            echo json_encode(['status' => 'error', 'message' => 'Item tidak ditemukan']);
            return;
        }

        $this->Keranjang_model->add_to_cart([
            'id_customer' => $id_customer,
            'id_item_detail' => $item_detail->id_item_detail,
            'qty' => $qty,
            'checklist' => 'No'
        ]);

        echo json_encode(['status' => 'ok']);
    }
    public function toggle()
    {
        $this->load->model('Keranjang_model');

        $id_customer = $this->session->userdata('id_customer');
        $id_item_detail = $this->input->post('id_item_detail');
        $qty = (int) $this->input->post('qty');

        if (!$id_customer) {
            echo json_encode(['status' => 'login']);
            return;
        }
        if (!$id_item_detail) {
            echo json_encode(['status' => 'error', 'message' => 'Detail item tidak valid']);
            return;
        }
        $exists = $this->Keranjang_model->is_in_cart($id_customer, $id_item_detail);

        if ($exists) {
            $this->Keranjang_model->remove($id_customer, $id_item_detail);
            echo json_encode(['status' => 'removed']);
        } else {
            if ($qty <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Jumlah minimal 1']);
                return;
            }

            $this->Keranjang_model->add_to_cart([
                'id_customer' => $id_customer,
                'id_item_detail' => $id_item_detail,
                'qty' => $qty,
                'checklist' => 'No'
            ]);

            echo json_encode(['status' => 'added']);
        }
    }
}
