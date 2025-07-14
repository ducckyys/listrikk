<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {

    public function get_all_petugas()
    {
        // Menggunakan id_level 1 (superadmin) dan 2 (petugas)
        $this->db->select('users.*, level.nama_level');
        $this->db->from('users');
        $this->db->join('level', 'users.id_level = level.id_level', 'left');
        $this->db->where_in('users.id_level', [1, 2]);
        return $this->db->get()->result();
    }

    public function insert_petugas($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_petugas_by_id($id)
    {
        return $this->db->get_where('users', ['id_user' => $id])->row();
    }

    public function update_petugas($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }
    
    public function delete_petugas($id)
    {
        // Tambahkan proteksi agar tidak bisa menghapus diri sendiri
        if ($id == $this->session->userdata('id_user')) {
            return false;
        }
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }
}