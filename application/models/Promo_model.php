<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{
    /**
     * ✅ NEW: Get vouchers untuk display di offcanvas
     * Rules:
     * 1. Has kode_promo (not NULL/empty)
     * 2. Either:
     *    a) General promo (not in promo_detail)
     *    b) Item-specific promo (in promo_detail) - can be used for OTHER products
     * 
     * @param string $jenis 'item' atau 'ongkir'
     * @param array $cart_item_details Optional: Filter out promos already applied to cart items
     * @return array
     */
    public function get_voucher_cards($jenis = 'item', $cart_item_details = [])
    {
        $this->db
            ->select('promo.*')
            ->from('promo')
            ->where('promo.jenis_promo', $jenis)
            ->where('promo.sisa_kouta >', 0)
            ->where('promo.approval', 'Disetujui') // ✅ MUST BE APPROVED
            ->where('promo.status', 'Active') // ✅ MUST BE ACTIVE
            ->where('CURDATE() BETWEEN promo.dari AND promo.hingga', NULL, FALSE)
            ->where('promo.kode_promo IS NOT NULL', NULL, FALSE)
            ->where('promo.kode_promo !=', '')
            ->order_by('promo.harga_minimal', 'ASC');

        $promos = $this->db->get()->result();

        // ✅ Filter out item-specific promos that are already auto-applied to cart items
        if ($jenis === 'item' && !empty($cart_item_details)) {
            $filtered = [];
            foreach ($promos as $promo) {
                // Check if this promo is in promo_detail
                $promo_items = $this->db
                    ->select('id_item_detail')
                    ->where('id_promo', $promo->id_promo)
                    ->get('promo_detail')
                    ->result_array();

                $promo_item_ids = array_column($promo_items, 'id_item_detail');

                if (empty($promo_item_ids)) {
                    // General promo - always show
                    $filtered[] = $promo;
                } else {
                    // Item-specific promo - only show if cart doesn't have these items
                    $has_conflict = false;
                    foreach ($cart_item_details as $cart_item_id) {
                        if (in_array($cart_item_id, $promo_item_ids)) {
                            $has_conflict = true;
                            break;
                        }
                    }

                    if (!$has_conflict) {
                        $filtered[] = $promo;
                    }
                }
            }
            return $filtered;
        }

        return $promos;
    }

    /**
     * ✅ NEW: Get auto-apply promos (no code required)
     * Rules:
     * 1. kode_promo is NULL or empty
     * 2. Not in promo_detail (general only)
     * 3. Active & has quota
     * 
     * @param string $jenis 'item' atau 'ongkir'
     * @return array Sorted by value DESC (highest first)
     */
    public function get_auto_apply_promos($jenis = 'item')
    {
        $this->db
            ->select('promo.*')
            ->from('promo')
            ->where('promo.jenis_promo', $jenis)
            ->where('promo.sisa_kouta >', 0)
            ->where('promo.approval', 'Disetujui') // ✅ MUST BE APPROVED
            ->where('promo.status', 'Active') // ✅ MUST BE ACTIVE
            ->where('CURDATE() BETWEEN promo.dari AND promo.hingga', NULL, FALSE)
            ->group_start()
                ->where('promo.kode_promo IS NULL', NULL, FALSE)
                ->or_where('promo.kode_promo', '')
            ->group_end()
            // Only general promos (not in promo_detail)
            ->where('NOT EXISTS (SELECT 1 FROM promo_detail WHERE promo_detail.id_promo = promo.id_promo)', NULL, FALSE);

        $promos = $this->db->get()->result();

        // Sort by discount value DESC (highest first)
        usort($promos, function($a, $b) {
            $value_a = $a->harga_promo > 0 ? $a->harga_promo : ($a->persen_promo > 0 ? 9999999 : 0);
            $value_b = $b->harga_promo > 0 ? $b->harga_promo : ($b->persen_promo > 0 ? 9999999 : 0);
            return $value_b - $value_a;
        });

        return $promos;
    }

    /**
     * ✅ NEW: Apply best auto-promo and return the rest as voucher cards
     * 
     * @param string $jenis 'item' atau 'ongkir'
     * @param int $subtotal For calculating discount
     * @return array ['auto_applied' => promo|null, 'voucher_cards' => array]
     */
    public function get_promo_split($jenis, $subtotal = 0)
    {
        $auto_promos = $this->get_auto_apply_promos($jenis);

        $result = [
            'auto_applied' => null,
            'voucher_cards' => []
        ];

        if (!empty($auto_promos)) {
            // First one = highest value (already sorted)
            $result['auto_applied'] = $auto_promos[0];

            // Rest = voucher cards (convert to have kode_promo for display)
            for ($i = 1; $i < count($auto_promos); $i++) {
                $promo = $auto_promos[$i];
                // Generate temp code for display
                $promo->kode_promo = 'AUTO' . $promo->id_promo;
                $result['voucher_cards'][] = $promo;
            }
        }

        return $result;
    }

    /**
     * Validate & get promo by code
     * 
     * @param string $kode_promo
     * @param string $jenis 'item' atau 'ongkir'
     * @param int $total_belanja
     * @param array $cart_item_details Array of id_item_detail in cart
     * @return array
     */
    public function validate_promo($kode_promo, $jenis = 'item', $total_belanja = 0, $cart_item_details = [], $id_customer = null)
    {
        // Find promo
        $promo = $this->db
            ->where('kode_promo', strtoupper($kode_promo))
            ->where('approval', 'Disetujui') // ✅ MUST BE APPROVED
            ->where('status', 'Active') // ✅ MUST BE ACTIVE
            ->get('promo')
            ->row();

        if (!$promo) {
            return [
                'valid' => false,
                'message' => 'Kode promo tidak ditemukan',
                'promo' => null
            ];
        }

        // ✅ CHECK: Has user already used this promo?
        if ($id_customer && method_exists($this, 'check_user_promo_usage')) {
            $usage_check = $this->check_user_promo_usage($id_customer, $promo->id_promo);
            if (!$usage_check['allowed']) {
                return [
                    'valid' => false,
                    'message' => $usage_check['message'],
                    'promo' => null,
                    'reason' => 'usage_limit_exceeded'
                ];
            }
        }

        // Validate jenis
        $valid_jenis = false;
        if ($jenis === 'item') {
            $valid_jenis = in_array(strtolower($promo->jenis_promo), [
                'item', 'produk', 'barang', 'diskon biasa', 'diskon', 'potongan harga'
            ]);
        } elseif ($jenis === 'ongkir') {
            $valid_jenis = in_array(strtolower($promo->jenis_promo), [
                'ongkir', 'shipping', 'pengiriman', 'gratis ongkir', 'free shipping', 'ongkos kirim'
            ]);
        }

        if (!$valid_jenis) {
            return [
                'valid' => false,
                'message' => "Kode promo ini untuk {$promo->jenis_promo}, bukan untuk $jenis",
                'promo' => null
            ];
        }

        // Check period
        $today = date('Y-m-d');
        if ($today < $promo->dari || $today > $promo->hingga) {
            return [
                'valid' => false,
                'message' => 'Promo sudah tidak berlaku',
                'promo' => null
            ];
        }

        // Check quota
        if (!isset($promo->sisa_kouta) || $promo->sisa_kouta <= 0) {
            return [
                'valid' => false,
                'message' => 'Kuota promo sudah habis',
                'promo' => null
            ];
        }

        // Check minimal purchase
        $min_pembelian = $promo->harga_minimal ?? 0;
        if ($total_belanja < $min_pembelian) {
            return [
                'valid' => false,
                'message' => 'Minimal pembelian Rp ' . number_format($min_pembelian, 0, ',', '.'),
                'promo' => null
            ];
        }

        // ✅ FIXED: Item-specific promo validation
        if ($jenis === 'item' && !empty($cart_item_details)) {
            $promo_items = $this->db
                ->select('id_item_detail')
                ->where('id_promo', $promo->id_promo)
                ->get('promo_detail')
                ->result_array();

            $promo_item_ids = array_column($promo_items, 'id_item_detail');

            if (!empty($promo_item_ids)) {
                // This is an item-specific promo (PROMO001 for DTL001)
                // Check if cart HAS the eligible items
                $has_eligible = array_intersect($cart_item_details, $promo_item_ids);

                if (empty($has_eligible)) {
                    // Cart DOESN'T have eligible items → BLOCK
                    return [
                        'valid' => false,
                        'message' => 'Promo ini hanya untuk produk tertentu yang tidak ada di keranjang Anda',
                        'promo' => null,
                        'reason' => 'item_not_eligible'
                    ];
                }
                
                // Cart HAS eligible items → Continue validation (will be VALID if all checks pass)
            }
            // else: General promo (no promo_detail) → Continue validation
        }

        // Promo VALID
        return [
            'valid' => true,
            'message' => 'Promo berhasil diterapkan',
            'promo' => $promo
        ];
    }

    /**
     * Calculate discount from promo
     */
    public function calculate_discount($promo, $subtotal)
    {
        if (!$promo) return 0;

        if ($promo->persen_promo > 0) {
            $discount = floor($subtotal * ($promo->persen_promo / 100));
        } elseif ($promo->harga_promo > 0) {
            $discount = $promo->harga_promo;
        } else {
            $discount = 0;
        }

        return min($discount, $subtotal);
    }

    /**
     * Use promo (reduce quota)
     */
    public function use_promo($id_promo)
    {
        $this->db->set('sisa_kouta', 'sisa_kouta - 1', FALSE);
        $this->db->where('id_promo', $id_promo);
        return $this->db->update('promo');
    }

    /**
     * Get promo by ID
     */
    public function get_by_id($id_promo)
    {
        return $this->db
            ->where('id_promo', $id_promo)
            ->get('promo')
            ->row();
    }

    /**
     * Get item-specific promo for an item_detail
     */
    public function get_item_promo($id_item_detail)
    {
        return $this->db
            ->select('promo.*')
            ->from('promo')
            ->join('promo_detail', 'promo_detail.id_promo = promo.id_promo')
            ->where('promo_detail.id_item_detail', $id_item_detail)
            ->where('promo.sisa_kouta >', 0)
            ->where('CURDATE() BETWEEN promo.dari AND promo.hingga', NULL, FALSE)
            ->get()
            ->row();
    }

    /**
     * Check if promo is general (not item-specific)
     */
    public function is_general_promo($id_promo)
    {
        $count = $this->db
            ->where('id_promo', $id_promo)
            ->count_all_results('promo_detail');

        return ($count == 0);
    }

    /**
     * Get items affected by promo
     */
    public function get_promo_items($id_promo)
    {
        $result = $this->db
            ->select('id_item_detail')
            ->where('id_promo', $id_promo)
            ->get('promo_detail')
            ->result();

        return array_column($result, 'id_item_detail');
    }

    /**
     * DEPRECATED - Use get_voucher_cards() instead
     */
    public function get_active_promos($jenis = 'item')
    {
        return $this->db
            ->where('jenis_promo', $jenis)
            ->where('sisa_kouta >', 0)
            ->where('CURDATE() BETWEEN `dari` AND `hingga`', NULL, FALSE)
            ->order_by('harga_minimal', 'ASC')
            ->get('promo')
            ->result();
    }

    /**
     * DEPRECATED - Use get_voucher_cards() instead
     */
    public function get_general_vouchers($jenis = 'item')
    {
        return $this->get_voucher_cards($jenis);
    }

    /**
     * ✅ NEW: Check if user has already used this promo
     * Prevents multiple usage of same promo code per user
     * 
     * @param string $id_customer
     * @param string $id_promo
     * @return array ['allowed' => bool, 'message' => string, 'usage_count' => int]
     */
    public function check_user_promo_usage($id_customer, $id_promo)
    {
        // Check if promo_usage table exists
        $table_exists = $this->db->table_exists('promo_usage');
        
        if (!$table_exists) {
            // Table doesn't exist yet - allow usage (graceful degradation)
            return [
                'allowed' => true,
                'message' => 'Promo usage tracking not configured',
                'usage_count' => 0
            ];
        }

        // Count how many times user has used this promo
        $usage_count = $this->db
            ->where('id_customer', $id_customer)
            ->where('id_promo', $id_promo)
            ->count_all_results('promo_usage');

        // If already used once, block it (1 time per customer per promo)
        if ($usage_count >= 1) {
            return [
                'allowed' => false,
                'message' => 'Anda sudah pernah menggunakan promo ini',
                'usage_count' => $usage_count
            ];
        }

        return [
            'allowed' => true,
            'message' => 'Promo dapat digunakan',
            'usage_count' => $usage_count
        ];
    }

    /**
     * ✅ NEW: Record promo usage for audit trail
     * Called after promo is successfully applied and transaction is completed
     * 
     * @param string $id_customer
     * @param string $id_promo
     * @param string $id_transaksi
     * @param double $discount_amount
     * @return bool
     */
    public function record_promo_usage($id_customer, $id_promo, $id_transaksi, $discount_amount = 0)
    {
        // Check if table exists
        $table_exists = $this->db->table_exists('promo_usage');
        
        if (!$table_exists) {
            log_message('debug', 'promo_usage table does not exist - skipping usage record');
            return true; // Still return true to not break transactions
        }

        $data = [
            'id_customer' => $id_customer,
            'id_promo' => $id_promo,
            'id_transaksi' => $id_transaksi,
            'discount_amount' => $discount_amount,
            'used_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('promo_usage', $data);
    }
}