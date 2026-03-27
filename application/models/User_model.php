<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'customer';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get user by ID
     */
    public function get_by_id($id_customer)
    {
        return $this->db->where('id_customer', $id_customer)
            ->get($this->table)
            ->row_array();
    }

    /**
     * Get user by email
     */
    public function get_by_email($email)
    {
        return $this->db->where('email', $email)
            ->get($this->table)
            ->row_array();
    }

    /**
     * Update user profile
     */
    public function update_profile($id_customer, $data)
    {
        return $this->db->where('id_customer', $id_customer)
            ->update($this->table, $data);
    }

    /**
     * Update avatar
     */
    public function update_avatar($id_customer, $avatar_filename)
    {
        return $this->update_profile($id_customer, [
            'avatar' => $avatar_filename
        ]);
    }

    /**
     * Handle file upload untuk avatar
     * @return array ['status' => bool, 'filename' => string, 'message' => string]
     */
    public function upload_avatar()
    {
        $config['upload_path']      = './assets/images/avatar/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png|webp';
        $config['max_size']         = 2048; // 2MB
        $config['file_name']        = 'avatar_' . time();
        $config['overwrite']        = FALSE;
        $config['remove_spaces']    = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar')) {
            return [
                'status'  => FALSE,
                'message' => $this->upload->display_errors('', '')
            ];
        }

        return [
            'status'   => TRUE,
            'filename' => $this->upload->data('file_name'),
            'message'  => 'File uploaded successfully'
        ];
    }

    /**
     * Delete old avatar file
     */
    public function delete_avatar_file($filename)
    {
        if (!empty($filename)) {
            $file_path = './assets/images/avatar/' . $filename;
            if (file_exists($file_path)) {
                unlink($file_path);
                return true;
            }
        }
        return false;
    }
}
