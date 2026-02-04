<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'session', 'recaptcha']);
        $this->load->helper('form');
        $this->load->database();
        $method = $this->router->fetch_method();
        if ($method !== 'logout' && $this->session->userdata('logged_in')) {
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
        $this->load->view('login', $data);
    }

    public function auth()
    {
        header('Content-Type: application/json');
        $post = $this->input->post(NULL, true);

        if (!$post) {
            echo json_encode([
                'status' => false,
                'message' => 'Data belum diisi. Silakan masukkan email/no telp dan password.'
            ]);
            return;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'identity',
            'Email / No Telepon',
            'required|trim',
            ['required' => 'Email atau No. Telepon wajib diisi.']
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Password wajib diisi.'
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            if ($this->form_validation->error_array()) {
                $errors = $this->form_validation->error_array();
                $first_error = reset($errors);
                echo json_encode([
                    'status' => false,
                    'message' => $first_error
                ]);
                return;
            }
            echo json_encode([
                'status' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }

        $identity = $post['identity'];
        $password = $post['password'];

        $this->db->where('email', $identity);
        $this->db->or_where('no_telp', $identity);
        $customer = $this->db->get('customer')->row_array();
        if (!$customer) {
            echo json_encode([
                'status' => false,
                'message' => 'Akun dengan email atau no. telepon tersebut tidak ditemukan.'
            ]);
            return;
        }
        if (!password_verify($password, $customer['password'])) {
            echo json_encode([
                'status' => false,
                'message' => 'Akun dengan email atau no. telepon tersebut tidak ditemukan.'
            ]);
            return;
        }
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
        $this->session->sess_regenerate(true);
        $this->session->set_userdata([
            'logged_in' => true,
            'user' => $customer,
            'id_customer' => $customer['id_customer']
        ]);

        echo json_encode([
            'status' => true,
            'message' => 'Login berhasil. Selamat datang ' . $customer['nama']
        ]);
    }
    public function forgot_password_send_otp()
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
        $identity = $this->input->post('identity', true);

        if (!$identity) {
            echo json_encode(['status' => false, 'message' => 'Email atau No. Telepon wajib diisi']);
            return;
        }
        $this->db->where('email', $identity);
        $this->db->or_where('no_telp', $identity);
        $user = $this->db->get('customer')->row_array();
        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'Akun tidak ditemukan']);
            return;
        }

        $email = $user['email'];

        $lastOtp = $this->db->where('email', $email)
            ->order_by('id', 'DESC')
            ->get('password_reset_otp')
            ->row_array();
        if ($lastOtp && $lastOtp['kunci_sampai'] && strtotime($lastOtp['kunci_sampai']) > time()) {
            $sisa = strtotime($lastOtp['kunci_sampai']) - time();
            $m = floor($sisa / 60);
            $s = $sisa % 60;
            echo json_encode(['status' => false, 'message' => "Terlalu sering kirim OTP. Coba lagi dalam {$m} menit {$s} detik"]);
            return;
        }
        if ($lastOtp && $lastOtp['kirim_ulang'] >= 3 && strtotime($lastOtp['kadaluarsa']) > time()) {
            $kunci = date('Y-m-d H:i:s', time() + 300);
            $this->db->where('id', $lastOtp['id'])->update('password_reset_otp', ['kunci_sampai' => $kunci]);
            $sisa = 300;
            $m = floor($sisa / 60);
            $s = $sisa % 60;
            echo json_encode(['status' => false, 'message' => "Kamu sudah kirim OTP 3 kali. Coba lagi dalam {$m} menit {$s} detik"]);
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
        $this->db->insert('password_reset_otp', [
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
        $this->email->subject('Reset Password U-Taps');
        $this->email->message("
Halo {$user['nama']},

Anda menerima email ini karena ada permintaan reset password untuk akun Anda.

🔐 KODE RESET PASSWORD: $otp

Kode ini berlaku selama 5 menit.
Jangan bagikan kode ini kepada siapa pun demi keamanan akun Anda.

Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.

Salam,
U-Taps Store
Belanja Mudah, Langkah Maksimal.
    ");

        if (!$this->email->send()) {
            echo json_encode(['status' => false, 'message' => 'Gagal kirim kode reset ke email']);
            return;
        }
        $message = 'Kode reset password telah dikirim ke email Anda';
        if (preg_match('/^[0-9]+$/', $identity)) {
            $censored_email = substr($email, 0, 3) . '***@' . explode('@', $email)[1];
            $message = "Kode reset password telah dikirim ke email terdaftar ($censored_email)";
        }

        echo json_encode(['status' => true, 'message' => $message]);
    }

    public function forgot_password_verify_otp()
    {
        header('Content-Type: application/json');
        $identity = $this->input->post('identity', true);
        $otp = $this->input->post('otp', true);
        if (!$identity || !$otp) {
            echo json_encode(['status' => false, 'message' => 'Data wajib diisi']);
            return;
        }
        $this->db->where('email', $identity);
        $this->db->or_where('no_telp', $identity);
        $user = $this->db->get('customer')->row_array();

        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'Akun tidak ditemukan']);
            return;
        }
        $email = $user['email'];
        $row = $this->db->where('email', $email)
            ->where('dipakai', 0)
            ->order_by('id', 'DESC')
            ->get('password_reset_otp')
            ->row_array();
        if (!$row) {
            echo json_encode(['status' => false, 'message' => 'Kode OTP salah']);
            return;
        }
        if ($row['kunci_sampai'] && strtotime($row['kunci_sampai']) > time()) {
            $sisa = strtotime($row['kunci_sampai']) - time();
            $m = floor($sisa / 60);
            $s = $sisa % 60;
            echo json_encode(['status' => false, 'message' => "Terlalu banyak percobaan. Coba lagi dalam {$m}m {$s}d"]);
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
            $this->db->where('id', $row['id'])->update('password_reset_otp', [
                'percobaan' => $percobaan,
                'kunci_sampai' => $kunci
            ]);
            echo json_encode(['status' => false, 'message' => 'Kode OTP salah']);
            return;
        }
        if (strtotime($row['kadaluarsa']) < time()) {
            echo json_encode(['status' => false, 'message' => 'Kode OTP sudah kadaluarsa']);
            return;
        }
        $this->db->where('id', $row['id'])->update('password_reset_otp', ['dipakai' => 1]);
        $this->session->set_userdata('reset_password_email', $email);

        echo json_encode(['status' => true, 'message' => 'Kode OTP berhasil diverifikasi']);
    }

    public function reset_password()
    {
        header('Content-Type: application/json');
        $email = $this->session->userdata('reset_password_email');
        if (!$email) {
            echo json_encode(['status' => false, 'message' => 'Silakan verifikasi OTP terlebih dahulu']);
            return;
        }
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        if (!$password || !$password2) {
            echo json_encode(['status' => false, 'message' => 'Password wajib diisi']);
            return;
        }
        if ($password !== $password2) {
            echo json_encode(['status' => false, 'message' => 'Konfirmasi password tidak sama']);
            return;
        }
        if (strlen($password) < 8) {
            echo json_encode(['status' => false, 'message' => 'Password minimal 8 karakter']);
            return;
        }
        $this->db->where('email', $email)->update('customer', [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        $this->session->unset_userdata('reset_password_email');
        echo json_encode(['status' => true, 'message' => 'Password berhasil diubah']);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
