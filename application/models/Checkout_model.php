<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    /**
     * Get cart items yang DIPILIH (checklist = Yes)
     * Ini dipanggil dari halaman checkout
     * Include: promo, is_new, is_sale data
     */
    public function get_checkout_items($id_customer)
    {
        $items = $this->db->select('
                cart.id_cart,
                cart.qty,
                cart.checklist,
                cart.id_item_detail,
                item.id_item,
                item.nama_item,
                item.gambar_item,
                item.created_at,
                item_detail.warna,
                item_detail.ukuran,
                item_detail.harga,
                item_detail.stok,
                item.created_at >= DATE_SUB(NOW(), INTERVAL 3 DAY) AS is_new,
                MAX(promo.persen_promo) AS persen_promo,
                MAX(promo.harga_promo) AS harga_promo,
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
            ->join('promo_detail', 'promo_detail.id_item_detail = item_detail.id_item_detail', 'left')
            ->join('promo', 'promo.id_promo = promo_detail.id_promo', 'left')
            ->where('cart.id_customer', $id_customer)
            ->where('cart.checklist', 'Yes') // ✅ FILTER: Cuma yang dipilih!
            ->group_by('cart.id_cart')
            ->get()
            ->result();

        return $items;
    }

    /**
     * Calculate summary - Based on checklist Yes items only
     */
    public function calculate_summary($cart_items)
    {
        $total_items = 0;
        $total_before = 0;

        foreach ($cart_items as $item) {
            $total_items += $item->qty;
            $total_before += ($item->harga * $item->qty);
        }

        return [
            'total_items' => $total_items,
            'total_before' => $total_before,
            'total_discount' => 0,
            'subtotal' => $total_before
        ];
    }

    /**
     * Get final price after discount
     * 
     * @param object $item Item dengan harga, persen_promo, harga_promo
     * @return int Final price per item
     */
    public function get_item_final_price($item)
    {
        $base_price = (int) $item->harga;
        
        // Cek apakah ada promo aktif
        if ($item->is_sale == 1) {
            // Promo persentase
            if ($item->persen_promo > 0) {
                $discount = floor($base_price * ($item->persen_promo / 100));
                return $base_price - $discount;
            }
            
            // Promo fixed (harga promo per item)
            if ($item->harga_promo > 0) {
                return max(0, $base_price - $item->harga_promo);
            }
        }
        
        // No promo
        return $base_price;
    }
    
    /**
     * Get ONLY checked items (checklist = Yes) untuk payment
     * 
     * @param string $id_customer
     * @return array
     */
    public function get_checked_items($id_customer)
    {
        return $this->db->select('
                cart.id_cart,
                cart.qty,
                cart.checklist,
                cart.id_item_detail,
                item.nama_item,
                item_detail.harga,
                item_detail.stok
            ')
            ->from('cart')
            ->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail')
            ->join('item', 'item_detail.id_item = item.id_item')
            ->where('cart.id_customer', $id_customer)
            ->where('cart.checklist', 'Yes') // ✅ CUMA YANG CHECKED
            ->get()
            ->result();
    }
    
    /**
     * Reduce stock after payment
     * 
     * @param array $cart_items Array of cart items with id_item_detail & qty
     * @return bool
     */
    public function reduce_stock($cart_items)
    {
        foreach ($cart_items as $item) {
            $this->db->set('stok', 'stok - ' . (int)$item->qty, FALSE);
            $this->db->where('id_item_detail', $item->id_item_detail);
            $this->db->update('item_detail');
            
            // Check if update failed
            if ($this->db->affected_rows() == 0) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Delete ONLY checked items (checklist = Yes) after successful checkout
     * Items yang ga di-check tetap ada di keranjang
     * 
     * @param string $id_customer
     * @return bool
     */
    public function clear_checkout_items($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('checklist', 'Yes') // ✅ Cuma hapus yang dipilih!
            ->delete('cart');
    }
}