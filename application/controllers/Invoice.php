<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $data = [];
        $data['contents'] = $this->load->view(
            'invoice',
            $data,
            TRUE
        );
    }

    public function view($no_invoice = '')
    {
        // Data dummy untuk preview tampilan
        $invoice = [
            'no_invoice' => $no_invoice ?: 'INV-001',
            'tanggal' => '2024-06-01',
            'status' => 'Selesai',
            'nama_customer' => 'Budi Santoso',
            'email' => 'budi@mail.com',
            'no_telp' => '08123456789',
            'alamat' => 'Jl. Merdeka No. 123, RT 01 RW 05',
            'kelurahan' => 'Kelurahan Contoh',
            'kecamatan' => 'Kecamatan Contoh',
            'kabupaten' => 'Kabupaten Contoh',
            'provinsi' => 'Provinsi Contoh',
            'kode_pos' => '12345',
            'kurir' => 'JNE',
            'layanan' => 'REG',
            'subtotal' => 1200000,
            'ongkir' => 20000,
            'total' => 1220000,
            'metode_bayar' => 'Transfer Bank'
        ];
        $produk_list = [
            [
                'nama_produk' => 'Keyboard Mechanical',
                'varian' => 'Hitam',
                'qty' => 1,
                'harga' => 750000
            ],
            [
                'nama_produk' => 'Mouse Gaming',
                'varian' => 'Wireless',
                'qty' => 1,
                'harga' => 450000
            ]
        ];
        $data = [
            'invoice' => $invoice,
            'produk_list' => $produk_list
        ];
        $this->load->view('invoice', $data);
    }
}
