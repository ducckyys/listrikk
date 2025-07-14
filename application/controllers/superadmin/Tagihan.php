<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Tagihan_model');
    }

    public function index()
    {
        $data['title'] = "Data Tagihan";
        $data['tagihan'] = $this->Tagihan_model->get_all_tagihan();
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/tagihan_view', $data);
        $this->load->view('templates/footer', $data);
    }
}