<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    private $table = 'transaksi';

    /**
     * Insert transaksi baru
     */
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Get transaksi by ID
     */
    public function get_by_id($id_transaksi) {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->get($this->table)
            ->row();
    }

    /**
     * Get transaksi by customer ID
     */
    public function get_by_customer($id_customer, $limit = 10, $offset = 0) {
        return $this->db
            ->where('id_customer', $id_customer)
            ->order_by('tanggal', 'DESC')
            ->limit($limit, $offset)
            ->get($this->table)
            ->result();
    }

    /**
     * Update transaksi
     */
    public function update($id_transaksi, $data) {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->update($this->table, $data);
    }

    /**
     * Delete transaksi
     */
    public function delete($id_transaksi) {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->delete($this->table);
    }

    /**
     * Get semua transaksi dengan pagination
     */
    public function get_all($limit = 10, $offset = 0) {
        return $this->db
            ->order_by('tanggal', 'DESC')
            ->limit($limit, $offset)
            ->get($this->table)
            ->result();
    }

    /**
     * Count total transaksi
     */
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    /**
     * Get total transaksi by date range
     */
    public function get_by_date_range($start_date, $end_date) {
        return $this->db
            ->where('tanggal >=', $start_date)
            ->where('tanggal <=', $end_date)
            ->order_by('tanggal', 'DESC')
            ->get($this->table)
            ->result();
    }

    /**
     * Get total penjualan hari ini
     */
    public function get_today_total() {
        $result = $this->db
            ->select_sum('total')
            ->where('tanggal', date('Y-m-d'))
            ->get($this->table)
            ->row();

        return $result ? $result->total : 0;
    }

    /**
     * Get statistik transaksi by metode pembayaran
     */
    public function get_stats_by_payment_method() {
        return $this->db
            ->select('metode_pembayaran, COUNT(*) as jumlah, SUM(total) as total_nilai')
            ->group_by('metode_pembayaran')
            ->get($this->table)
            ->result();
    }

    /**
     * Get transaksi by status
     */
    public function get_by_status($status, $limit = 10, $offset = 0) {
        return $this->db
            ->where('status_transaksi', $status)
            ->order_by('tanggal', 'DESC')
            ->limit($limit, $offset)
            ->get($this->table)
            ->result();
    }

    /**
     * Get statistik transaksi by status
     */
    public function get_stats_by_status() {
        return $this->db
            ->select('status_transaksi, COUNT(*) as jumlah')
            ->group_by('status_transaksi')
            ->get($this->table)
            ->result();
    }

    /**
     * Get transaksi by no_nota
     */
    public function get_by_no_nota($no_nota) {
        return $this->db
            ->where('no_nota', $no_nota)
            ->get($this->table)
            ->row();
    }

    /**
     * Count transaksi by customer and status
     */
    public function count_by_customer_status($id_customer, $status) {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('status_transaksi', $status)
            ->count_all_results($this->table);
    }
}