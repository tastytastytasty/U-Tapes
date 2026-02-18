<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlamatModel extends CI_Model
{
    private $table = 'alamat';

    /**
     * Ambil semua alamat customer dengan nama wilayah lengkap
     * ✅ OPTIMIZED: Query tanpa JOIN, ambil wilayah terpisah
     */
    public function getAlamatWithNames($id_customer)
    {
        // Query 1: Ambil alamat (TANPA JOIN ke wilayah)
        $alamat_list = $this->db
            ->where('id_customer', $id_customer)
            ->order_by('is_default', 'DESC')
            ->get('alamat')
            ->result();
        
        // Kalau ga ada alamat, return kosong
        if (empty($alamat_list)) {
            return [];
        }
        
        // Ambil semua ID wilayah yang unique
        $prov_ids = array_unique(array_column((array)$alamat_list, 'provinsi_id'));
        $kab_ids = array_unique(array_column((array)$alamat_list, 'kabupaten_id'));
        $kec_ids = array_unique(array_column((array)$alamat_list, 'kecamatan_id'));
        $kel_ids = array_unique(array_column((array)$alamat_list, 'kelurahan_id'));
        
        // Query 2: Ambil nama wilayah dalam 1 query (batch)
        $provinsi = $this->db->where_in('provinsi_id', $prov_ids)->get('provinsi')->result();
        $kabupaten = $this->db->where_in('kabupaten_id', $kab_ids)->get('kabupaten')->result();
        $kecamatan = $this->db->where_in('kecamatan_id', $kec_ids)->get('kecamatan')->result();
        $kelurahan = $this->db->where_in('kelurahan_id', $kel_ids)->get('kelurahan')->result();
        
        // Map ke array untuk lookup cepat
        $prov_map = [];
        foreach ($provinsi as $p) $prov_map[$p->provinsi_id] = $p->nama;
        
        $kab_map = [];
        foreach ($kabupaten as $k) $kab_map[$k->kabupaten_id] = $k->nama;
        
        $kec_map = [];
        foreach ($kecamatan as $kc) $kec_map[$kc->kecamatan_id] = $kc->nama;
        
        $kel_map = [];
        foreach ($kelurahan as $kl) $kel_map[$kl->kelurahan_id] = $kl->nama;
        
        // Gabungkan nama wilayah ke setiap alamat
        foreach ($alamat_list as &$alamat) {
            $alamat->nama_provinsi = $prov_map[$alamat->provinsi_id] ?? '';
            $alamat->nama_kabupaten = $kab_map[$alamat->kabupaten_id] ?? '';
            $alamat->nama_kecamatan = $kec_map[$alamat->kecamatan_id] ?? '';
            $alamat->nama_kelurahan = $kel_map[$alamat->kelurahan_id] ?? '';
        }
        
        return $alamat_list;
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
     * ✅ OPTIMIZED: 2 query sederhana vs 1 query dengan 4 JOIN
     */
    public function getByIdWithNames($id)
    {
        // Query 1: Ambil alamat
        $alamat = $this->db->where('id_alamat', $id)->get('alamat')->row();
        
        if (!$alamat) return null;
        
        // Query 2-5: Ambil nama wilayah (4 query simple lebih cepat dari 1 query dengan 4 JOIN!)
        $prov = $this->db->select('nama')->where('provinsi_id', $alamat->provinsi_id)->get('provinsi')->row();
        $kab = $this->db->select('nama')->where('kabupaten_id', $alamat->kabupaten_id)->get('kabupaten')->row();
        $kec = $this->db->select('nama')->where('kecamatan_id', $alamat->kecamatan_id)->get('kecamatan')->row();
        $kel = $this->db->select('nama')->where('kelurahan_id', $alamat->kelurahan_id)->get('kelurahan')->row();
        
        // Gabungkan
        $alamat->nama_provinsi = $prov->nama ?? '';
        $alamat->nama_kabupaten = $kab->nama ?? '';
        $alamat->nama_kecamatan = $kec->nama ?? '';
        $alamat->nama_kelurahan = $kel->nama ?? '';
        
        return $alamat;
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
     * ✅ OPTIMIZED: Tanpa JOIN
     */
    public function getDefaultAddressWithNames($id_customer)
    {
        // Query 1: Ambil alamat default
        $alamat = $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->get('alamat')
            ->row();
        
        if (!$alamat) return null;
        
        // Query 2-5: Ambil nama wilayah
        $prov = $this->db->select('nama')->where('provinsi_id', $alamat->provinsi_id)->get('provinsi')->row();
        $kab = $this->db->select('nama')->where('kabupaten_id', $alamat->kabupaten_id)->get('kabupaten')->row();
        $kec = $this->db->select('nama')->where('kecamatan_id', $alamat->kecamatan_id)->get('kecamatan')->row();
        $kel = $this->db->select('nama')->where('kelurahan_id', $alamat->kelurahan_id)->get('kelurahan')->row();
        
        // Gabungkan
        $alamat->nama_provinsi = $prov->nama ?? '';
        $alamat->nama_kabupaten = $kab->nama ?? '';
        $alamat->nama_kecamatan = $kec->nama ?? '';
        $alamat->nama_kelurahan = $kel->nama ?? '';
        
        return $alamat;
    }

    /**
     * Tambah alamat baru
     * ✅ FIX: AUTO SET is_default=1 jika ini alamat pertama customer
     */
    public function create($data)
    {
        // CRITICAL FIX: Cek apakah customer sudah punya alamat
        $existing_count = $this->countByCustomer($data['id_customer']);
        
        if ($existing_count == 0) {
            // Ini alamat pertama, PAKSA jadi default!
            $data['is_default'] = 1;
        } else {
            // Jika user set is_default=1, unset alamat lain dulu
            if (isset($data['is_default']) && $data['is_default'] == 1) {
                $this->unsetAllDefault($data['id_customer']);
            }
        }
        
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update alamat
     */
    public function update($id, $data)
    {
        // Jika update menjadi default, unset yang lain dulu
        if (isset($data['is_default']) && $data['is_default'] == 1) {
            $alamat = $this->getById($id);
            if ($alamat) {
                $this->unsetAllDefault($alamat->id_customer);
            }
        }
        
        return $this->db->where('id_alamat', $id)->update($this->table, $data);
    }

    /**
     * Hapus alamat
     */
    public function delete($id)
    {
        // Ambil data alamat yang mau dihapus
        $alamat = $this->getById($id);
        
        if ($alamat && $alamat->is_default == 1) {
            // Jika hapus alamat default, set alamat lain jadi default
            $count = $this->countByCustomer($alamat->id_customer);
            
            if ($count > 1) {
                // Masih ada alamat lain, set yang pertama jadi default
                $this->db->where('id_alamat', $id)->delete($this->table);
                
                // Ambil alamat pertama yang tersisa
                $first = $this->db->where('id_customer', $alamat->id_customer)
                                  ->order_by('id_alamat', 'ASC')
                                  ->limit(1)
                                  ->get($this->table)
                                  ->row();
                
                if ($first) {
                    $this->db->where('id_alamat', $first->id_alamat)
                             ->update($this->table, ['is_default' => 1]);
                }
                
                return true;
            }
        }
        
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