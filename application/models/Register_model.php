<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

    public function insert_pelanggan($data)
    {
        return $this->db->insert('users', $data);
    }
}