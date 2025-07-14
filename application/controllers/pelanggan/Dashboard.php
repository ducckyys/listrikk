<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'pelanggan'){
            redirect('auth');
        }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_user');
        
        $data['title'] = "Dashboard Pelanggan";
        $data['pembayaran_tahunan'] = $this->Dashboard_model->get_pembayaran_tahunan_pelanggan($id_pelanggan);
        $data['total_transaksi'] = $this->Dashboard_model->count_transaksi_pelanggan($id_pelanggan);
        $data['info_kwh'] = $this->Dashboard_model->get_info_kwh_pelanggan($id_pelanggan);
        $data['tunggakan'] = $this->Dashboard_model->get_tunggakan_pelanggan($id_pelanggan);

        $this->output->enable_profiler(TRUE);

        $this->load->view('templates/header', $data);
        $this->load->view('pelanggan/dashboard_view', $data);
        $this->load->view('templates/footer');
    }
}