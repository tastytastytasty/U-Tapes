<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WilayahModel');
    }
    private function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 🔥 PENTING
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // 🔥 biar gak ditolak

        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function provinsi()
    {
        header('Content-Type: application/json');
        echo $this->curl(
            'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json'
        );
    }

    public function kabupaten($id)
    {
        header('Content-Type: application/json');
        echo $this->curl(
            'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $id . '.json'
        );
    }

    public function kecamatan($id)
    {
        header('Content-Type: application/json');
        echo $this->curl(
            'https://emsifa.github.io/api-wilayah-indonesia/api/districts/' . $id . '.json'
        );
    }

    public function kelurahan($id)
    {
        header('Content-Type: application/json');
        echo $this->curl(
            'https://emsifa.github.io/api-wilayah-indonesia/api/villages/' . $id . '.json'
        );
    }
    public function get_kabupaten($provinsi_id)
    {
        $data = $this->WilayahModel->get_kabupaten($provinsi_id);
        foreach ($data as $d) {
            echo "<option value='{$d->kabupaten_id}'>{$d->nama}</option>";
        }
    }
    public function get_kecamatan($kabupaten_id)
    {
        $data = $this->WilayahModel->get_kecamatan($kabupaten_id);
        foreach ($data as $d) {
            echo "<option value='{$d->kecamatan_id}'>{$d->nama}</option>";
        }
    }
    public function get_kelurahan($kecamatan_id)
    {
        $data = $this->WilayahModel->get_kelurahan($kecamatan_id);
        foreach ($data as $d) {
            echo "<option value='{$d->kelurahan_id}'>{$d->nama}</option>";
        }
    }
}
