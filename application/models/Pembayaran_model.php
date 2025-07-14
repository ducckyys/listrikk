<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    public function get_all_pembayaran()
    {
        $this->db->select('pembayaran.*, pelanggan.nama_lengkap as nama_pelanggan, pelanggan.id_user as id_pelanggan, petugas.nama_lengkap as nama_petugas, penggunaan.bulan, penggunaan.tahun');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->join('users as pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_user');
        $this->db->join('users as petugas', 'pembayaran.id_petugas = petugas.id_user');
        $this->db->order_by('pembayaran.tanggal_bayar', 'DESC');
        return $this->db->get()->result();
    }
}