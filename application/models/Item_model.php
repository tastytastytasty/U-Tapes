<?php
class Item_model extends CI_Model
{
    public function get_item($id_item)
    {
        $this->db->select('item.*,
                            kategori.nama_kategori,
                            MAX(promo.persen_promo) AS persen_promo,
                            MAX(promo.harga_promo) AS harga_promo,
                            item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new,
                            MAX( CASE WHEN promo.id_promo IS NOT NULL AND CURDATE() BETWEEN promo.`dari` AND promo.`hingga`
                                AND promo.kuota > 0 THEN 1 ELSE 0 END ) AS is_sale,
                            COALESCE(MIN(CASE WHEN item_detail.stok > 0 THEN item_detail.harga END), MIN(item_detail.harga)) AS harga_termurah');
        $this->db->from('item');
        $this->db->join('kategori', 'kategori.id_kategori = item.id_kategori');
        $this->db->join('item_detail', 'item_detail.id_item = item.id_item');
        $this->db->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left');
        $this->db->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left');
        $this->db->where('item.id_item', $id_item);
        return $this->db->get()->row();
    }
    public function get_termurah($id_item)
    {
        return $this->db
            ->where('id_item', $id_item)
            ->order_by('harga', 'ASC')
            ->get('item_detail')
            ->row();
    }
    public function get_warna($id_item)
    {
        return $this->db
            ->select('warna, kode_hex,MIN(CASE WHEN stok > 0 THEN gambar END) AS gambar')
            ->from('item_detail')
            ->where('id_item', $id_item)
            ->group_by('warna, kode_hex')
            ->get()
            ->result();
    }
    public function get_ukuran($id_item, $warna)
    {
        return $this->db
            ->select('ukuran, SUM(stok) as stok')
            ->where('id_item', $id_item)
            ->where('warna', $warna)
            ->group_by('ukuran')
            ->get('item_detail')
            ->result();
    }

    public function get_by_option($id_item, $warna, $ukuran)
    {
        return $this->db
            ->where('id_item', $id_item)
            ->where('warna', $warna)
            ->where('ukuran', $ukuran)
            ->get('item_detail')
            ->row();
    }

    public function get_items_with_wishlist($id_customer = null, $filter = [], $limit = null, $offset = 0)
    {
        $this->db->reset_query();
        $this->db->select("
        item.id_item,
        item.merk,
        item.nama_item,
        item.gambar_item,
        kategori.nama_kategori,
        MAX(promo.persen_promo) AS persen_promo,
        MAX(promo.harga_promo) AS harga_promo,
        COALESCE(MIN(CASE WHEN item_detail.stok > 0 THEN item_detail.harga END), MIN(item_detail.harga)) AS harga_termurah,
        SUM(item_detail.stok) AS total_stok,
        MAX(IF(wishlist.id_item IS NULL, 0, 1)) AS in_wishlist,
        item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new,
        MAX( CASE WHEN promo.id_promo IS NOT NULL AND CURDATE() BETWEEN promo.`dari` AND promo.`hingga`
             AND promo.kuota > 0 THEN 1 ELSE 0 END ) AS is_sale
        ");
        $this->db->from('item');
        $this->db->join('kategori', 'kategori.id_kategori = item.id_kategori');
        $this->db->join('item_detail', 'item_detail.id_item = item.id_item');
        $this->db->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left');
        $this->db->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left');
        if ($id_customer) {
            $this->db->join(
                'wishlist',
                'wishlist.id_item = item.id_item 
             AND wishlist.id_customer = ' . $this->db->escape($id_customer),
                'left'
            );
        } else {
            $this->db->join('wishlist', '1=0', 'left');
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('item.nama_item', $filter['keyword']);
            $this->db->or_like('item.merk', $filter['keyword']);
            $this->db->group_end();
        }
        if (!empty($filter['sex'])) {
            $this->db->where('item.jenis_kelamin', $filter['sex']);
        }
        if (!empty($filter['kategori'])) {
            $this->db->where_in('item.id_kategori', $filter['kategori']);
        }
        $this->db->group_by('item.id_item');
        $this->db->order_by('(SUM(item_detail.stok) <= 0)', 'ASC');
        switch ($filter['sort'] ?? '') {
            case 'terlama':
                $this->db->order_by('item.id_item', 'ASC');
                break;
            case 'harga_tertinggi':
                $this->db->order_by('harga_termurah', 'DESC');
                break;
            case 'harga_terendah':
                $this->db->order_by('harga_termurah', 'ASC');
                break;
            default:
                $this->db->order_by('item.id_item', 'DESC');
        }
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }
    public function count_items_with_filter($filter)
    {
        $this->db->select('COUNT(DISTINCT item.id_item) AS total');
        $this->db->from('item');
        $this->db->join('item_detail', 'item_detail.id_item = item.id_item');

        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('item.nama_item', $filter['keyword']);
            $this->db->or_like('item.merk', $filter['keyword']);
            $this->db->group_end();
        }

        if (!empty($filter['sex'])) {
            $this->db->where('item.jenis_kelamin', $filter['sex']);
        }

        if (!empty($filter['kategori'])) {
            $this->db->where_in('item.id_kategori', $filter['kategori']);
        }

        return $this->db->get()->row()->total;
    }
    public function total_stok_item($id_item)
    {
        return $this->db
            ->select('SUM(stok) as total')
            ->where('id_item', $id_item)
            ->get('item_detail')
            ->row()
            ->total ?? 0;
    }
    public function get_kategori()
    {
        return $this->db->get('kategori')->result();
    }

}