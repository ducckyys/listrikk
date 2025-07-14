<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Penggunaan_model');
    }

    public function index()
    {
        $data['title'] = "Data Penggunaan";
        $data['penggunaan'] = $this->Penggunaan_model->get_all_penggunaan();
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/penggunaan_view', $data);
        $this->load->view('templates/footer', $data);
    }
}