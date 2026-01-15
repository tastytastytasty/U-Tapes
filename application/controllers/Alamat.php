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
        $this->load->library(['email']);
        $this->load->database();
        $this->load->library('session');
        $this->load->model('AlamatModel');
        $this->load->model('WilayahModel');
    }

    public function index()
    {
        $id_customer = $this->session->userdata('id_customer');
        if (!$id_customer) {
            redirect('login');
        }

        $data = [];
        $data['alamat_list'] = $this->AlamatModel->getAlamatCustomer($id_customer);
        $data['user'] = [
            'nama' => $this->session->userdata('nama'),
            'email' => $this->session->userdata('email'),
        ];
        $data['contents'] = $this->load->view('alamat', $data, TRUE);

       $this->load->view('navbar',array_merge($this->global_data, $data));
    }

    // WILAYAH ENDPOINTS
    public function provinsi()
    {
        header('Content-Type: application/json');
        $data = $this->WilayahModel->getProvinces();
        echo json_encode($data);
    }

    public function kabupaten($province_id = '')
    {
        header('Content-Type: application/json');
        if (!$province_id) {
            echo json_encode([]);
            return;
        }
        $data = $this->WilayahModel->getRegencies($province_id);
        echo json_encode($data);
    }

    public function kecamatan($regency_id = '')
    {
        header('Content-Type: application/json');
        if (!$regency_id) {
            echo json_encode([]);
            return;
        }
        $data = $this->WilayahModel->getDistricts($regency_id);
        echo json_encode($data);
    }

    public function kelurahan($district_id = '')
    {
        header('Content-Type: application/json');
        if (!$district_id) {
            echo json_encode([]);
            return;
        }
        $data = $this->WilayahModel->getVillages($district_id);
        echo json_encode($data);
    }

    // CRUD ALAMAT
    public function simpan()
    {
        header('Content-Type: application/json');
        $id_customer = $this->session->userdata('id_customer');
        if (!$id_customer) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $provinsi_id = $this->input->post('provinsi_id');
        $kabupaten_id = $this->input->post('kabupaten_id');
        $kecamatan_id = $this->input->post('kecamatan_id');
        $kelurahan_id = $this->input->post('kelurahan_id');

        // Ambil nama dari database wilayah
        $provinsi = $this->WilayahModel->getNamaProvinsi($provinsi_id);
        $kabupaten = $this->WilayahModel->getNamaKabupaten($kabupaten_id);
        $kecamatan = $this->WilayahModel->getNamaKecamatan($kecamatan_id);
        $kelurahan = $this->WilayahModel->getNamaKelurahan($kelurahan_id);

        if (!$provinsi || !$kabupaten || !$kecamatan || !$kelurahan) {
            echo json_encode(['success' => false, 'message' => 'Data wilayah tidak valid']);
            return;
        }

        $data = [
            'id_alamat' => $this->AlamatModel->generateId(),
            'id_customer' => $id_customer,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $this->input->post('is_default') ?? 0,
            'latitude' => 0,
            'longitude' => 0
        ];

        $ok = $this->AlamatModel->create($data);
        echo json_encode(['success' => (bool) $ok, 'message' => $ok ? 'Alamat berhasil ditambahkan' : 'Gagal menambah alamat']);
    }

    public function update()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id_alamat');
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            return;
        }

        $provinsi_id = $this->input->post('provinsi_id');
        $kabupaten_id = $this->input->post('kabupaten_id');
        $kecamatan_id = $this->input->post('kecamatan_id');
        $kelurahan_id = $this->input->post('kelurahan_id');

        // Ambil nama dari database wilayah
        $provinsi = $this->WilayahModel->getNamaProvinsi($provinsi_id);
        $kabupaten = $this->WilayahModel->getNamaKabupaten($kabupaten_id);
        $kecamatan = $this->WilayahModel->getNamaKecamatan($kecamatan_id);
        $kelurahan = $this->WilayahModel->getNamaKelurahan($kelurahan_id);

        $data = [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $this->input->post('is_default') ?? 0
        ];

        $ok = $this->AlamatModel->update($id, $data);
        echo json_encode(['success' => (bool) $ok, 'message' => $ok ? 'Alamat berhasil diupdate' : 'Gagal mengupdate alamat']);
    }

    public function getById($id)
    {
        return $this->db->where('id_alamat', $id)
            ->get('alamat')
            ->row();
    }


    public function get($id = '')
    {
        header('Content-Type: application/json');
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            return;
        }
        $row = $this->AlamatModel->getById($id);
        echo json_encode(['success' => (bool) $row, 'data' => $row]);
    }

    public function hapus()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id_alamat');
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            return;
        }
        $ok = $this->AlamatModel->delete($id);
        echo json_encode(['success' => (bool) $ok, 'message' => $ok ? 'Alamat berhasil dihapus' : 'Gagal menghapus alamat']);
    }
}
