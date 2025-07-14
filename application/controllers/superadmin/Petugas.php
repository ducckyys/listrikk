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
 * @property Petugas_model $Petugas_model
 */
// Kembali menggunakan CI_Controller
class Petugas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi login dan level diletakkan kembali di setiap controller
        if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Petugas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Manajemen Petugas";
        $data['petugas'] = $this->Petugas_model->get_all_petugas();
        
        // Memuat view secara manual satu per satu
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/petugas_view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Petugas";
            
            $this->load->view('templates/header', $data);
            $this->load->view('superadmin/petugas_tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 'petugas'
            ];
            $this->Petugas_model->insert_petugas($data);
            $this->session->set_flashdata('success', 'Data Petugas berhasil ditambahkan!');
            redirect('superadmin/petugas');
        }
    }
    
    public function edit($id)
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Petugas";
            $data['user'] = $this->Petugas_model->get_petugas_by_id($id);

            $this->load->view('templates/header', $data);
            $this->load->view('superadmin/petugas_edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_user = $this->input->post('id_user');
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
            ];
            
            $password = $this->input->post('password');
            if($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->Petugas_model->update_petugas($id_user, $data);
            $this->session->set_flashdata('success', 'Data Petugas berhasil diperbarui!');
            redirect('superadmin/petugas');
        }
    }

    public function hapus($id)
    {
        if ($this->Petugas_model->delete_petugas($id)) {
            $this->session->set_flashdata('success', 'Data Petugas berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }
        redirect('superadmin/petugas');
    }
}