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
 * @property Penggunaan_model $Penggunaan_model
 * @property Riwayat_model $Riwayat_model
 */
class Riwayat extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'pelanggan'){
            redirect('auth');
        }
        $this->load->model('Riwayat_model');
    }

    public function tagihan()
    {
        $id_pelanggan = $this->session->userdata('id_user');
        $data['title'] = "Riwayat Tagihan Anda";
        $data['tagihan'] = $this->Riwayat_model->get_riwayat_tagihan($id_pelanggan);
        
        $this->load->view('templates/header', $data);
        $this->load->view('pelanggan/riwayat_tagihan_view', $data);
        $this->load->view('templates/footer');
    }


    public function proses_bayar($id_tagihan)
    {
        // Kita panggil model Tagihan karena fungsinya sudah ada di sana
        $this->load->model('Tagihan_model'); 
        
        // Ubah status menjadi 'Menunggu Konfirmasi'
        $this->Tagihan_model->ubah_status($id_tagihan, 'Menunggu Konfirmasi');

        $this->session->set_flashdata('success', 'Permintaan pembayaran berhasil dikirim! Silakan tunggu konfirmasi dari petugas.');
        redirect('pelanggan/riwayat/tagihan');
    }
    
    public function pembayaran()
    {
        $id_pelanggan = $this->session->userdata('id_user');
        $data['title'] = "Riwayat Pembayaran Anda";
        $data['pembayaran'] = $this->Riwayat_model->get_riwayat_pembayaran($id_pelanggan);

        $this->load->view('templates/header', $data);
        $this->load->view('pelanggan/riwayat_pembayaran_view', $data);
        $this->load->view('templates/footer');
    }
}