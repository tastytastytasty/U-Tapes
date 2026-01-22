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
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register');
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
		$customer = [
			'id_customer' => $id_customer,
			'email' => $this->input->post('email', true),
			'password' => password_hash(
				$this->input->post('password'),
				PASSWORD_DEFAULT
			),
			'nama' => $this->input->post('nama', true),
			'no_telp' => null,
			'avatar' => null
		];
		$otp = rand(100000, 999999);
		$email = $this->input->post('email', true);
		$this->session->set_userdata([
			'otp_code' => $otp,
			'otp_email' => $email,
			'otp_attempt' => 1,
			'otp_time' => time()
		]);
		if ($this->input->post('otp') != $this->session->userdata('otp_code')) {
			$this->session->set_flashdata('error', 'Kode OTP salah');
			redirect('register');
		}
		$attempt = $this->session->userdata('otp_attempt') ?? 0;
		if ($attempt >= 3) {
			$lastTime = $this->session->userdata('otp_time');
			if (time() - $lastTime < 180) {
				$this->session->set_flashdata('error', 'Tunggu 3 menit sebelum kirim ulang');
				redirect('register');
			}
		}

		$this->db->trans_start();
		$this->db->insert('customer', $customer);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('error', 'Registrasi gagal');
			redirect('register');
		} else {
			$this->session->set_flashdata('success', 'Registrasi berhasil');
			redirect('login');
		}
	}
	public function send_otp()
	{
		header('Content-Type: application/json');

		$email = $this->input->post('email');
		if (!$email) {
			echo json_encode(['status' => false, 'message' => 'Email wajib diisi']);
			return;
		}

		$otp = rand(100000, 999999);

		$this->load->library('email');

		$this->email->from('UTapsInformation@gmail.com', 'U-Tapes Store');
		$this->email->to($email);
		$this->email->subject('Kode OTP');
		$this->email->message("Kode OTP kamu: $otp");

		if (!$this->email->send()) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal kirim OTP',
				'debug' => $this->email->print_debugger()
			]);
			return;
		}

		$this->session->set_userdata([
			'otp_code' => $otp,
			'otp_email' => $email,
			'otp_time' => time()
		]);

		echo json_encode(['status' => true, 'message' => 'OTP terkirim ke email']);
	}

}
