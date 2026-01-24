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
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[customer.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('register');
		} else {
			$this->_register();
		}
	}

	private function _register()
	{
		$email = $this->input->post('email', true);
		$otpInput = $this->input->post('otp');

		$otpRow = $this->db->where([
			'dipake' => 0
		])->order_by('id', 'DESC')->get('register_otp')->row();

		if (!$otpRow) {
			$this->session->set_flashdata('error', 'OTP belum dikirim');
			redirect('register');
		}

		if (strtotime($otpRow->kadaluarsa) < time()) {
			$this->session->set_flashdata('error', 'OTP kadaluarsa');
			redirect('register');
		}

		if ($otpInput !== $otpRow->otp_kode) {
			$this->db->set('percobaan', 'percobaan+1', false)
				->where('id', $otpRow->id)
				->update('register_otp');

			$this->session->set_flashdata('error', 'Kode OTP salah');
			redirect('register');
		}

		$this->db->where('id', $otpRow->id)->update('register_otp', ['dipake' => 1]);

		$last = $this->db->select('id_customer')->order_by('id_customer', 'DESC')->limit(1)->get('customer')->row_array();
		$number = $last ? (int) substr($last['id_customer'], 3) + 1 : 1;
		$id_customer = 'CST' . str_pad($number, 3, '0', STR_PAD_LEFT);

		$customer = [
			'id_customer' => $id_customer,
			'email' => $email,
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'nama' => $this->input->post('nama', true),
			'no_telp' => null,
			'avatar' => null
		];

		$this->db->insert('customer', $customer);

		$this->session->set_flashdata('success', 'Registrasi berhasil');
		redirect('login');
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

		$this->db->insert('register_otp', [
			'otp_kode' => $otp,
			'kadaluarsa' => date('Y-m-d H:i:s', time() + 300),
			'percobaan' => 0,
			'ngirim_ulang' => 0,
			'kunci_sampai' => null,
			'dipake' => 0
		]);

		$this->load->library('email');
		$this->email->from('UTapsInformation@gmail.com', 'U-Tapes Store');
		$this->email->to($email);
		$this->email->subject('Kode OTP');
		$this->email->message("Kode OTP kamu: $otp");

		if (!$this->email->send()) {
			echo json_encode(['status' => false, 'message' => 'Gagal kirim OTP']);
			return;
		}

		echo json_encode(['status' => true, 'message' => 'OTP terkirim ke email']);
	}

}
