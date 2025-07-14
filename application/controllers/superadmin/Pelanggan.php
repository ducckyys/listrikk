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
 */
class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Pelanggan_model');
        $this->load->model('Tarif_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Manajemen Pelanggan";
        $data['pelanggan'] = $this->Pelanggan_model->get_all_pelanggan();
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/pelanggan_view', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        // ... (aturan validasi lainnya seperti pada controller Register)

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan form tambah jika validasi gagal atau pertama kali diakses
            $data['title'] = "Tambah Pelanggan";
            $data['tarif'] = $this->Tarif_model->get_all_tarif();
            $this->load->view('templates/header', $data);
            $this->load->view('superadmin/pelanggan_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            // Proses data jika validasi berhasil
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nomor_kwh' => $this->input->post('nomor_kwh'),
                'alamat' => $this->input->post('alamat'),
                'id_tarif' => $this->input->post('id_tarif'),
                'level' => 'pelanggan'
            ];
            $this->Pelanggan_model->insert_pelanggan($data);
            $this->session->set_flashdata('success', 'Data Pelanggan berhasil ditambahkan!');
            redirect('superadmin/pelanggan');
        }
    }
    
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        // ... (aturan validasi lainnya, tidak perlu validasi password jika tidak diubah)

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Pelanggan";
            $data['pelanggan'] = $this->Pelanggan_model->get_pelanggan_by_id($id);
            $data['tarif'] = $this->Tarif_model->get_all_tarif();

            $this->load->view('templates/header', $data);
            $this->load->view('superadmin/pelanggan_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user = $this->input->post('id_user');
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'nomor_kwh' => $this->input->post('nomor_kwh'),
                'alamat' => $this->input->post('alamat'),
                'id_tarif' => $this->input->post('id_tarif'),
            ];
            
            // Cek jika password diisi, maka update password
            $password = $this->input->post('password');
            if($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->Pelanggan_model->update_pelanggan($id_user, $data);
            $this->session->set_flashdata('success', 'Data Pelanggan berhasil diperbarui!');
            redirect('superadmin/pelanggan');
        }
    }

    public function hapus($id)
    {
        $this->Pelanggan_model->delete_pelanggan($id);
        $this->session->set_flashdata('success', 'Data Pelanggan berhasil dihapus!');
        redirect('superadmin/pelanggan');
    }
}