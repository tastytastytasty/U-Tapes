<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->library(['email']);
		$this->load->database();
	}

	public function index()
	{
		$data = [];

		// isi halaman
		$data['contents'] = $this->load->view(
			'profile',
			$this->global_data,
			true
		);

		// gabungkan ke global
		$viewData = array_merge($this->global_data, $data);

		// navbar BUTUH $contents
		$this->load->view('navbar', $viewData);
	}

	/**
	 * Handle profile update
	 */
	public function update_profile()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('profile');
		}

		$id_customer = $this->session->userdata('user')['id_customer'];
		
		$this->load->model('User_model');

		// Validasi input
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('profile');
			return;
		}

		// Prepare data untuk update
		$update_data = [];

		$no_telp = $this->input->post('no_telp', true);
		if (!empty($no_telp)) {
			$update_data['no_telp'] = $no_telp;
		}

		// Handle avatar upload
		if (!empty($_FILES['avatar']['name'])) {
			$upload_result = $this->User_model->upload_avatar();
			
			if (!$upload_result['status']) {
				$this->session->set_flashdata('error', 'Gagal upload avatar: ' . $upload_result['message']);
				redirect('profile');
				return;
			}

			// Delete old avatar
			$current_user = $this->User_model->get_by_id($id_customer);
			if (!empty($current_user['avatar'])) {
				$this->User_model->delete_avatar_file($current_user['avatar']);
			}

			$update_data['avatar'] = $upload_result['filename'];
		}

		// Update ke database
		if ($this->User_model->update_profile($id_customer, $update_data)) {
			// Update session dengan data terbaru
			$updated_user = $this->User_model->get_by_id($id_customer);
			$this->session->set_userdata('user', $updated_user);

			$this->session->set_flashdata('success', 'Profil berhasil diperbarui');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui profil');
		}

		redirect('profile');
	}

	public function edit_email()
	{
		$this->load->view('profile/edit_email');
	}

	public function update_email()
	{
		$email_baru = $this->input->post('email', true);
		$token = bin2hex(random_bytes(32));

		// simpan token
		$this->db->insert('email_verification', [
			'id_customer' => $this->session->userdata('user')['id_customer'],
			'email_baru' => $email_baru,
			'token' => $token,
			'expired_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
		]);

		$this->_send_verification_email($email_baru, $token);

		$this->session->set_flashdata('success', 'Email verifikasi telah dikirim');
		redirect('profile/edit_email');
	}

	private function _send_verification_email($email, $token)
	{
		$this->email->from('zfzi1270@gmail.com', 'Tokopedia KW');
		$this->email->to($email);
		$this->email->subject('Verifikasi Email');

		$link = site_url("profile/verify_email/$token");

		$this->email->message("
        <h3>Verifikasi Email</h3>
        <p>Klik link berikut untuk konfirmasi:</p>
        <a href='$link'>$link</a>
    ");

		$this->email->send();
	}
	public function verify_email($token)
	{
		$data = $this->db->get_where('email_verification', [
			'token' => $token
		])->row_array();

		if (!$data || strtotime($data['expired_at']) < time()) {
			show_error('Token tidak valid');
		}

		$this->db->where('id_customer', $data['id_customer'])
			->update('customer', ['email' => $data['email_baru']]);

		$this->db->delete('email_verification', ['token' => $token]);

		$this->session->set_flashdata('success', 'Email berhasil diubah');
		redirect('profile');
	}
}
