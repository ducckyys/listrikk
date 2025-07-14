<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_model extends CI_Model {

    public function get_riwayat_tagihan($id_pelanggan)
    {
        $this->db->select('tagihan.*, penggunaan.bulan, penggunaan.tahun');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        $this->db->order_by('tagihan.tgl_dibuat', 'DESC');
        return $this->db->get()->result();
    }

    public function get_riwayat_pembayaran($id_pelanggan)
    {
        $this->db->select('pembayaran.*, petugas.nama_lengkap as nama_petugas, penggunaan.bulan, penggunaan.tahun');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->join('users as petugas', 'pembayaran.id_petugas = petugas.id_user');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        $this->db->order_by('pembayaran.tanggal_bayar', 'DESC');
        return $this->db->get()->result();
    }
}