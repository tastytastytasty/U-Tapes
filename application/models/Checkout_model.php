<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    /**
     * Get cart items yang CHECKLIST = Yes
     * Cuma barang yang mau dibeli yang masuk checkout
     */
    public function get_checkout_items($id_customer)
    {
        $items = $this->db->select('
                cart.id_cart,
                cart.qty,
                cart.checklist,
                cart.id_item_detail,
                item.nama_item,
                item.gambar_item,
                item_detail.warna,
                item_detail.ukuran,
                item_detail.harga,
                item_detail.stok
            ')
            ->from('cart')
            ->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail')
            ->join('item', 'item_detail.id_item = item.id_item')
            ->where('cart.id_customer', $id_customer)
            ->where('cart.checklist', 'Yes') // ✅ FILTER CHECKLIST
            ->get()
            ->result();

        // Set default (no promo)
        foreach ($items as &$item) {
            $item->persen_promo = 0;
            $item->harga_promo = 0;
            $item->is_sale = 0;
        }

        return $items;
    }

    /**
     * Calculate summary - Based on checklist Yes items
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
     * Get final price - SIMPLE (no promo)
     */
    public function get_item_final_price($item)
    {
        return (int) $item->harga;
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
     * Delete cart items after successful checkout
     * 
     * @param string $id_customer
     * @return bool
     */
    public function clear_checkout_items($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('checklist', 'Yes')
            ->delete('cart');
    }
}