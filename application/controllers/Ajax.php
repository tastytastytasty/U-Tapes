<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model');
    }

    public function get_ukuran()
    {
        $id_item = $this->input->post('id_item');
        $warna = $this->input->post('warna');
        $ukuran = $this->Item_model->get_ukuran($id_item, $warna);
        if (!$ukuran) {
            echo '<div class="size-box disabled">Tidak tersedia</div>';
            return;
        }
        foreach ($ukuran as $u) {
            $disabled = $u->stok <= 0 ? 'disabled' : '';
            echo '<div class="size-box ' . $disabled . '" data-ukuran="' . $u->ukuran . '">'
                . $u->ukuran .
                '</div>';
        }
    }
    public function get_detail()
    {
        $id_item = $this->input->post('id_item');
        $warna = $this->input->post('warna');
        $ukuran = $this->input->post('ukuran');
        $id_customer = $this->session->userdata('id_customer');

        $detail = $this->Item_model->get_by_option($id_item, $warna, $ukuran);

        if (!$detail) {
            echo json_encode([
                'success' => false,
                'harga' => 0,
                'harga_asli' => 0,
                'harga_diskon' => 0,
                'is_sale' => false,
                'stok' => 0,
                'id_item_detail' => null,
                'is_in_cart' => false
            ]);
            return;
        }

        $promo = $this->db
            ->select('promo.persen_promo, promo.harga_promo')
            ->from('promo_detail')
            ->join('promo', 'promo.id_promo = promo_detail.id_promo', 'inner')
            ->where('promo_detail.id_item_detail', $detail->id_item_detail)
            ->where('CURDATE() BETWEEN promo.dari AND promo.hingga')
            ->where('promo.kuota >', 0)
            ->order_by('promo.persen_promo', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        $harga_asli = (int) $detail->harga;
        $harga_diskon = $harga_asli;
        $is_sale = false;
        $persen_promo = 0;
        $harga_promo = 0;

        if ($promo) {
            $is_sale = true;
            $persen_promo = (int) $promo->persen_promo;
            $harga_promo = (int) $promo->harga_promo;

            if ($persen_promo > 0) {
                $harga_diskon = $harga_asli - ($harga_asli * $persen_promo / 100);
            } elseif ($harga_promo > 0) {
                $harga_diskon = $harga_asli - $harga_promo;
            }
        }

        $this->load->model('Keranjang_model');
        $is_in_cart = false;
        if ($id_customer) {
            $is_in_cart = $this->Keranjang_model
                ->is_in_cart($id_customer, $detail->id_item_detail);
        }

        echo json_encode([
            'success' => true,
            'id_item_detail' => $detail->id_item_detail,
            'harga' => $harga_asli,
            'harga_asli' => $harga_asli,
            'harga_diskon' => (int) $harga_diskon,
            'is_sale' => $is_sale,
            'persen_promo' => $persen_promo,
            'harga_promo' => $harga_promo,
            'stok' => (int) $detail->stok,
            'is_in_cart' => $is_in_cart
        ]);
    }

    public function get_gambar_warna()
    {
        $id_item = $this->input->post('id_item');
        $warna = $this->input->post('warna');

        $gambar = $this->db
            ->where('id_item', $id_item)
            ->where('warna', $warna)
            ->order_by('harga', 'ASC')
            ->limit(1)
            ->get('item_detail')
            ->row();

        echo json_encode([
            'gambar' => $gambar ? $gambar->gambar : null
        ]);
    }

    public function toggle_wishlist()
    {
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['status' => 'login']);
            return;
        }

        $id_customer = $this->session->userdata('id_customer');
        $id_item = $this->input->post('id_item');

        $this->load->model('Wishlist_model');

        if ($this->Wishlist_model->exists($id_customer, $id_item)) {
            $this->Wishlist_model->delete($id_customer, $id_item);
            echo json_encode(['status' => 'removed']);
        } else {
            $this->Wishlist_model->insert($id_customer, $id_item);
            echo json_encode(['status' => 'added']);
        }
    }

}
