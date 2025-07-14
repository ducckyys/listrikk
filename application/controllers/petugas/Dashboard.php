<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Kembali menggunakan CI_Controller
class Dashboard extends CI_Controller { 
    
    public function __construct()
    {
        parent::__construct();
        // Proteksi login dan level diletakkan kembali di sini
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'petugas'){
            redirect('auth');
        }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard Petugas";
        
        // Mengambil data dari model, logikanya tetap sama
        $data['total_tagihan'] = $this->Dashboard_model->count_total_tagihan();
        $data['tagihan_terbaru'] = $this->Dashboard_model->get_tagihan_terbaru_admin();
        
        // Memuat template secara manual satu per satu
        // Kita gunakan path ke folder 'petugas' untuk header dan footer
        $this->load->view('templates/header', $data);
        $this->load->view('petugas/dashboard_view', $data);
        $this->load->view('templates/footer', $data);
    }
}