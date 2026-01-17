<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WilayahModel extends CI_Model
{
    public function getProvinces()
    {
        return $this->db
            ->select('provinsi_id AS id, nama AS name')
            ->from('provinsi')
            ->order_by('nama', 'ASC')
            ->get()
            ->result();
    }

    public function getRegencies($provinsi_id)
    {
        return $this->db
            ->select('kabupaten_id AS id, nama AS name')
            ->from('kabupaten')
            ->where('provinsi_id', $provinsi_id)
            ->order_by('nama', 'ASC')
            ->get()
            ->result();
    }

    public function getDistricts($kabupaten_id)
    {
        return $this->db
            ->select('kecamatan_id AS id, nama AS name')
            ->from('kecamatan')
            ->where('kabupaten_id', $kabupaten_id)
            ->order_by('nama', 'ASC')
            ->get()
            ->result();
    }

    public function getVillages($kecamatan_id)
    {
        return $this->db
            ->select('kelurahan_id AS id, nama AS name')
            ->from('kelurahan')
            ->where('kecamatan_id', $kecamatan_id)
            ->order_by('nama', 'ASC')
            ->get()
            ->result();
    }

    public function getNamaProvinsi($id)
    {
        $row = $this->db->select('nama')->where('provinsi_id', $id)->get('provinsi')->row();
        return $row ? $row->nama : '';
    }
    public function getNamaKabupaten($id)
    {
        $row = $this->db->select('nama')->where('kabupaten_id', $id)->get('kabupaten')->row();
        return $row ? $row->nama : '';
    }
    public function getNamaKecamatan($id)
    {
        $row = $this->db->select('nama')->where('kecamatan_id', $id)->get('kecamatan')->row();
        return $row ? $row->nama : '';
    }
    public function getNamaKelurahan($id)
    {
        $row = $this->db->select('nama')->where('kelurahan_id', $id)->get('kelurahan')->row();
        return $row ? $row->nama : '';
    }
    public function get_provinsi()
    {
        return $this->db->get('provinsi')->result();
    }
    public function get_kabupaten($provinsi_id)
    {
        return $this->db
            ->where('provinsi_id', $provinsi_id)
            ->get('kabupaten')
            ->result();
    }
    public function get_kecamatan($kabupaten_id)
    {
        return $this->db
            ->where('kabupaten_id', $kabupaten_id)
            ->get('kecamatan')
            ->result();
    }
    public function get_kelurahan($kecamatan_id)
    {
        return $this->db
            ->where('kecamatan_id', $kecamatan_id)
            ->get('kelurahan')
            ->result();
    }
}
