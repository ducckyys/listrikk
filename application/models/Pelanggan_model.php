<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    public function get_all_pelanggan()
    {
        $this->db->select('users.*, tarif.daya, tarif.tarif_per_kwh');
        $this->db->from('users');
        $this->db->join('tarif', 'users.id_tarif = tarif.id_tarif', 'left');
        $this->db->where('users.id_level', 3);
        
        return $this->db->get()->result();
    }

    public function insert_pelanggan($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_pelanggan_by_id($id)
    {
        return $this->db->get_where('users', ['id_user' => $id])->row();
    }

    public function update_pelanggan($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }
    
    public function delete_pelanggan($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }
}