<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WilayahModel');
    }

    public function provinsi()
    {
        echo json_encode($this->WilayahModel->getProvinsi());
    }

    public function kabupaten($provinsi_id)
    {
        echo json_encode($this->WilayahModel->getKabupaten($provinsi_id));
    }

    public function kecamatan($kabupaten_id)
    {
        echo json_encode($this->WilayahModel->getKecamatan($kabupaten_id));
    }

    public function kelurahan($kecamatan_id)
    {
        echo json_encode($this->WilayahModel->getKelurahan($kecamatan_id));
    }
}
