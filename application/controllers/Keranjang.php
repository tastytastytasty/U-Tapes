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
    public function delete()
    {
        $this->load->model('Keranjang_model');
        $id_customer = $this->session->userdata('id_customer');
        $id_cart = $this->input->post('id_cart');

        if (!$id_customer) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan login dulu']);
            return;
        }

        if (!$id_cart) {
            echo json_encode(['status' => 'error', 'message' => 'ID keranjang tidak valid']);
            return;
        }
        $cart_item = $this->Keranjang_model->get_cart_item($id_cart, $id_customer);

        if (!$cart_item) {
            echo json_encode(['status' => 'error', 'message' => 'Item tidak ditemukan']);
            return;
        }
        $this->Keranjang_model->delete_by_id($id_cart);
        echo json_encode(['status' => 'success', 'message' => 'Item berhasil dihapus']);
    }
    public function update_quantity()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        if (!$this->session->userdata('id_customer')) {
            echo json_encode([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
            return;
        }
        $id_cart = $this->input->post('id_cart');
        $qty = (int) $this->input->post('qty');
        $id_customer = $this->session->userdata('id_customer');
        if (empty($id_cart) || $qty < 1) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak valid'
            ]);
            return;
        }
        $this->db->select('c.*, id.stok, id.harga');
        $this->db->from('cart c');
        $this->db->join('item_detail id', 'c.id_item_detail = id.id_item_detail');
        $this->db->where('c.id_cart', $id_cart);
        $this->db->where('c.id_customer', $id_customer);
        $cart = $this->db->get()->row();
        if (!$cart) {
            echo json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ]);
            return;
        }
        if ($qty > $cart->stok) {
            echo json_encode([
                'success' => false,
                'message' => 'Stok tidak mencukupi. Stok tersisa: ' . $cart->stok
            ]);
            return;
        }
        $update = $this->db->where('id_cart', $id_cart)
            ->where('id_customer', $id_customer)
            ->update('cart', ['qty' => $qty]);
        if (!$update) {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal update keranjang'
            ]);
            return;
        }
        $this->db->select('
            SUM(
                CASE 
                    WHEN p.persen_promo > 0 THEN (c.qty * id.harga) - ((c.qty * id.harga) * p.persen_promo / 100)
                    WHEN p.harga_promo > 0 THEN (c.qty * id.harga) - (p.harga_promo * c.qty)
                    ELSE c.qty * id.harga
                END
            ) as cart_total,
            SUM(c.qty) as total_items
        ');
        $this->db->from('cart c');
        $this->db->join('item_detail id', 'c.id_item_detail = id.id_item_detail');
        $this->db->join('promo_detail pd', 'pd.id_item_detail = id.id_item_detail', 'left');
        $this->db->join('promo p', 'p.id_promo = pd.id_promo', 'left');
        $this->db->where('c.id_customer', $id_customer);
        $result = $this->db->get()->row();
        echo json_encode([
            'success' => true,
            'cart_total' => $result->cart_total ?? 0,
            'total_items' => $result->total_items ?? 0,
            'message' => 'Keranjang berhasil diupdate'
        ]);
    }
    public function update_checklist()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $id_customer = $this->session->userdata('id_customer');
        if (!$id_customer) {
            echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
            return;
        }

        $id_cart = $this->input->post('id_cart');
        $checklist = $this->input->post('checklist') === 'Yes' ? 'Yes' : 'No';

        if (empty($id_cart)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
            return;
        }

        $update = $this->db
            ->where('id_cart', $id_cart)
            ->where('id_customer', $id_customer)
            ->update('cart', ['checklist' => $checklist]);

        echo json_encode([
            'success' => $update,
            'message' => $update ? 'Checklist berhasil diupdate' : 'Gagal update checklist'
        ]);
    }
    public function hapus_item()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $id_customer = $this->session->userdata('id_customer');
        if (!$id_customer) {
            echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
            return;
        }
        $id_cart = $this->input->post('id_cart');
        if (empty($id_cart)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
            return;
        }
        $delete = $this->db
            ->where('id_cart', $id_cart)
            ->where('id_customer', $id_customer)
            ->delete('cart');
        echo json_encode([
            'success' => $delete,
            'message' => $delete ? 'Item berhasil dihapus' : 'Gagal menghapus item'
        ]);
    }
}
