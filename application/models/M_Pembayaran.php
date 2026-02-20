<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model
{
    var $table = 'pembayaran'; // Pastikan nama tabel sesuai dengan database Anda
    var $column_order = ['id_pembayaran', 'tanggal', 'id_transaksi', 'status', null];
    var $column_search = ['id_pembayaran', 'id_transaksi', 'status'];
    var $order = ['tanggal' => 'desc']; // Urutkan dari terbaru

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        if (!empty($_POST['search']['value'])) {
            $this->db->group_start();
            foreach ($this->column_search as $item) {
                if ($item) { // Skip null items
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order'][0]['column']],
                $_POST['order'][0]['dir']
            );
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();

        if (isset($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id_pembayaran', $id)
            ->get($this->table)
            ->row();
    }

    public function get_by_transaksi($id_transaksi)
    {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->get($this->table)
            ->row();
    }

    /**
     * Insert pembayaran - PERBAIKAN dengan error handling
     */
    public function insert($data)
    {
        // Validasi data sebelum insert
        if (empty($data['id_transaksi'])) {
            log_message('error', 'M_pembayaran::insert - id_transaksi kosong');
            return false;
        }

        // Set default values jika tidak ada
        if (!isset($data['tanggal'])) {
            $data['tanggal'] = date('Y-m-d H:i:s');
        }
        
        if (!isset($data['status'])) {
            $data['status'] = 'Menunggu';
        }

        // Debug: Log data yang akan diinsert
        log_message('debug', 'M_pembayaran::insert - Data: ' . json_encode($data));

        // Insert ke database
        $result = $this->db->insert($this->table, $data);
        
        if ($result) {
            log_message('debug', 'M_pembayaran::insert - Berhasil insert id: ' . $this->db->insert_id());
            return $this->db->insert_id();
        } else {
            log_message('error', 'M_pembayaran::insert - Gagal insert: ' . $this->db->error()['message']);
            return false;
        }
    }

    /**
     * Update status pembayaran
     */
    public function update_status($id_pembayaran, $status)
    {
        $data = [
            'status' => $status
        ];
        
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->update($this->table, $data);
    }

    /**
     * Edit/Update pembayaran
     */
    public function edit($id_pembayaran, $data)
    {
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete pembayaran
     */
    public function delete($id_pembayaran)
    {
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->delete($this->table);
    }

    /**
     * TAMBAHAN: Get statistik pembayaran
     */
    public function get_statistics()
    {
        $result = [
            'total' => 0,
            'menunggu' => 0,
            'berhasil' => 0,
            'ditolak' => 0
        ];

        // Total pembayaran
        $result['total'] = $this->db->count_all($this->table);

        // Menunggu validasi
        $this->db->where('status', 'Menunggu');
        $result['menunggu'] = $this->db->count_all_results($this->table);

        // Berhasil
        $this->db->where('status', 'Berhasil');
        $result['berhasil'] = $this->db->count_all_results($this->table);

        // Ditolak
        $this->db->where('status', 'Ditolak');
        $result['ditolak'] = $this->db->count_all_results($this->table);

        return $result;
    }

    /**
     * TAMBAHAN: Cek apakah transaksi sudah punya pembayaran
     */
    public function transaksi_has_payment($id_transaksi)
    {
        $count = $this->db
            ->where('id_transaksi', $id_transaksi)
            ->count_all_results($this->table);
        
        return $count > 0;
    }
}