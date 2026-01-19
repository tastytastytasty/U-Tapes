<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('AlamatModel');
        $this->load->model('WilayahModel');
        $this->load->library('session');
    }

    public function index()
    {
        $id_customer = $this->session->userdata('user')['id_customer'];

        $data = [];
        $data['alamat_list'] = $this->AlamatModel->getAlamatWithNames($id_customer);
        $data['contents'] = $this->load->view('alamat', $data, TRUE);

        $this->load->view('navbar', array_merge($this->global_data, $data));
    }

    /* ========== API WILAYAH ========== */

    public function provinsi()
    {
        echo json_encode($this->WilayahModel->getProvinces());
    }

    public function kabupaten($provinsi_id = '')
    {
        echo json_encode($provinsi_id ? $this->WilayahModel->getRegencies($provinsi_id) : []);
    }

    public function kecamatan($kabupaten_id = '')
    {
        echo json_encode($kabupaten_id ? $this->WilayahModel->getDistricts($kabupaten_id) : []);
    }

    public function kelurahan($kecamatan_id = '')
    {
        echo json_encode($kecamatan_id ? $this->WilayahModel->getVillages($kecamatan_id) : []);
    }

    /* ========== CRUD ========== */

    public function simpan()
    {
        $id_customer = $this->session->userdata('user')['id_customer'];

        $data = [
            'id_alamat' => $this->AlamatModel->generateId(),
            'id_customer' => $id_customer,
            'provinsi_id' => $this->input->post('provinsi_id'),
            'kabupaten_id' => $this->input->post('kabupaten_id'),
            'kecamatan_id' => $this->input->post('kecamatan_id'),
            'kelurahan_id' => $this->input->post('kelurahan_id'),
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $this->input->post('is_default') ?? 0
        ];

        if (!$data['provinsi_id'] || !$data['kabupaten_id'] || !$data['kecamatan_id'] || !$data['kelurahan_id']) {
            echo json_encode(['success' => false, 'message' => 'Data wilayah belum lengkap']);
            return;
        }

        $ok = $this->AlamatModel->create($data);
        echo json_encode(['success' => $ok, 'message' => $ok ? 'Alamat berhasil ditambahkan' : 'Gagal menyimpan alamat']);
    }

    public function update()
    {
        $id = $this->input->post('id_alamat');

        $data = [
            'provinsi_id' => $this->input->post('provinsi_id'),
            'kabupaten_id' => $this->input->post('kabupaten_id'),
            'kecamatan_id' => $this->input->post('kecamatan_id'),
            'kelurahan_id' => $this->input->post('kelurahan_id'),
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $this->input->post('is_default') ?? 0
        ];

        if (!$data['provinsi_id'] || !$data['kabupaten_id'] || !$data['kecamatan_id'] || !$data['kelurahan_id']) {
            echo json_encode(['success' => false, 'message' => 'Data wilayah belum lengkap']);
            return;
        }

        $ok = $this->AlamatModel->update($id, $data);
        echo json_encode(['success' => $ok, 'message' => $ok ? 'Alamat berhasil diupdate' : 'Gagal update alamat']);
    }

    public function get($id = '')
    {
        $row = $this->AlamatModel->getByIdWithNames($id);
        echo json_encode(['success' => (bool) $row, 'data' => $row]);
    }

    public function hapus()
    {
        $id = $this->input->post('id_alamat');
        $ok = $this->AlamatModel->delete($id);
        echo json_encode(['success' => $ok, 'message' => $ok ? 'Alamat berhasil dihapus' : 'Gagal menghapus alamat']);
    }
}
