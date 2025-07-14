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
 */
class Penggunaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi halaman
        if($this->session->userdata('level') != 'pelanggan'){
            redirect('auth');
        }
        $this->load->model('Penggunaan_model');
    }

    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_user');
        $data['title'] = "Data Penggunaan";
        $data['penggunaan'] = $this->Penggunaan_model->get_penggunaan_by_pelanggan($id_pelanggan);
        
        // Panggil fungsi baru untuk mendapatkan meter terakhir
        $data['meter_terakhir'] = $this->Penggunaan_model->get_meter_terakhir($id_pelanggan);
        
        // Memuat view dengan data baru
        $this->load->view('templates/header', $data);
        $this->load->view('pelanggan/penggunaan_view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        // Atur aturan validasi dasar
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'required|numeric');
        
        // ATURAN BARU: meter_akhir harus lebih besar atau sama dengan meter_awal
        $this->form_validation->set_rules(
            'meter_akhir', 
            'Meter Akhir', 
            'required|numeric|greater_than_equal_to[' . $this->input->post('meter_awal') . ']',
            // Pesan error kustom jika aturan greater_than_equal_to dilanggar
            array('greater_than_equal_to' => 'Angka Meter Akhir tidak boleh lebih rendah dari Meter Awal.')
        );

        // Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke halaman form dengan menampilkan error
            // Kita tidak me-redirect, tapi memuat ulang view agar data yang sudah diketik tidak hilang
            $id_pelanggan = $this->session->userdata('id_user');
            $data['title'] = "Data Penggunaan";
            $data['penggunaan'] = $this->Penggunaan_model->get_penggunaan_by_pelanggan($id_pelanggan);
            $data['meter_terakhir'] = $this->Penggunaan_model->get_meter_terakhir($id_pelanggan);
            
            $this->load->view('templates/header', $data);
            $this->load->view('pelanggan/penggunaan_view', $data); // View akan menampilkan error dari validation_errors()
            $this->load->view('templates/footer', $data);

        } else {
            // Jika validasi berhasil, lanjutkan proses penyimpanan ke database
            $id_pelanggan = $this->session->userdata('id_user');
            $data = [
                'id_pelanggan'  => $id_pelanggan,
                'bulan'         => $this->input->post('bulan'),
                'tahun'         => $this->input->post('tahun'),
                'meter_awal'    => $this->input->post('meter_awal'),
                'meter_akhir'   => $this->input->post('meter_akhir'),
            ];

            $this->Penggunaan_model->insert_penggunaan_dan_tagihan($data, $id_pelanggan);
            
            $this->session->set_flashdata('success', 'Data Penggunaan berhasil ditambahkan dan Tagihan telah dibuat!');
            redirect('pelanggan/penggunaan');
        }
    }

    public function edit($id_penggunaan)
    {
        $data['title'] = "Edit Data Penggunaan";
        $data['penggunaan'] = $this->Penggunaan_model->get_penggunaan_by_id($id_penggunaan);

        // Cek apakah data ada dan statusnya 'Belum Lunas'
        if (!$data['penggunaan'] || $data['penggunaan']->status != 'Belum Lunas') {
            $this->session->set_flashdata('error', 'Data penggunaan ini tidak bisa diedit.');
            redirect('pelanggan/penggunaan');
        }

        $this->load->view('templates/pelanggan/header', $data);
        $this->load->view('pelanggan/penggunaan_edit_view', $data); // Kita akan buat view ini
        $this->load->view('templates/pelanggan/footer', $data);
    }

    public function proses_edit($id_penggunaan)
    {
        $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'required|numeric|greater_than_equal_to[' . $this->input->post('meter_awal') . ']', array('greater_than_equal_to' => 'Meter Akhir tidak boleh lebih rendah dari Meter Awal.'));
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_penggunaan); // Kembali ke form edit jika validasi gagal
        } else {
            $id_pelanggan = $this->session->userdata('id_user');
            $data_penggunaan = [
                'bulan'       => $this->input->post('bulan'),
                'tahun'       => $this->input->post('tahun'),
                'meter_awal'  => $this->input->post('meter_awal'),
                'meter_akhir' => $this->input->post('meter_akhir')
            ];

            $this->Penggunaan_model->update_penggunaan_dan_tagihan($id_penggunaan, $data_penggunaan, $id_pelanggan);
            $this->session->set_flashdata('success', 'Data Penggunaan berhasil diperbarui!');
            redirect('pelanggan/penggunaan');
        }
    }

    public function hapus($id_penggunaan)
    {
        $penggunaan = $this->Penggunaan_model->get_penggunaan_by_id($id_penggunaan);

        // Cek apakah data ada dan statusnya 'Belum Lunas'
        if (!$penggunaan || $penggunaan->status != 'Belum Lunas') {
            $this->session->set_flashdata('error', 'Data penggunaan ini tidak bisa dihapus.');
        } else {
            $this->Penggunaan_model->delete_penggunaan($id_penggunaan);
            $this->session->set_flashdata('success', 'Data Penggunaan berhasil dihapus!');
        }
        redirect('pelanggan/penggunaan');
    }
}