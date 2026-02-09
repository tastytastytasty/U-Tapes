<?php
class Keranjang_model extends CI_Model
{
    public function get_item_detail($id_item, $warna, $ukuran)
    {
        return $this->db
            ->where('id_item', $id_item)
            ->where('warna', $warna)
            ->where('ukuran', $ukuran)
            ->get('item_detail')
            ->row();
    }

    public function add_to_cart($data)
    {
        $last = $this->db->select('id_cart')->order_by('id_cart', 'DESC')->limit(1)->get('cart')->row();
        if ($last) {
            $num = (int)substr($last->id_cart, 3) + 1;
        } else {
            $num = 1;
        }
        $data['id_cart'] = 'CRT' . str_pad($num, 3, '0', STR_PAD_LEFT);

        return $this->db->insert('cart', $data);
    }
}

