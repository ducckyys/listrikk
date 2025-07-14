<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    // ========== SUPERADMIN QUERIES ==========

    public function get_penghasilan_bulan_ini()
    {
        $this->db->select_sum('total_bayar', 'total');
        $this->db->where('MONTH(tanggal_bayar)', date('m'));
        $this->db->where('YEAR(tanggal_bayar)', date('Y'));
        return $this->db->get('pembayaran')->row()->total;
    }

    public function get_pendapatan_tahun_ini()
    {
        $this->db->select_sum('total_bayar', 'total');
        $this->db->where('YEAR(tanggal_bayar)', date('Y'));
        return $this->db->get('pembayaran')->row()->total;
    }

    public function count_total_pelanggan()
    {
        $this->db->where('id_level', 3);
        return $this->db->count_all_results('users');
    }

    // public function count_total_pelanggan()
    // {
    //     $this->db->where('level', 'pelanggan');
    //     return $this->db->count_all_results('users');
    // }

    public function count_total_tagihan()
    {
        return $this->db->count_all_results('tagihan');
    }
    
    public function get_tagihan_terbaru_admin($limit = 5)
    {
        // PERBAIKAN: Tambahkan 'penggunaan.bulan' dan 'penggunaan.tahun' di sini
        $this->db->select('tagihan.*, users.nama_lengkap, penggunaan.bulan, penggunaan.tahun');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->join('users', 'penggunaan.id_pelanggan = users.id_user');
        $this->db->order_by('tagihan.tgl_dibuat', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }


    // ========== PELANGGAN QUERIES ==========

    public function get_pembayaran_tahunan_pelanggan($id_pelanggan)
    {
        $this->db->select_sum('pembayaran.total_bayar', 'total');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        $this->db->where('YEAR(pembayaran.tanggal_bayar)', date('Y'));
        return $this->db->get()->row()->total;
    }

    public function count_transaksi_pelanggan($id_pelanggan)
    {
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        return $this->db->count_all_results();
    }
    
    public function get_tunggakan_pelanggan($id_pelanggan)
    {
        $this->db->select_sum('jumlah_bayar', 'total_tunggakan');
        $this->db->select('COUNT(id_tagihan) as jumlah_tunggakan');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        $this->db->where('tagihan.status', 'Belum Lunas');
        return $this->db->get()->row();
    }

    public function get_info_kwh_pelanggan($id_pelanggan)
    {
        $this->db->select('users.nomor_kwh, tarif.daya, tarif.tarif_per_kwh');
        $this->db->from('users');
        $this->db->join('tarif', 'users.id_tarif = tarif.id_tarif');
        $this->db->where('users.id_user', $id_pelanggan);
        return $this->db->get()->row();
    }
}