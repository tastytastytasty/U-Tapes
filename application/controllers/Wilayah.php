<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{

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
}
