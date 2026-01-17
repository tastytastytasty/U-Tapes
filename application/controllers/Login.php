<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
        $method = $this->router->fetch_method();
        if ($method !== 'logout' && $this->session->userdata('logged_in')) {
            redirect('homepage');
        }
    }
    public function index()
    {
        $this->form_validation->set_rules(
            'identity',
            'Email atau No Telepon',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[8]'
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $identity = $this->input->post('identity', true);
        $password = $this->input->post('password', true);
        $this->db->where('email', $identity);
        $this->db->or_where('no_telp', $identity);
        $customer = $this->db->get('customer')->row_array();
        if ($customer) {
            if (password_verify($password, $customer['password'])) {

                $this->session->sess_regenerate(true);
                $this->session->set_userdata([
                    'logged_in' => true,
                    'id_customer' => $customer['id_customer'],
                    'user' => [
                        'id_customer' => $customer['id_customer'],
                        'nama' => $customer['nama'],
                        'email' => $customer['email'],
                        'no_telp' => $customer['no_telp'],
                        'avatar' => $customer['avatar'],
                        'jenis_kelamin' => $customer['jenis_kelamin'],
                        'tanggal_lahir' => $customer['tanggal_lahir'],
                    ]
                ]);
                redirect('homepage');
            } else {
                $this->session->set_flashdata('error', 'Email / No.Telp / Password salah');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'Email / No.Telp / Password salah');
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
