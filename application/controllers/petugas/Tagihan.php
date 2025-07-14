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
 * @property Pelanggan_model $Pelanggan_model
 * @property Tagihan_model $Tagihan_model
 */
class Tagihan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi halaman
        if($this->session->userdata('level') != 'petugas'){
            redirect('auth');
        }
        $this->load->model('Tagihan_model');
    }

    public function index()
    {
        $data['title'] = "Data Tagihan Pelanggan";
        $data['tagihan'] = $this->Tagihan_model->get_all_tagihan();
        
        $this->load->view('templates/header', $data);
        $this->load->view('petugas/tagihan_view', $data); // Buat view ini
        $this->load->view('templates/footer');
    }

    public function konfirmasi_pembayaran($id_tagihan)
    {
        $biaya_admin = 2500; // Biaya admin bisa diatur di sini atau dari config
        $id_petugas = $this->session->userdata('id_user');

        // Panggil model untuk proses konfirmasi
        $this->Tagihan_model->proses_konfirmasi($id_tagihan, $id_petugas, $biaya_admin);
        
        $this->session->set_flashdata('success', 'Pembayaran berhasil dikonfirmasi!');
        redirect('petugas/tagihan');
    }
}