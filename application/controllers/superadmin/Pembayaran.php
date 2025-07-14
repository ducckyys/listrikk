<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session $session
 * @property Pembayaran_model $Pembayaran_model
 */
class Pembayaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Pembayaran_model');
    }

    public function index()
    {
        $data['title'] = "Data Pembayaran";
        $data['pembayaran'] = $this->Pembayaran_model->get_all_pembayaran();
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/pembayaran_view', $data);
        $this->load->view('templates/footer', $data);
    }
}