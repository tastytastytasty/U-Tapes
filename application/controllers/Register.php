<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation', 'session']);
		$this->load->database();
		if ($this->session->userdata('logged_in')) {
			redirect('homepage');
		}
	}

	public function index()
	{
		$this->load->model('WilayahModel');
		$data['provinsi'] = $this->WilayahModel->get_provinsi();
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[customer.email]'
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim|min_length[8]'
		);
		$this->form_validation->set_rules(
			'password2',
			'Konfirmasi Password',
			'required|matches[password]'
		);
		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim'
		);
		$this->form_validation->set_rules(
			'jenis_kelamin',
			'Jenis Kelamin',
			'required'
		);
		$this->form_validation->set_rules(
			'tanggal_lahir',
			'Tanggal Lahir',
			'required'
		);
		$this->form_validation->set_rules(
			'no_telp',
			'No Telepon',
			'required|trim|is_unique[customer.no_telp]'
		);
		$this->form_validation->set_rules('provinsi_id', 'Provinsi', 'required');
		$this->form_validation->set_rules('kabupaten_id', 'Kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan_id', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kelurahan_id', 'Kelurahan', 'required');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim');
		$this->form_validation->set_rules('detail', 'Detail Alamat', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register', $data);
		} else {
			$this->_register();
		}
	}

	private function _register()
	{
		$last = $this->db
			->select('id_customer')
			->order_by('id_customer', 'DESC')
			->limit(1)
			->get('customer')
			->row_array();
		$number = $last ? (int) substr($last['id_customer'], 3) + 1 : 1;
		$id_customer = 'CST' . str_pad($number, 3, '0', STR_PAD_LEFT);
		$lastAlamat = $this->db
			->select('id_alamat')
			->order_by('id_alamat', 'DESC')
			->limit(1)
			->get('alamat')
			->row_array();

		$alamatNumber = $lastAlamat
			? (int) substr($lastAlamat['id_alamat'], 3) + 1
			: 1;

		$id_alamat = 'ALM' . str_pad($alamatNumber, 3, '0', STR_PAD_LEFT);
		$customer = [
			'id_customer' => $id_customer,
			'email' => $this->input->post('email', true),
			'password' => password_hash(
				$this->input->post('password'),
				PASSWORD_DEFAULT
			),
			'nama' => $this->input->post('nama', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
			'no_telp' => $this->input->post('no_telp', true),
			'avatar' => null
		];
		$alamat = [
			'id_alamat' => $id_alamat,
			'id_customer' => $id_customer,
			'provinsi_id' => $this->input->post('provinsi_id', true),
			'kabupaten_id' => $this->input->post('kabupaten_id', true),
			'kecamatan_id' => $this->input->post('kecamatan_id', true),
			'kelurahan_id' => $this->input->post('kelurahan_id', true),
			'kode_pos' => $this->input->post('kode_pos', true),
			'detail' => $this->input->post('detail', true),
			'is_default' => 1,
			'latitude' => null,
			'longitude' => null
		];
		$this->db->trans_start();
		$this->db->insert('customer', $customer);
		$this->db->insert('alamat', $alamat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('error', 'Registrasi gagal');
			redirect('register');
		} else {
			$this->session->set_flashdata('success', 'Registrasi berhasil');
			redirect('login');
		}
	}
}
