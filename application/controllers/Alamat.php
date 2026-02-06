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
        $this->load->model('AlamatModel');
        $this->load->model('WilayahModel');
        $this->load->library('session');
    }

   public function index()
{
    // Cek session user
    $user = $this->session->userdata('user');

    // Jika session berbeda, coba ambil langsung
    if (!$user || !isset($user['id_customer'])) {
        $id_customer = $this->session->userdata('id_customer');
    } else {
        $id_customer = $user['id_customer'];
    }

    // Jika masih tidak ada, redirect ke login
    if (!$id_customer) {
        redirect('login');
    }

    $data = [];
    $data['alamat_list'] = $this->AlamatModel->getAlamatWithNames($id_customer);
    
    // PERBAIKAN: Pass global_data ke view 'alamat'
    $data['contents'] = $this->load->view('alamat', array_merge($this->global_data, $data), TRUE);

    $this->load->view('navbar', array_merge($this->global_data, $data));
}

    /* ========== API WILAYAH ========== */

    public function provinsi()
    {
        header('Content-Type: application/json');
        echo json_encode($this->WilayahModel->getProvinces());
    }

    public function kabupaten($provinsi_id = '')
    {
        header('Content-Type: application/json');
        echo json_encode($provinsi_id ? $this->WilayahModel->getRegencies($provinsi_id) : []);
    }

    public function kecamatan($kabupaten_id = '')
    {
        header('Content-Type: application/json');
        echo json_encode($kabupaten_id ? $this->WilayahModel->getDistricts($kabupaten_id) : []);
    }

    public function kelurahan($kecamatan_id = '')
    {
        header('Content-Type: application/json');
        echo json_encode($kecamatan_id ? $this->WilayahModel->getVillages($kecamatan_id) : []);
    }

    /* ========== CRUD ========== */

    public function simpan()
    {
        // Cek session user
        $user = $this->session->userdata('user');

        if (!$user || !isset($user['id_customer'])) {
            $id_customer = $this->session->userdata('id_customer');
        } else {
            $id_customer = $user['id_customer'];
        }

        if (!$id_customer) {
            echo json_encode(['success' => false, 'message' => 'Session tidak valid']);
            return;
        }

        $nama_alamat = $this->input->post('nama_alamat');
        $nama_penerima = $this->input->post('nama_penerima');
        $nomor_telp_penerima = $this->input->post('nomor_telp_penerima');

        // Validasi nama alamat
        if (!$nama_alamat || trim($nama_alamat) == '') {
            echo json_encode(['success' => false, 'message' => 'Nama alamat harus diisi']);
            return;
        }

        // Validasi nama penerima
        if (!$nama_penerima || trim($nama_penerima) == '') {
            echo json_encode(['success' => false, 'message' => 'Nama penerima harus diisi']);
            return;
        }

        // Validasi nomor telepon penerima
        if (!$nomor_telp_penerima || trim($nomor_telp_penerima) == '') {
            echo json_encode(['success' => false, 'message' => 'Nomor telepon penerima harus diisi']);
            return;
        }

        $is_default = $this->input->post('is_default') ? 1 : 0;

        // Jika alamat ini akan dijadikan default, set alamat lain jadi non-default
        if ($is_default == 1) {
            $this->AlamatModel->unsetAllDefault($id_customer);
        }

        $data = [
            'id_alamat' => $this->AlamatModel->generateId(),
            'id_customer' => $id_customer,
            'nama_alamat' => trim($nama_alamat),
            'nama_penerima' => trim($nama_penerima),
            'nomor_telp_penerima' => trim($nomor_telp_penerima),
            'provinsi_id' => $this->input->post('provinsi_id'),
            'kabupaten_id' => $this->input->post('kabupaten_id'),
            'kecamatan_id' => $this->input->post('kecamatan_id'),
            'kelurahan_id' => $this->input->post('kelurahan_id'),
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $is_default
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
        $nama_alamat = $this->input->post('nama_alamat');
        $nama_penerima = $this->input->post('nama_penerima');
        $nomor_telp_penerima = $this->input->post('nomor_telp_penerima');

        // Validasi nama alamat
        if (!$nama_alamat || trim($nama_alamat) == '') {
            echo json_encode(['success' => false, 'message' => 'Nama alamat harus diisi']);
            return;
        }

        // Validasi nama penerima
        if (!$nama_penerima || trim($nama_penerima) == '') {
            echo json_encode(['success' => false, 'message' => 'Nama penerima harus diisi']);
            return;
        }

        // Validasi nomor telepon penerima
        if (!$nomor_telp_penerima || trim($nomor_telp_penerima) == '') {
            echo json_encode(['success' => false, 'message' => 'Nomor telepon penerima harus diisi']);
            return;
        }

        // Ambil data alamat untuk mendapat id_customer
        $alamat = $this->AlamatModel->getById($id);
        if (!$alamat) {
            echo json_encode(['success' => false, 'message' => 'Alamat tidak ditemukan']);
            return;
        }

        $is_default = $this->input->post('is_default') ? 1 : 0;

        // Jika alamat ini akan dijadikan default, set alamat lain jadi non-default
        if ($is_default == 1) {
            $this->AlamatModel->unsetAllDefault($alamat->id_customer);
        }

        $data = [
            'nama_alamat' => trim($nama_alamat),
            'nama_penerima' => trim($nama_penerima),
            'nomor_telp_penerima' => trim($nomor_telp_penerima),
            'provinsi_id' => $this->input->post('provinsi_id'),
            'kabupaten_id' => $this->input->post('kabupaten_id'),
            'kecamatan_id' => $this->input->post('kecamatan_id'),
            'kelurahan_id' => $this->input->post('kelurahan_id'),
            'detail' => $this->input->post('detail'),
            'kode_pos' => $this->input->post('kode_pos'),
            'is_default' => $is_default
        ];

        if (!$data['provinsi_id'] || !$data['kabupaten_id'] || !$data['kecamatan_id'] || !$data['kelurahan_id']) {
            echo json_encode(['success' => false, 'message' => 'Data wilayah belum lengkap']);
            return;
        }

        $ok = $this->AlamatModel->update($id, $data);
        echo json_encode(['success' => $ok, 'message' => $ok ? 'Alamat berhasil diupdate' : 'Gagal update alamat']);
    }

    public function get_by_id()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id_alamat');
        
        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            return;
        }
        
        $row = $this->AlamatModel->getByIdWithNames($id);
        
        if ($row) {
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function set_default()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id_alamat');

        // Ambil data alamat
        $alamat = $this->AlamatModel->getById($id);
        if (!$alamat) {
            echo json_encode(['success' => false, 'message' => 'Alamat tidak ditemukan']);
            return;
        }

        // Set semua alamat user jadi non-default
        $this->AlamatModel->unsetAllDefault($alamat->id_customer);

        // Set alamat ini jadi default
        $ok = $this->AlamatModel->update($id, ['is_default' => 1]);

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? 'Alamat berhasil dijadikan utama' : 'Gagal mengubah alamat utama'
        ]);
    }

    public function hapus()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id_alamat');
        
        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            return;
        }
        
        $ok = $this->AlamatModel->delete($id);
        echo json_encode(['success' => $ok, 'message' => $ok ? 'Alamat berhasil dihapus' : 'Gagal menghapus alamat']);
    }
}