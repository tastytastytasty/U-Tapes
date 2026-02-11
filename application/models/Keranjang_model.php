<?php
class Keranjang_model extends CI_Model
{
    public function get_by_customer($id_customer)
    {
        return $this->db->select(' cart.id_cart,cart.qty,cart.checklist,item.id_item,item.merk,item.nama_item,item.gambar_item,
            kategori.nama_kategori,item_detail.id_item_detail,item_detail.warna,item_detail.ukuran,item_detail.harga,item_detail.gambar,COALESCE(MIN(CASE WHEN item_detail.stok > 0 THEN item_detail.harga END),
            MIN(item_detail.harga)) AS harga_termurah,item_detail.stok,MAX(promo.persen_promo) AS persen_promo,MAX(promo.harga_promo) AS harga_promo,
            item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new,
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
        return $this->db
            ->select('SUM(cart.qty * item_detail.harga) AS total')
            ->from('cart')
            ->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail')
            ->where('cart.id_customer', $id_customer)
            ->get()
            ->row()
            ->total;
    }

}

