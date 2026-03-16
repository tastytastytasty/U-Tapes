<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('M_pembayaran');
        $this->load->model('Checkout_model');
        $this->load->model('Promo_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('id_customer')) {
            redirect('login');
        }
    }

    public function simpan() {
        header('Content-Type: application/json');
        ob_clean();

        $this->db->trans_start();

        try {
            $total = $this->input->post('total');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $bayar = $this->input->post('bayar');
            $ongkir = $this->input->post('ongkir');
            $kode_promo_item = $this->input->post('kode_promo_item');
            $kode_promo_ongkir = $this->input->post('kode_promo_ongkir');
            $diskon_voucher = $this->input->post('diskon_voucher');
            $diskon_ongkir = $this->input->post('diskon_ongkir');
            $id_rekening = $this->input->post('id_rekening');  // ✅ GET id_rekening

            if (empty($total) || empty($metode_pembayaran)) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
                exit;
            }

            $valid_methods = ['Tunai', 'E-wallet', 'Rekening'];
            if (!in_array($metode_pembayaran, $valid_methods)) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Metode pembayaran tidak valid']);
                exit;
            }
            
            // ✅ VALIDASI: Kalo pilih Rekening, harus ada id_rekening
            if ($metode_pembayaran == 'Rekening' && empty($id_rekening)) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Silakan pilih rekening tujuan transfer']);
                exit;
            }

            $id_customer = $this->session->userdata('id_customer');
            
            if (empty($id_customer)) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Anda harus login terlebih dahulu']);
                exit;
            }

            $checkout_items = $this->Checkout_model->get_checkout_items($id_customer);

            if (empty($checkout_items)) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Keranjang kosong']);
                exit;
            }

            $diskon_item_total = 0;
            foreach ($checkout_items as $item) {
                if (isset($item->is_sale) && $item->is_sale == 1) {
                    $harga_asli = $item->harga * $item->qty;
                    $harga_final = $this->Checkout_model->get_item_final_price($item) * $item->qty;
                    $diskon_item_total += ($harga_asli - $harga_final);
                }
            }

            $no_nota = $this->generate_no_nota();

            $data_transaksi = [
                'no_nota'            => $no_nota,
                'tanggal'            => date('Y-m-d'),
                'id_customer'        => $id_customer,
                'diskon_item'        => floatval($diskon_item_total),
                'diskon_voucher'     => floatval($diskon_voucher ?? 0),
                'diskon_ongkir'      => floatval($diskon_ongkir ?? 0),
                'total'              => intval($total),
                'metode_pembayaran'  => $metode_pembayaran,
                'bayar'              => intval($bayar),
                'ongkir'             => intval($ongkir),
                'status_transaksi'   => 'Menunggu',
                'id_rekening'        => intval($id_rekening ?? 0),  // ✅ SAVE id_rekening

                // ── Tenggat pembayaran: 1 jam dari sekarang ──────────
                'tenggat_pembayaran' => date('Y-m-d H:i:s', strtotime('+1 hour')),
            ];

            $insert = $this->Transaksi_model->insert($data_transaksi);

            if (!$insert) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
                exit;
            }

            $id_transaksi = $this->db->insert_id();

            $insert_payment = $this->M_pembayaran->insert([
                'tanggal'      => date('Y-m-d H:i:s'),
                'id_transaksi' => $id_transaksi,
                'status'       => 'Menunggu'
            ]);

            if (!$insert_payment) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Gagal membuat pembayaran']);
                exit;
            }

            $reduce_stock = $this->Checkout_model->reduce_stock($checkout_items);

            if (!$reduce_stock) {
                $this->db->trans_rollback();
                echo json_encode(['success' => false, 'message' => 'Gagal mengurangi stok']);
                exit;
            }

            foreach ($checkout_items as $item) {
                // INSERT transaksi_item
                $this->db->insert('transaksi_item', [
                    'id_transaksi'   => $id_transaksi,
                    'id_item_detail' => $item->id_item_detail,
                    'qty'            => $item->qty,
                    'Total'          => $item->harga * $item->qty
                ]);
                
                $id_transaksi_item = $this->db->insert_id();
                
                // INSERT transaksi_promo_item (cuma yang ada promo dari toko)
                if (isset($item->is_sale) && $item->is_sale == 1) {
                    $promo_detail = $this->db
                        ->select('id_promo_detail')
                        ->where('id_item_detail', $item->id_item_detail)
                        ->get('promo_detail')
                        ->row();
                    
                    if ($promo_detail) {
                        $harga_asli  = $item->harga * $item->qty;
                        $harga_promo = $this->Checkout_model->get_item_final_price($item) * $item->qty;
                        $nilai_diskon = $harga_asli - $harga_promo;
                        
                        $this->db->insert('transaksi_promo_item', [
                            'id_transaksi_item' => $id_transaksi_item,
                            'id_promo_detail'   => $promo_detail->id_promo_detail,
                            'nilai'             => $nilai_diskon
                        ]);
                    }
                }
                
                // LOG STOK
                $id_stok = $this->generate_id_stok();
                
                $current_stock = $this->db
                    ->select('stok')
                    ->where('id_item_detail', $item->id_item_detail)
                    ->get('item_detail')
                    ->row();
                
                $stok_tersedia = $current_stock ? $current_stock->stok : 0;
                
                $data_log_stok = [
                    'id_stok'        => $id_stok,
                    'id_item_detail' => $item->id_item_detail,
                    'keterangan'     => 'Pembelian oleh customer - Transaksi ' . $no_nota,
                    'stok_terpakai'  => -1 * intval($item->qty),
                    'stok_tersedia'  => $stok_tersedia,
                    'tanggal'        => date('Y-m-d H:i:s'),
                    'id_user'        => $id_customer
                ];
                
                $this->db->insert('stok', $data_log_stok);
            }

            $promo_used = [];
            
            // INSERT transaksi_promo (voucher item)
            if (!empty($kode_promo_item)) {
                $promo_item = $this->db
                    ->where('kode_promo', strtoupper($kode_promo_item))
                    ->get('promo')
                    ->row();
                
                // ✅ VALIDASI: Check sisa_kouta (bukan kuota)
                if ($promo_item && isset($promo_item->sisa_kouta) && $promo_item->sisa_kouta > 0) {
                    $insert_promo = $this->db->insert('transaksi_promo', [
                        'id_promo'     => $promo_item->id_promo,
                        'id_transaksi' => $id_transaksi,
                        'id_customer'  => $id_customer
                    ]);
                    
                    if ($insert_promo) {
                        // ✅ KURANGI sisa_kouta
                        $reduce_quota = $this->Promo_model->use_promo($promo_item->id_promo);
                        if ($reduce_quota) {
                            $promo_used[] = $kode_promo_item;
                            error_log('✅ Promo item ' . $kode_promo_item . ' berhasil disimpan & kuota berkurang');
                        } else {
                            error_log('⚠️ Promo item ' . $kode_promo_item . ' disimpan tapi kuota gagal berkurang');
                        }
                    } else {
                        error_log('❌ Gagal insert transaksi_promo item: ' . $kode_promo_item);
                    }
                } else {
                    error_log('⚠️ Promo item ' . $kode_promo_item . ' tidak ditemukan atau kuota habis (sisa_kouta: ' . ($promo_item->sisa_kouta ?? 'NULL') . ')');
                }
            }
            
            // INSERT transaksi_promo (voucher ongkir)
            if (!empty($kode_promo_ongkir)) {
                $promo_ongkir = $this->db
                    ->where('kode_promo', strtoupper($kode_promo_ongkir))
                    ->get('promo')
                    ->row();
                
                // ✅ VALIDASI: Check sisa_kouta (bukan kuota)
                if ($promo_ongkir && isset($promo_ongkir->sisa_kouta) && $promo_ongkir->sisa_kouta > 0) {
                    $insert_promo = $this->db->insert('transaksi_promo', [
                        'id_promo'     => $promo_ongkir->id_promo,
                        'id_transaksi' => $id_transaksi,
                        'id_customer'  => $id_customer
                    ]);
                    
                    if ($insert_promo) {
                        // ✅ KURANGI sisa_kouta
                        $reduce_quota = $this->Promo_model->use_promo($promo_ongkir->id_promo);
                        if ($reduce_quota) {
                            $promo_used[] = $kode_promo_ongkir;
                            error_log('✅ Promo ongkir ' . $kode_promo_ongkir . ' berhasil disimpan & kuota berkurang');
                        } else {
                            error_log('⚠️ Promo ongkir ' . $kode_promo_ongkir . ' disimpan tapi kuota gagal berkurang');
                        }
                    } else {
                        error_log('❌ Gagal insert transaksi_promo ongkir: ' . $kode_promo_ongkir);
                    }
                } else {
                    error_log('⚠️ Promo ongkir ' . $kode_promo_ongkir . ' tidak ditemukan atau kuota habis (sisa_kouta: ' . ($promo_ongkir->sisa_kouta ?? 'NULL') . ')');
                }
            }

            $this->Checkout_model->clear_checkout_items($id_customer);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['success' => false, 'message' => 'Transaksi gagal']);
                exit;
            }

            echo json_encode([
                'success'      => true,
                'message'      => 'Pesanan berhasil dibuat!',
                'id_transaksi' => $id_transaksi,
                'no_nota'      => $no_nota,
                'promo_used'   => $promo_used,
                'redirect_url' => site_url('pembayaran/' . $no_nota)
            ]);
            exit;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            exit;
        }
    }

    private function generate_id_transaksi() {
        return null;
    }

    private function generate_no_nota() {
        $prefix = 'INV-' . date('Ym') . '-';
        
        $last_nota = $this->db
            ->select('no_nota')
            ->from('transaksi')
            ->like('no_nota', $prefix, 'after')
            ->order_by('no_nota', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        if ($last_nota) {
            $last_number = intval(substr($last_nota->no_nota, -4));
            $new_number  = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return $prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    private function generate_id_stok() {
        $last_stok = $this->db
            ->select('id_stok')
            ->from('stok')
            ->like('id_stok', 'STK', 'after')
            ->order_by('id_stok', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        if ($last_stok) {
            $last_number = intval(substr($last_stok->id_stok, 3));
            $new_number  = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'STK' . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    public function update_status() {
        header('Content-Type: application/json');

        try {
            $id_transaksi = $this->input->post('id_transaksi');
            $status       = $this->input->post('status');

            if (empty($id_transaksi) || empty($status)) {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
                exit;
            }

            $valid_status = ['dikemas', 'dikirim', 'diterima', 'dibatalkan'];
            if (!in_array($status, $valid_status)) {
                echo json_encode(['success' => false, 'message' => 'Status tidak valid']);
                exit;
            }

            $update = $this->Transaksi_model->update($id_transaksi, ['status_transaksi' => $status]);

            if ($update) {
                echo json_encode(['success' => true, 'message' => 'Status berhasil diupdate']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal update status']);
            }
            exit;

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            exit;
        }
    }

    public function detail($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id_transaksi);
        
        if (!$data['transaksi']) {
            show_404();
        }

        $this->load->view('transaksi/detail', $data);
    }

    public function riwayat() {
        $id_customer = $this->session->userdata('id_customer');
        $data['transaksi_list'] = $this->Transaksi_model->get_by_customer($id_customer);
        
        $this->load->view('transaksi/riwayat', $data);
    }
}