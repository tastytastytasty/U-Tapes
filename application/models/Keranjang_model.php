<?php
class Keranjang_model extends CI_Model
{
    public function get_by_customer($id_customer)
    {
        return $this->db->select(' cart.id_cart,cart.qty,cart.checklist,item.id_item,item.merk,item.nama_item,item.jenis_kelamin,item.usia_min,item.usia_max,item.gambar_item,
            kategori.nama_kategori,item_detail.id_item_detail,item_detail.warna,item_detail.kode_hex,item_detail.ukuran,item_detail.harga,item_detail.stok,item_detail.gambar,
            COALESCE(MIN(CASE WHEN item_detail.stok > 0 THEN item_detail.harga END),
            MIN(item_detail.harga)) AS harga_termurah,MAX(promo.persen_promo) AS persen_promo,MAX(promo.harga_promo) AS harga_promo,
            item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new, MAX(item_detail.harga * cart.qty) AS total,
            MAX(
                CASE 
                    WHEN promo.id_promo IS NOT NULL 
                    AND CURDATE() BETWEEN promo.`dari` AND promo.`hingga`
                    AND promo.kuota > 0 
                    THEN 1 ELSE 0 
                END
            ) AS is_sale
        ')
            ->from('cart')
            ->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail')
            ->join('item', 'item_detail.id_item = item.id_item')
            ->join('kategori', 'item.id_kategori = kategori.id_kategori')
            ->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left')
            ->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left')
            ->where('cart.id_customer', $id_customer)
            ->group_by('cart.id_cart')
            ->order_by('cart.id_cart', 'DESC')
            ->get()
            ->result();
    }

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
            $num = (int) substr($last->id_cart, 3) + 1;
        } else {
            $num = 1;
        }
        $data['id_cart'] = 'CRT' . str_pad($num, 3, '0', STR_PAD_LEFT);

        return $this->db->insert('cart', $data);
    }
    public function get_total_by_customer($id_customer)
    {
        $this->db->select('
            SUM(
                CASE 
                    WHEN item_detail.stok <= 0 THEN 0
                    WHEN p.persen_promo > 0 THEN (cart.qty * item_detail.harga) - ((cart.qty * item_detail.harga) * p.persen_promo / 100)
                    WHEN p.harga_promo > 0 THEN (cart.qty * item_detail.harga) - (p.harga_promo * cart.qty)
                    ELSE cart.qty * item_detail.harga
                END
            ) AS total
        ');
        $this->db->from('cart');
        $this->db->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail');
        $this->db->join('promo_detail pd', 'pd.id_item_detail = item_detail.id_item_detail', 'left');
        $this->db->join('promo p', 'p.id_promo = pd.id_promo', 'left');
        $this->db->where('cart.id_customer', $id_customer);
        return $this->db->get()->row()->total ?? 0;
    }
    public function is_in_cart($id_customer, $id_item_detail)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('id_item_detail', $id_item_detail)
            ->get('cart')
            ->row();
    }

    public function remove($id_customer, $id_item_detail)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('id_item_detail', $id_item_detail)
            ->delete('cart');
    }
    public function delete_by_id($id_cart)
    {
        return $this->db
            ->where('id_cart', $id_cart)
            ->delete('cart');
    }

    public function get_cart_item($id_cart, $id_customer)
    {
        return $this->db
            ->where('id_cart', $id_cart)
            ->where('id_customer', $id_customer)
            ->get('cart')
            ->row();
    }
}

