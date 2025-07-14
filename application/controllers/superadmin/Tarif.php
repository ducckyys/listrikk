<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * =================================================================
 * Controller ini adalah modul yang bertanggung jawab untuk semua 
 * logika yang berkaitan dengan manajemen data tarif listrik oleh Superadmin.
 * =================================================================
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
class Tarif extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi halaman
        if($this->session->userdata('level') != 'superadmin'){
            redirect('auth');
        }
        $this->load->model('Tarif_model');
    }

    public function index()
    {
        $data['title'] = "Manajemen Tarif";
        $data['tarif'] = $this->Tarif_model->get_all_tarif();
        
        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/tarif_view', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        // Generate kode tarif unik
        $kode_tarif = 'TRF' . date('Ym') . substr(uniqid(), -4);

        $data = [
            'kode_tarif' => $kode_tarif,
            'daya' => $this->input->post('daya'),
            'tarif_per_kwh' => $this->input->post('tarif_per_kwh'),
        ];
        $this->Tarif_model->insert_tarif($data);
        $this->session->set_flashdata('success', 'Data Tarif berhasil ditambahkan!');
        redirect('superadmin/tarif');
    }

    public function update()
    {
        $id = $this->input->post('id_tarif');
        $data = [
            'daya' => $this->input->post('daya'),
            'tarif_per_kwh' => $this->input->post('tarif_per_kwh'),
        ];
        $this->Tarif_model->update_tarif($id, $data);
        $this->session->set_flashdata('success', 'Data Tarif berhasil diperbarui!');
        redirect('superadmin/tarif');
    }

    /**
     * Menghapus data tarif dari database berdasarkan ID.  <-- Deskripsi Fungsi
     * * NOTE: Terdapat penanganan kondisi khusus (eksepsi), yaitu
     * fungsi akan mengembalikan 'false' jika user mencoba menghapus
     * akunnya sendiri untuk mencegah error.
     * 
     * @param int $id ID dari tarif yang akan dihapus.   <-- Penjelasan Parameter
     * @return bool Hasil dari operasi delete.           <-- Penjelasan Nilai Kembalian
     */
    public function hapus($id)
    {
        // Ini adalah penanganan 'eksepsi' atau kondisi khusus
    if ($id == $this->session->userdata('id_user')) {
        return false; 
    }
        $this->Tarif_model->delete_tarif($id);
        $this->session->set_flashdata('success', 'Data Tarif berhasil dihapus!');
        redirect('superadmin/tarif');
    }
}