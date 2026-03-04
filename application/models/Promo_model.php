<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{
    /**
     * Get promo yang masih AKTIF (dalam periode & ada kuota)
     * 
     * @param string $jenis 'item' atau 'ongkir'
     * @return array
     */
    public function get_active_promos($jenis = 'item')
    {
        return $this->db
            ->where('jenis_promo', $jenis)
            ->where('kuota >', 0)
            ->where('CURDATE() BETWEEN `dari` AND `hingga`', NULL, FALSE)
            ->order_by('harga_minimal', 'ASC') // ✅ Fixed column name
            ->get('promo')
            ->result();
    }

    /**
     * Validate & get promo by code
     * 
     * @param string $kode_promo
     * @param string $jenis 'item' atau 'ongkir'
     * @param int $total_belanja
     * @return object|null
     */
    public function validate_promo($kode_promo, $jenis = 'item', $total_belanja = 0)
    {
        // ✅ STEP 1: Cari promo by code aja dulu (tanpa filter jenis)
        $promo = $this->db
            ->where('kode_promo', strtoupper($kode_promo))
            ->get('promo')
            ->row();

        // Cek apakah promo ada
        if (!$promo) {
            return [
                'valid' => false,
                'message' => 'Kode promo tidak ditemukan',
                'promo' => null,
                'debug' => [
                    'searched_code' => strtoupper($kode_promo),
                    'searched_jenis' => $jenis
                ]
            ];
        }
        
        // ✅ STEP 2: Validasi jenis promo (flexible matching)
        $valid_jenis = false;
        
        if ($jenis === 'item') {
            // Accept: 'item', 'Item', 'produk', 'Produk', 'barang', 'Barang', 'Diskon Biasa', 'diskon biasa'
            $valid_jenis = in_array(strtolower($promo->jenis_promo), [
                'item', 
                'produk', 
                'barang',
                'diskon biasa',
                'diskon',
                'potongan harga'
            ]);
        } elseif ($jenis === 'ongkir') {
            // Accept: 'ongkir', 'Ongkir', 'shipping', 'Shipping', 'pengiriman', 'Gratis Ongkir', 'gratis ongkir'
            $valid_jenis = in_array(strtolower($promo->jenis_promo), [
                'ongkir', 
                'shipping', 
                'pengiriman',
                'gratis ongkir',
                'free shipping',
                'ongkos kirim'
            ]);
        }
        
        if (!$valid_jenis) {
            return [
                'valid' => false,
                'message' => "Kode promo ini untuk {$promo->jenis_promo}, bukan untuk $jenis",
                'promo' => null,
                'debug' => [
                    'promo_jenis_from_db' => $promo->jenis_promo,
                    'requested_jenis' => $jenis,
                    'hint' => 'Gunakan promo ini di bagian ' . ($jenis === 'item' ? 'ongkir' : 'item')
                ]
            ];
        }

        // Cek apakah masih dalam periode
        $today = date('Y-m-d');
        if ($today < $promo->dari || $today > $promo->hingga) {
            return [
                'valid' => false,
                'message' => 'Promo sudah tidak berlaku',
                'promo' => null
            ];
        }

        // Cek kuota
        if ($promo->kuota <= 0) {
            return [
                'valid' => false,
                'message' => 'Kuota promo sudah habis',
                'promo' => null
            ];
        }

        // Cek minimal pembelian
        $min_pembelian = $promo->harga_minimal ?? $promo->minimal_pembelian ?? 0;
        if ($total_belanja < $min_pembelian) {
            return [
                'valid' => false,
                'message' => 'Minimal pembelian Rp ' . number_format($min_pembelian, 0, ',', '.'),
                'promo' => null
            ];
        }

        // Promo VALID
        return [
            'valid' => true,
            'message' => 'Promo berhasil diterapkan',
            'promo' => $promo
        ];
    }

    /**
     * Hitung diskon dari promo
     * 
     * @param object $promo
     * @param int $subtotal
     * @return int
     */
    public function calculate_discount($promo, $subtotal)
    {
        if (!$promo) return 0;

        // Cek tipe diskon
        if ($promo->persen_promo > 0) {
            // Diskon persentase
            $discount = floor($subtotal * ($promo->persen_promo / 100));
        } elseif ($promo->harga_promo > 0) {
            // Diskon fixed
            $discount = $promo->harga_promo;
        } else {
            $discount = 0;
        }

        // Diskon ga boleh lebih dari subtotal
        return min($discount, $subtotal);
    }

    /**
     * Kurangi sisa kuota promo setelah digunakan
     * 
     * @param string $id_promo
     * @return bool
     */
    public function use_promo($id_promo)
    {
        // ✅ FIX: Update sisa_kouta (bukan kuota)
        $this->db->set('sisa_kouta', 'sisa_kouta - 1', FALSE);
        $this->db->where('id_promo', $id_promo);
        return $this->db->update('promo');
    }

    /**
     * Get promo by ID
     * 
     * @param string $id_promo
     * @return object|null
     */
    public function get_by_id($id_promo)
    {
        return $this->db
            ->where('id_promo', $id_promo)
            ->get('promo')
            ->row();
    }
}