<?php
class Kategori_model extends CI_Model
{
    public function get_kategori()
    {
        return $this->db->get('kategori')->result();
    }
}
