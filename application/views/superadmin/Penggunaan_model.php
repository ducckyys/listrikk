<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan_model extends CI_Model {

    public function get_penggunaan_by_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->get('penggunaan')->result();
    }

    public function insert_penggunaan_dan_tagihan($data, $id_pelanggan)
    {
        // 1. Insert ke tabel penggunaan
        $this->db->insert('penggunaan', $data);
        $id_penggunaan = $this->db->insert_id(); // Dapatkan ID penggunaan yang baru saja diinput

        // 2. Ambil data tarif pelanggan
        $pelanggan = $this->db->select('tarif.tarif_per_kwh')
                              ->from('users')
                              ->join('tarif', 'users.id_tarif = tarif.id_tarif')
                              ->where('users.id_user', $id_pelanggan)
                              ->get()->row();

        // 3. Hitung jumlah meter dan jumlah bayar
        $jumlah_meter = $data['meter_akhir'] - $data['meter_awal'];
        $jumlah_bayar = $jumlah_meter * $pelanggan->tarif_per_kwh;

        // 4. Siapkan data untuk tabel tagihan
        $data_tagihan = [
            'id_penggunaan' => $id_penggunaan,
            'jumlah_meter'  => $jumlah_meter,
            'jumlah_bayar'  => $jumlah_bayar,
            'status'        => 'Belum Lunas'
        ];

        // 5. Insert ke tabel tagihan
        $this->db->insert('tagihan', $data_tagihan);
    }

    public function get_all_penggunaan()
    {
        $this->db->select('penggunaan.*, users.nama_lengkap, users.id_user as id_pelanggan, tarif.daya');
        $this->db->from('penggunaan');
        $this->db->join('users', 'penggunaan.id_pelanggan = users.id_user');
        $this->db->join('tarif', 'users.id_tarif = tarif.id_tarif');
        $this->db->order_by('penggunaan.tahun DESC, penggunaan.bulan DESC');
        return $this->db->get()->result();
    }
}