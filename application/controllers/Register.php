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
 */
class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tarif_model');
        $this->load->model('Register_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['tarif'] = $this->Tarif_model->get_all_tarif();
        $this->load->view('register_view', $data);
    }

    public function proses()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('id_tarif', 'Tarif', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index(); // Kembali ke form registrasi jika validasi gagal
        } else {
            $data = [
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
                'username'          => $this->input->post('username'),
                'password'          => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nomor_kwh'         => $this->input->post('nomor_kwh'),
                'alamat'            => $this->input->post('alamat'),
                'id_tarif'          => $this->input->post('id_tarif'),
                'level'             => 'pelanggan'
            ];

            $this->Register_model->insert_pelanggan($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        }
    }
}