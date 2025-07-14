<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    // Di dalam Auth_model.php
    public function cek_login($username)
    {
        $this->db->select('users.*, level.nama_level');
        $this->db->from('users');
        $this->db->join('level', 'users.id_level = level.id_level', 'left');
        $this->db->where('users.username', $username);
        return $this->db->get()->row();
    }
}