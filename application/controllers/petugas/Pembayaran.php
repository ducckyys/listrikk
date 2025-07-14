<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi login dan level petugas
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'petugas'){
            redirect('auth');
        }
        $this->load->model('Pembayaran_model');
    }

    public function index()
    {
        $data['title'] = "Data Riwayat Pembayaran";
        $data['pembayaran'] = $this->Pembayaran_model->get_all_pembayaran();
        
        // Memuat template secara manual satu per satu
        $this->load->view('templates/header', $data);
        $this->load->view('petugas/pembayaran_view', $data);
        $this->load->view('templates/footer', $data);
    }
}