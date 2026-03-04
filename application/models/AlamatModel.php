<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlamatModel extends CI_Model
{
    private $table = 'alamat';

    public function getAlamatWithNames($id_customer)
    {
        $alamat_list = $this->db
            ->where('id_customer', $id_customer)
            ->order_by('is_default', 'DESC')
            ->get('alamat')
            ->result();
        
        if (empty($alamat_list)) {
            return [];
        }
        
        $prov_ids = array_unique(array_column((array)$alamat_list, 'provinsi_id'));
        $kab_ids = array_unique(array_column((array)$alamat_list, 'kabupaten_id'));
        $kec_ids = array_unique(array_column((array)$alamat_list, 'kecamatan_id'));
        $kel_ids = array_unique(array_column((array)$alamat_list, 'kelurahan_id'));
        
        $provinsi = $this->db->where_in('provinsi_id', $prov_ids)->get('provinsi')->result();
        $kabupaten = $this->db->where_in('kabupaten_id', $kab_ids)->get('kabupaten')->result();
        $kecamatan = $this->db->where_in('kecamatan_id', $kec_ids)->get('kecamatan')->result();
        $kelurahan = $this->db->where_in('kelurahan_id', $kel_ids)->get('kelurahan')->result();
        
        $prov_map = [];
        foreach ($provinsi as $p) $prov_map[$p->provinsi_id] = $p->nama;
        
        $kab_map = [];
        foreach ($kabupaten as $k) $kab_map[$k->kabupaten_id] = $k->nama;
        
        $kec_map = [];
        foreach ($kecamatan as $kc) $kec_map[$kc->kecamatan_id] = $kc->nama;
        
        $kel_map = [];
        foreach ($kelurahan as $kl) $kel_map[$kl->kelurahan_id] = $kl->nama;
        
        foreach ($alamat_list as &$alamat) {
            $alamat->nama_provinsi = $prov_map[$alamat->provinsi_id] ?? '';
            $alamat->nama_kabupaten = $kab_map[$alamat->kabupaten_id] ?? '';
            $alamat->nama_kecamatan = $kec_map[$alamat->kecamatan_id] ?? '';
            $alamat->nama_kelurahan = $kel_map[$alamat->kelurahan_id] ?? '';
        }
        
        return $alamat_list;
    }

    public function getById($id)
    {
        return $this->db->where('id_alamat', $id)->get($this->table)->row();
    }

    public function getByIdWithNames($id)
    {
        $alamat = $this->db->where('id_alamat', $id)->get('alamat')->row();
        
        if (!$alamat) return null;
        
        $prov = $this->db->select('nama')->where('provinsi_id', $alamat->provinsi_id)->get('provinsi')->row();
        $kab = $this->db->select('nama')->where('kabupaten_id', $alamat->kabupaten_id)->get('kabupaten')->row();
        $kec = $this->db->select('nama')->where('kecamatan_id', $alamat->kecamatan_id)->get('kecamatan')->row();
        $kel = $this->db->select('nama')->where('kelurahan_id', $alamat->kelurahan_id)->get('kelurahan')->row();
        
        $alamat->nama_provinsi = $prov->nama ?? '';
        $alamat->nama_kabupaten = $kab->nama ?? '';
        $alamat->nama_kecamatan = $kec->nama ?? '';
        $alamat->nama_kelurahan = $kel->nama ?? '';
        
        return $alamat;
    }

    public function getDefaultAddress($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->get($this->table)
            ->row();
    }

    public function getDefaultAddressWithNames($id_customer)
    {
        $alamat = $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->get('alamat')
            ->row();
        
        if (!$alamat) return null;
        
        $prov = $this->db->select('nama')->where('provinsi_id', $alamat->provinsi_id)->get('provinsi')->row();
        $kab = $this->db->select('nama')->where('kabupaten_id', $alamat->kabupaten_id)->get('kabupaten')->row();
        $kec = $this->db->select('nama')->where('kecamatan_id', $alamat->kecamatan_id)->get('kecamatan')->row();
        $kel = $this->db->select('nama')->where('kelurahan_id', $alamat->kelurahan_id)->get('kelurahan')->row();
        
        $alamat->nama_provinsi = $prov->nama ?? '';
        $alamat->nama_kabupaten = $kab->nama ?? '';
        $alamat->nama_kecamatan = $kec->nama ?? '';
        $alamat->nama_kelurahan = $kel->nama ?? '';
        
        return $alamat;
    }

    public function create($data)
    {
        $existing_count = $this->countByCustomer($data['id_customer']);
        
        if ($existing_count == 0) {
            $data['is_default'] = 1;
        } else {
            if (isset($data['is_default']) && $data['is_default'] == 1) {
                $this->unsetAllDefault($data['id_customer']);
            }
        }
        
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        if (isset($data['is_default']) && $data['is_default'] == 1) {
            $alamat = $this->getById($id);
            if ($alamat) {
                $this->unsetAllDefault($alamat->id_customer);
            }
        }
        
        return $this->db->where('id_alamat', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $alamat = $this->getById($id);
        
        if ($alamat && $alamat->is_default == 1) {
            $count = $this->countByCustomer($alamat->id_customer);
            
            if ($count > 1) {
                $this->db->where('id_alamat', $id)->delete($this->table);
                
                $first = $this->db->where('id_customer', $alamat->id_customer)
                                  ->order_by('id_alamat', 'ASC')
                                  ->limit(1)
                                  ->get($this->table)
                                  ->row();
                
                if ($first) {
                    $this->db->where('id_alamat', $first->id_alamat)
                             ->update($this->table, ['is_default' => 1]);
                }
                
                return true;
            }
        }
        
        return $this->db->where('id_alamat', $id)->delete($this->table);
    }

    public function generateId()
    {
        $last = $this->db->select('id_alamat')
                        ->order_by('id_alamat', 'DESC')
                        ->limit(1)
                        ->get($this->table)
                        ->row();
        
        if (!$last) return 'ALM001';
        
        $num = intval(substr($last->id_alamat, 3)) + 1;
        return 'ALM' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    public function unsetAllDefault($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->update($this->table, ['is_default' => 0]);
    }

    public function setAsDefault($id_alamat, $id_customer)
    {
        $this->unsetAllDefault($id_customer);

        return $this->db
            ->where('id_alamat', $id_alamat)
            ->where('id_customer', $id_customer)
            ->update($this->table, ['is_default' => 1]);
    }

    public function hasDefault($id_customer)
    {
        $count = $this->db
            ->where('id_customer', $id_customer)
            ->where('is_default', 1)
            ->count_all_results($this->table);
        return $count > 0;
    }

    public function countByCustomer($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->count_all_results($this->table);
    }
}