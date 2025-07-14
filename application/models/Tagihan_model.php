<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

    public function get_all_tagihan()
    {
        $this->db->select('tagihan.*, penggunaan.bulan, penggunaan.tahun, users.nama_lengkap, penggunaan.id_pelanggan');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->join('users', 'penggunaan.id_pelanggan = users.id_user');
        $this->db->order_by('tagihan.status', 'ASC'); // Tampilkan yg belum lunas dulu
        return $this->db->get()->result();
    }
    
    public function ubah_status($id_tagihan, $status)
    {
        $this->db->where('id_tagihan', $id_tagihan);
        return $this->db->update('tagihan', ['status' => $status]);
    }
    
    public function proses_konfirmasi($id_tagihan, $id_petugas, $biaya_admin)
    {
        // 1. Update status tagihan menjadi 'Lunas'
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tagihan', ['status' => 'Lunas']);

        // 2. Ambil data jumlah bayar dari tagihan
        $tagihan = $this->db->get_where('tagihan', ['id_tagihan' => $id_tagihan])->row();
        $total_bayar = $tagihan->jumlah_bayar + $biaya_admin;

        // 3. Buat record baru di tabel pembayaran
        $data_pembayaran = [
            'id_tagihan'    => $id_tagihan,
            'tanggal_bayar' => date('Y-m-d H:i:s'),
            'biaya_admin'   => $biaya_admin,
            'total_bayar'   => $total_bayar,
            'id_petugas'    => $id_petugas
        ];
        $this->db->insert('pembayaran', $data_pembayaran);
    }
}