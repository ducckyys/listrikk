<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Profile_model
 *
 * Model ini bertanggung jawab untuk mengelola data profil pengguna, 
 * termasuk mengambil dan memperbarui data pribadi di database.
 *
 * @property CI_DB_query_builder $db   Objek Query Builder dari CodeIgniter.
 */
class Profile_model extends CI_Model {

    /**
     * Mengambil data detail satu pengguna berdasarkan ID-nya.
     * Fungsi ini melakukan JOIN ke tabel 'level' untuk mendapatkan nama level pengguna.
     *
     * @param   int     $id_user    ID dari pengguna yang datanya ingin diambil.
     * @return  object|null         Mengembalikan satu objek pengguna jika data ditemukan.
     * * @info    PENJELASAN PENGECUALIAN:
     * Fungsi ini akan mengembalikan 'null' jika tidak ada pengguna
     * dengan ID yang cocok di dalam database.
     */
    public function get_user_by_id($id_user)
    {
        $this->db->select('users.*, level.nama_level');
        $this->db->from('users');
        $this->db->join('level', 'users.id_level = level.id_level', 'left');
        $this->db->where('users.id_user', $id_user);
        return $this->db->get()->row();
    }

    /**
     * Memperbarui data profil pengguna di tabel 'users'.
     *
     * @param   int     $id_user    ID dari pengguna yang datanya akan diperbarui.
     * @param   array   $data       Data baru dalam bentuk array asosiatif.
     * @return  bool                Mengembalikan true jika update berhasil, false jika gagal.
     * * @info    PENJELASAN PENGECUALIAN:
     * Fungsi ini akan mengembalikan 'false' jika proses update ke database
     * gagal, misalnya karena ada masalah koneksi atau ID pengguna tidak ditemukan.
     */
    public function update_profile($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }
}