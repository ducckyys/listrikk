<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Auth_model $Auth_model
 * @property CI_Input $input
 * @property Profile_model $Profile_model
 * @property Tarif_model $Tarif_model
 * @property Register_model $Register_model
 * @property Dashboard_model $Dashboard_model
 * @property CI_Output $output
 */
class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard Superadmin";
        $data['penghasilan_bulan_ini'] = $this->Dashboard_model->get_penghasilan_bulan_ini();
        $data['pendapatan_tahun_ini'] = $this->Dashboard_model->get_pendapatan_tahun_ini();
        $data['total_pelanggan'] = $this->Dashboard_model->count_total_pelanggan();
        $data['total_tagihan'] = $this->Dashboard_model->count_total_tagihan();
        $data['tagihan_terbaru'] = $this->Dashboard_model->get_tagihan_terbaru_admin();

        $this->output->enable_profiler(TRUE);
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/dashboard_view', $data);
        $this->load->view('templates/footer');
    }
}