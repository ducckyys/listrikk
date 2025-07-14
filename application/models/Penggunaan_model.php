<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan_model extends CI_Model {

    public function get_penggunaan_by_pelanggan($id_pelanggan)
    {
        $this->db->select('penggunaan.*, tagihan.status, tagihan.id_tagihan');
        $this->db->from('penggunaan');
        $this->db->join('tagihan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        $this->db->order_by('penggunaan.id_penggunaan', 'DESC');
        return $this->db->get()->result();
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

    public function get_meter_terakhir($id_pelanggan)
    {
        $this->db->select('meter_akhir');
        $this->db->from('penggunaan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('id_penggunaan', 'DESC'); // Ambil data paling baru
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->meter_akhir;
        } else {
            return 0; // Jika belum ada penggunaan sama sekali, kembalikan 0
        }
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

    public function get_penggunaan_by_id($id_penggunaan)
    {
        // Mengambil satu data penggunaan untuk form edit
        $this->db->select('penggunaan.*, tagihan.status');
        $this->db->from('penggunaan');
        $this->db->join('tagihan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
        $this->db->where('penggunaan.id_penggunaan', $id_penggunaan);
        return $this->db->get()->row();
    }

    public function update_penggunaan_dan_tagihan($id_penggunaan, $data_penggunaan, $id_pelanggan)
    {
        // 1. Update data di tabel penggunaan
        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->update('penggunaan', $data_penggunaan);

        // 2. Ambil ulang data tarif pelanggan
        $pelanggan = $this->db->select('tarif.tarif_per_kwh')
                            ->from('users')
                            ->join('tarif', 'users.id_tarif = tarif.id_tarif')
                            ->where('users.id_user', $id_pelanggan)
                            ->get()->row();

        // 3. Hitung ulang jumlah meter dan jumlah bayar
        $jumlah_meter = $data_penggunaan['meter_akhir'] - $data_penggunaan['meter_awal'];
        $jumlah_bayar = $jumlah_meter * $pelanggan->tarif_per_kwh;

        // 4. Siapkan data update untuk tabel tagihan
        $data_tagihan = [
            'jumlah_meter'  => $jumlah_meter,
            'jumlah_bayar'  => $jumlah_bayar
        ];

        // 5. Update data di tabel tagihan
        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->update('tagihan', $data_tagihan);
    }

    public function delete_penggunaan($id_penggunaan)
    {
        // Database sudah di-set ON DELETE CASCADE, 
        // jadi saat penggunaan dihapus, tagihan terkait akan ikut terhapus.
        $this->db->where('id_penggunaan', $id_penggunaan);
        return $this->db->delete('penggunaan');
    }
}