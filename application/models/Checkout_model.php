<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    /**
     * Get ALL cart items - GA PAKE FILTER CHECKLIST
     * Nanti di frontend yang decide mana yang mau dibeli
     */
    public function get_checkout_items($id_customer)
    {
        $items = $this->db->select('
                cart.id_cart,
                cart.qty,
                cart.checklist,
                item.nama_item,
                item.gambar_item,
                item_detail.warna,
                item_detail.ukuran,
                item_detail.harga,
                item_detail.gambar
            ')
            ->from('cart')
            ->join('item_detail', 'cart.id_item_detail = item_detail.id_item_detail')
            ->join('item', 'item_detail.id_item = item.id_item')
            ->where('cart.id_customer', $id_customer)
            // Hapus filter checklist
            // ->where('cart.checklist', 'Yes')
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
     * Calculate summary - SIMPLE
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
            'total_discount' => 0, // Skip promo
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
}