<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Auth_model $Auth_model
 * @property CI_Input $input 
 */
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Fungsi ini tidak perlu diubah
        if($this->session->userdata('level') == 'superadmin'){
            redirect('superadmin/dashboard');
        } else if($this->session->userdata('level') == 'petugas'){
            redirect('petugas/dashboard');
        } else if ($this->session->userdata('level') == 'pelanggan'){
            redirect('pelanggan/dashboard');
        }

        $this->load->view('login_view');
    }

    public function proses_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // ===== SISIPKAN KODE DEBUG DI SINI =====
            //echo "Data yang diterima dari form:";
            //echo "<pre>"; // Tag <pre> agar tampilan var_dump lebih rapi
            //var_dump($username);
            //var_dump($password);
            //echo "</pre>";
            //die(); // <-- Perintah PENTING untuk menghentikan program di sini!
            // =====================================

            // Model sudah diubah untuk melakukan JOIN ke tabel level
            $user = $this->Auth_model->cek_login($username);

            if($user && password_verify($password, $user->password)) {
                $session_data = array(
                    'id_user'      => $user->id_user,
                    'username'     => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    // PERUBAHAN DI SINI: Mengambil nama_level dari hasil JOIN di model
                    'level'        => $user->nama_level, 
                    'logged_in'    => TRUE
                );
                $this->session->set_userdata($session_data);

                // PERUBAHAN DI SINI: Redirect berdasarkan nama_level
                switch ($user->nama_level) {
                    case 'superadmin':
                        redirect('superadmin/dashboard');
                        break;
                    case 'petugas':
                        redirect('petugas/dashboard');
                        break;
                    case 'pelanggan':
                        redirect('pelanggan/dashboard');
                        break;
                    default:
                        redirect('auth');
                        break;
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        // Fungsi ini tidak perlu diubah
        $this->session->sess_destroy();
        redirect('auth');
    }
}