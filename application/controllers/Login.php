<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->helper('form');
        $this->load->database();
        $method = $this->router->fetch_method();
        if ($method !== 'logout' && $this->session->userdata('logged_in')) {
            redirect('homepage');
        }
    }
    public function index()
    {
        $this->load->view('login');
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
            if($this->form_validation->error_array()){
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
        $this->session->sess_regenerate(true);
        $this->session->set_userdata([
            'logged_in' => true,
            'user' => $customer,
            'id_customer' => $customer['id_customer']
        ]);

        echo json_encode([
            'status' => true,
            'message' => 'Login berhasil. Selamat datang '. $customer['nama']
        ]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
