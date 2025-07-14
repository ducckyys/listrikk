<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tarif_model
 *
 * Model ini bertanggung jawab untuk semua interaksi dengan tabel 'tarif' di database.
 * Ini mencakup operasi dasar CRUD (Create, Read, Update, Delete) untuk data tarif listrik.
 *
 * @property CI_DB_query_builder $db   Objek Query Builder dari CodeIgniter.
 */
class Tarif_model extends CI_Model {

    /**
     * Mengambil semua data tarif dari database.
     * Fungsi ini menjalankan query SELECT * FROM tarif.
     *
     * @return array    Array objek yang berisi semua data tarif.
     * Akan mengembalikan array kosong jika tidak ada data.
     */
    public function get_all_tarif()
    {
        // Mengambil semua data dari tabel 'tarif'
        return $this->db->get('tarif')->result();
    }

    /**
     * Menyimpan data tarif baru ke dalam database.
     * Fungsi ini menjalankan query INSERT INTO tarif ...
     *
     * @param   array   $data   Data asosiatif yang berisi informasi tarif baru.
     * Contoh: ['daya' => '900VA', 'tarif_per_kwh' => 1352]
     * @return  bool            Mengembalikan true jika berhasil, false jika gagal.
     */
    public function insert_tarif($data)
    {
        // Memasukkan data baru ke dalam tabel 'tarif'
        return $this->db->insert('tarif', $data);
    }

    /**
     * Mengambil satu data tarif spesifik berdasarkan ID-nya.
     * Fungsi ini menjalankan query SELECT * FROM tarif WHERE id_tarif = $id.
     *
     * @param   int     $id     ID unik dari tarif yang akan diambil.
     * @return  object|null     Mengembalikan satu objek tarif jika ditemukan, atau null jika tidak ada.
     */
    public function get_tarif_by_id($id)
    {
        // Mengambil data dari tabel 'tarif' di mana kolom 'id_tarif' cocok dengan $id
        return $this->db->get_where('tarif', ['id_tarif' => $id])->row();
    }

    /**
     * Memperbarui data tarif yang sudah ada di database.
     * Fungsi ini menjalankan query UPDATE tarif SET ... WHERE id_tarif = $id.
     *
     * @param   int     $id     ID dari tarif yang akan diperbarui.
     * @param   array   $data   Data asosiatif yang berisi kolom dan nilai baru.
     * @return  bool            Mengembalikan true jika berhasil, false jika gagal.
     */
    public function update_tarif($id, $data)
    {
        // Menentukan baris mana yang akan di-update berdasarkan ID
        $this->db->where('id_tarif', $id);
        // Menjalankan proses update pada tabel 'tarif' dengan data baru
        return $this->db->update('tarif', $data);
    }

    /**
     * Menghapus data tarif dari database berdasarkan ID.
     * Fungsi ini menjalankan query DELETE FROM tarif WHERE id_tarif = $id.
     * Kemungkinan eksepsi/error: Jika tarif ini masih digunakan oleh data pelanggan,
     * bisa terjadi error foreign key constraint jika tidak diatur dengan benar (misal: ON DELETE RESTRICT).
     *
     * @param   int     $id     ID dari tarif yang akan dihapus.
     * @return  bool            Mengembalikan true jika berhasil, false jika gagal.
     */
    public function delete_tarif($id)
    {
        // Menentukan baris mana yang akan dihapus berdasarkan ID
        $this->db->where('id_tarif', $id);
        // Menjalankan proses hapus pada tabel 'tarif'
        return $this->db->delete('tarif');
    }
}