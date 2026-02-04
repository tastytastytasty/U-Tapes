<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation', 'session', 'recaptcha']);
		$this->load->database();
		if ($this->session->userdata('logged_in')) {
			redirect('homepage');
		}
	}

	public function index()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                echo "Kamu berhasil!";
            }
        }

        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
		$this->load->view('register', $data);
	}
	public function validate_register()
	{
		header('Content-Type: application/json');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[customer.email]', [
			'required' => 'Email wajib diisi.',
			'valid_email' => 'Format email tidak valid.',
			'is_unique' => 'Email sudah terdaftar.'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama wajib diisi.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]', [
			'required' => 'Password wajib diisi.',
			'min_length' => 'Password minimal 8 karakter.'
		]);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]', [
			'required' => 'Konfirmasi password wajib diisi.',
			'matches' => 'Konfirmasi password harus sama dengan password.'
		]);

		if ($this->form_validation->run() === FALSE) {
			$errors = $this->form_validation->error_array();
			echo json_encode([
				'status' => false,
				'message' => reset($errors)
			]);
			return;
		}

		echo json_encode(['status' => true]);
	}
	public function send_otp()
	{
		header('Content-Type: application/json');
		$recaptcha = $this->input->post('g-recaptcha-response');
		if (empty($recaptcha)) {
			echo json_encode(['status' => false, 'message' => 'Harap centang "Saya bukan robot"']);
			return;
		}

		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] !== true) {
			echo json_encode(['status' => false, 'message' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi']);
			return;
		}
		$email = $this->input->post('email', true);
		$row = $this->db->where('email', $email)->where('dipakai', 0)->order_by('id', 'DESC')->get('register_otp')->row_array();
		if (!$email) {
			echo json_encode(['status' => false, 'message' => 'Email wajib diisi']);
			return;
		}

		$lastOtp = $this->db->where('email', $email)->order_by('id', 'DESC')->get('register_otp')->row_array();

		if ($lastOtp && $lastOtp['kunci_sampai'] && strtotime($lastOtp['kunci_sampai']) > time()) {
			$sisa = strtotime($lastOtp['kunci_sampai']) - time();
			$m = floor($sisa / 60);
			$s = $sisa % 60;
			echo json_encode(['status' => false, 'message' => "Terlalu sering kirim OTP. Coba lagi dalam {$m} menit {$s} detik."]);
			return;
		}

		if ($lastOtp && $lastOtp['kirim_ulang'] >= 3 && strtotime($lastOtp['kadaluarsa']) > time()) {
			$kunci = date('Y-m-d H:i:s', time() + 300);
			$this->db->where('id', $lastOtp['id'])->update('register_otp', ['kunci_sampai' => $kunci]);
			$sisa = 300;
			$m = floor($sisa / 60);
			$s = $sisa % 60;
			echo json_encode(['status' => false, 'message' => "Kamu sudah kirim OTP 3 kali. Coba lagi {$m} menit {$s} detik."]);
			return;
		}

		$otp = rand(100000, 999999);
		$kirim_ulang = 1;
        $reset_interval = 300;

        if ($lastOtp) {
            $selisih_waktu = time() - strtotime($lastOtp['created_at']);
            if ($selisih_waktu < $reset_interval) {
                $kirim_ulang = $lastOtp['kirim_ulang'] + 1;
            }
        }

		$this->db->insert('register_otp', [
			'email' => $email,
			'otp_kode' => $otp,
			'kadaluarsa' => date('Y-m-d H:i:s', time() + 300),
			'percobaan' => 0,
			'kirim_ulang' => $kirim_ulang,
			'kunci_sampai' => null,
			'dipakai' => 0,
			'created_at' => date('Y-m-d H:i:s')
		]);

		$this->load->library('email');
		$this->email->from('utaps.store@gmail.com', 'U-Taps Store');
		$this->email->to($email);
		$this->email->subject('Kode OTP Verifikasi U-Taps');
		$this->email->message("
Halo pelanggan yang terhormat,

Terima kasih sudah mendaftar di U-Taps Store.

Berikut adalah Kode OTP kamu untuk proses verifikasi akun kamu:

🔐 KODE OTP: $otp

Kode ini berlaku selama 5 menit.
Jangan bagikan kode ini kepada siapa pun demi keamanan akun kamu.

Jika kamu tidak merasa melakukan permintaan ini, silakan abaikan email ini.

Salam,
U-Tapes Store
Belanja Mudah, Langkah Maksimal.
									");

		if (!$this->email->send()) {
			echo json_encode(['status' => false, 'message' => 'Gagal kirim OTP ke email']);
			return;
		}

		echo json_encode(['status' => true, 'message' => 'OTP berhasil dikirim ke email']);
		return;
	}

	public function verify_otp()
	{
		header('Content-Type: application/json');
		$email = $this->input->post('email', true);
		$otp = $this->input->post('otp', true);
		$nama = $this->input->post('nama', true);
		$password = $this->input->post('password', true);

		if (!$email || !$otp) {
			echo json_encode(['status' => false, 'message' => 'Email & OTP wajib diisi']);
			return;
		}

		$row = $this->db->where('email', $email)->where('dipakai', 0)->order_by('id', 'DESC')->get('register_otp')->row_array();

		if (!$row) {
			echo json_encode(['status' => false, 'message' => 'OTP tidak ditemukan']);
			return;
		}

		if ($row['kunci_sampai'] && strtotime($row['kunci_sampai']) > time()) {
			$sisa = strtotime($row['kunci_sampai']) - time();
			$m = floor($sisa / 60);
			$s = $sisa % 60;
			echo json_encode(['status' => false, 'message' => "Terlalu banyak percobaan. Coba lagi {$m}m {$s}d"]);
			return;
		}

		if ($row['otp_kode'] != $otp) {
			$percobaan = $row['percobaan'] + 1;
			$kunci = null;
			if ($percobaan == 3) {
				$kunci = date('Y-m-d H:i:s', time() + 300);
			} elseif ($percobaan >= 4 && $percobaan <= 6) {
				$kunci = date('Y-m-d H:i:s', time() + 600);
			} elseif ($percobaan > 6) {
				$kunci = date('Y-m-d H:i:s', time() + 1200);
			}
			$this->db->where('id', $row['id'])->update('register_otp', ['percobaan' => $percobaan, 'kunci_sampai' => $kunci]);
			echo json_encode(['status' => false, 'message' => 'Kode OTP salah']);
			return;
		}

		if (strtotime($row['kadaluarsa']) < time()) {
			echo json_encode(['status' => false, 'message' => 'Kode OTP sudah kadaluarsa']);
			return;
		}

		$last = $this->db->select('id_customer')->order_by('id_customer', 'DESC')->limit(1)->get('customer')->row_array();
		$number = $last ? (int) substr($last['id_customer'], 3) + 1 : 1;
		$id_customer = 'CST' . str_pad($number, 3, '0', STR_PAD_LEFT);

		$customer = [
			'id_customer' => $id_customer,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'nama' => $nama,
			'no_telp' => null,
			'avatar' => null
		];

		$this->db->insert('customer', $customer);

		$this->db->where('id', $row['id'])->update('register_otp', ['dipakai' => 1]);

		echo json_encode(['status' => true, 'message' => 'Registrasi berhasil! Silakan login']);
	}
}
