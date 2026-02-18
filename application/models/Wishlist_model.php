<?php
class Wishlist_model extends CI_Model
{
    public function get_by_customer($id_customer)
    {
        return $this->db
            ->select('MAX(wishlist.id_wishlist) AS id_wishlist, item.id_item, item.merk, item.nama_item, item.gambar_item, item.usia_min, item.usia_max, kategori.nama_kategori,
            MAX(promo.persen_promo) AS persen_promo,MAX(promo.harga_promo) AS harga_promo,COALESCE(MIN(CASE WHEN item_detail.stok > 0 THEN item_detail.harga END),
            MIN(item_detail.harga)) AS harga_termurah, item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new,
            SUM(item_detail.stok) AS total_stok,
            MAX( CASE WHEN promo.id_promo IS NOT NULL AND CURDATE() BETWEEN promo.`dari` AND promo.`hingga`
            AND promo.kuota > 0 THEN 1 ELSE 0 END ) AS is_sale')
            ->from('wishlist')
            ->join('item', 'wishlist.id_item = item.id_item')
            ->join('kategori', 'item.id_kategori = kategori.id_kategori')
            ->join('item_detail', 'item.id_item = item_detail.id_item')
            ->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left')
            ->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left')
            ->where('wishlist.id_customer', $id_customer)
            ->group_by('item.id_item')
            ->get()
            ->result();
    }

    public function generate_id()
    {
        $this->db->select('RIGHT(id_wishlist,3) as no', false);
        $this->db->order_by('id_wishlist', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('wishlist');

        if ($query->num_rows() > 0) {
            $no = intval($query->row()->no) + 1;
        } else {
            $no = 1;
        }

        return 'WSL' . str_pad($no, 3, '0', STR_PAD_LEFT);
    }
    public function insert_wishlist($id_customer, $id_item)
    {
        $cek = $this->db->get_where('wishlist', [
            'id_customer' => $id_customer,
            'id_item' => $id_item
        ])->row();

        if ($cek)
            return false;

        return $this->db->insert('wishlist', [
            'id_wishlist' => $this->generate_id(),
            'id_customer' => $id_customer,
            'id_item' => $id_item
        ]);
    }
    public function is_exist($id_customer, $id_item)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('id_item', $id_item)
            ->get('wishlist')
            ->row();
    }

    public function delete_by_item($id_customer, $id_item)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('id_item', $id_item)
            ->delete('wishlist');
    }
}

