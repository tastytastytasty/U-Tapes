<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlamatModel extends CI_Model {

    public function getAlamatCustomer($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->order_by('is_default', 'DESC')
            ->get('alamat')
            ->result();
    }

    public function create($data)
    {
        return $this->db->insert('alamat', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_alamat', $id)->update('alamat', $data);
    }

    public function getById($id)
    {
        return $this->db->where('id_alamat', $id)->get('alamat')->row();
    }

    public function delete($id)
    {
        return $this->db->where('id_alamat', $id)->delete('alamat');
    }

    public function generateId()
    {
        $last = $this->db->select('id_alamat')->order_by('id_alamat', 'DESC')->limit(1)->get('alamat')->row();
        if (!$last) return 'ALM001';
        $num = intval(preg_replace('/\D/', '', $last->id_alamat)) + 1;
        return 'ALM' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }
}