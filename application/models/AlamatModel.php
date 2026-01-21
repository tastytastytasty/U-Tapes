<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlamatModel extends CI_Model
{

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

    public function getById($id)
    {
        return $this->db->where('id_alamat', $id)->get('alamat')->row();
    }

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

    public function create($data)
    {
        return $this->db->insert('alamat', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_alamat', $id)->update('alamat', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_alamat', $id)->delete('alamat');
    }

    public function generateId()
    {
        $last = $this->db->select('id_alamat')->order_by('id_alamat', 'DESC')->limit(1)->get('alamat')->row();
        if (!$last) return 'ALM001';
        $num = intval(substr($last->id_alamat, 3)) + 1;
        return 'ALM' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    // Method baru untuk unset semua default
    public function unsetAllDefault($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->update('alamat', ['is_default' => 0]);
    }

    // Method untuk get alamat default
    public function getDefaultAddress($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->get('alamat')
            ->row();
    }
}