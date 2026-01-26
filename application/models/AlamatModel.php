<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlamatModel extends CI_Model
{
    private $table = 'alamat';

    /**
     * Ambil semua alamat customer dengan nama wilayah lengkap
     */
    public function getAlamatWithNames($id_customer)
    {
        return $this->db
            ->select('a.*, 
                      p.nama AS nama_provinsi, 
                      k.nama AS nama_kabupaten, 
                      kc.nama AS nama_kecamatan, 
                      kl.nama AS nama_kelurahan')
            ->from('alamat a')
            ->join('provinsi p', 'p.provinsi_id = a.provinsi_id', 'left')
            ->join('kabupaten k', 'k.kabupaten_id = a.kabupaten_id', 'left')
            ->join('kecamatan kc', 'kc.kecamatan_id = a.kecamatan_id', 'left')
            ->join('kelurahan kl', 'kl.kelurahan_id = a.kelurahan_id', 'left')
            ->where('a.id_customer', $id_customer)
            ->order_by('a.is_default', 'DESC')
            ->get()
            ->result();
    }

    /**
     * Ambil satu alamat berdasarkan ID
     */
    public function getById($id)
    {
        return $this->db->where('id_alamat', $id)->get($this->table)->row();
    }

    /**
     * Ambil satu alamat dengan nama wilayah lengkap
     */
    public function getByIdWithNames($id)
    {
        return $this->db
            ->select('a.*, 
                      p.nama AS nama_provinsi, 
                      k.nama AS nama_kabupaten, 
                      kc.nama AS nama_kecamatan, 
                      kl.nama AS nama_kelurahan')
            ->from('alamat a')
            ->join('provinsi p', 'p.provinsi_id = a.provinsi_id', 'left')
            ->join('kabupaten k', 'k.kabupaten_id = a.kabupaten_id', 'left')
            ->join('kecamatan kc', 'kc.kecamatan_id = a.kecamatan_id', 'left')
            ->join('kelurahan kl', 'kl.kelurahan_id = a.kelurahan_id', 'left')
            ->where('a.id_alamat', $id)
            ->get()
            ->row();
    }

    /**
     * Ambil alamat default customer
     */
    public function getDefaultAddress($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->get($this->table)
            ->row();
    }

    /**
     * Ambil alamat default dengan nama wilayah lengkap
     */
    public function getDefaultAddressWithNames($id_customer)
    {
        return $this->db
            ->select('a.*, 
                      p.nama AS nama_provinsi, 
                      k.nama AS nama_kabupaten, 
                      kc.nama AS nama_kecamatan, 
                      kl.nama AS nama_kelurahan')
            ->from('alamat a')
            ->join('provinsi p', 'p.provinsi_id = a.provinsi_id', 'left')
            ->join('kabupaten k', 'k.kabupaten_id = a.kabupaten_id', 'left')
            ->join('kecamatan kc', 'kc.kecamatan_id = a.kecamatan_id', 'left')
            ->join('kelurahan kl', 'kl.kelurahan_id = a.kelurahan_id', 'left')
            ->where('a.id_customer', $id_customer)
            ->where('a.is_default', 1)
            ->get()
            ->row();
    }

    /**
     * Tambah alamat baru
     */
    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update alamat
     */
    public function update($id, $data)
    {
        return $this->db->where('id_alamat', $id)->update($this->table, $data);
    }

    /**
     * Hapus alamat
     */
    public function delete($id)
    {
        return $this->db->where('id_alamat', $id)->delete($this->table);
    }

    /**
     * Generate ID alamat otomatis
     */
    public function generateId()
    {
        $last = $this->db->select('id_alamat')
                        ->order_by('id_alamat', 'DESC')
                        ->limit(1)
                        ->get($this->table)
                        ->row();
        
        if (!$last) return 'ALM001';
        
        $num = intval(substr($last->id_alamat, 3)) + 1;
        return 'ALM' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Unset semua alamat default customer
     */
    public function unsetAllDefault($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->update($this->table, ['is_default' => 0]);
    }

    /**
     * Set alamat sebagai default
     */
    public function setAsDefault($id_alamat, $id_customer)
    {
        // Reset semua alamat customer menjadi tidak default
        $this->unsetAllDefault($id_customer);

        // Set alamat yang dipilih menjadi default
        return $this->db
            ->where('id_alamat', $id_alamat)
            ->where('id_customer', $id_customer)
            ->update($this->table, ['is_default' => 1]);
    }

    /**
     * Cek apakah customer sudah punya alamat default
     */
    public function hasDefault($id_customer)
    {
        $count = $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->count_all_results($this->table);
        return $count > 0;
    }

    /**
     * Hitung jumlah alamat customer
     */
    public function countByCustomer($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->count_all_results($this->table);
    }
}