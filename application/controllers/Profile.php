<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Auth_model $Auth_model
 * @property CI_Input $input
 * @property Profile_model $Profile_model
 * @property Tarif_model $Tarif_model
 */
class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi: Wajib login untuk akses
        if(!$this->session->userdata('logged_in')){
            redirect('auth');
        }
        $this->load->model('Profile_model');
        $this->load->model('Tarif_model'); // Dibutuhkan untuk form pelanggan
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        
        $data['title'] = "Profil Saya";
        $data['user'] = $this->Profile_model->get_user_by_id($id_user);

        // Tentukan view berdasarkan level pengguna
        if($level == 'pelanggan') {
            $data['tarif'] = $this->Tarif_model->get_all_tarif();
            $view = 'profile/profile_pelanggan_view';
        } else { // Untuk superadmin dan petugas
            $view = 'profile/profile_admin_view';
        }

        $this->load->view('templates/header', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        // Aturan validasi umum
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        
        // Aturan validasi khusus pelanggan
        if ($level == 'pelanggan') {
            $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|numeric');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('id_tarif', 'Tarif', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->index(); // Jika validasi gagal, kembali ke halaman profil
        } else {
            // Siapkan data update umum
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username')
            ];

            // Tambahkan data khusus pelanggan jika levelnya sesuai
            if($level == 'pelanggan') {
                $data['nomor_kwh'] = $this->input->post('nomor_kwh');
                $data['alamat'] = $this->input->post('alamat');
                $data['id_tarif'] = $this->input->post('id_tarif');
            }
            
            // Cek jika password baru diisi
            $password = $this->input->post('password');
            if($password) {
                $this->form_validation->set_rules('password', 'Password Baru', 'min_length[8]');
                $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password]');
                
                if($this->form_validation->run() == TRUE){
                   $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                } else {
                   $this->session->set_flashdata('error', validation_errors());
                   redirect('profile'); 
                   return;
                }
            }

            $this->Profile_model->update_profile($id_user, $data);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');

            // Perbarui data session jika nama lengkap berubah
            $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);

            redirect('profile');
        }
    }
}