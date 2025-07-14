<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property unit $unit
 */
    class Uji_unit extends CI_Controller {

        public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
    }

    // Fungsi simulasi yang akan diuji
    private function hitung_tagihan($penggunaan, $tarif_per_kwh) {
        if ($penggunaan->meter_akhir <= $penggunaan->meter_awal) {
            return 'Error: Meter akhir harus lebih besar dari meter awal';
        }
        $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;
        return ($jumlah_meter * $tarif_per_kwh);
    }

    // Method untuk menjalankan semua test case
    public function test_semua() {
        // Skenario 1: Normal
        $penggunaan1 = (object)['meter_awal' => 1000, 'meter_akhir' => 1200];
        $hasil_aktual1 = $this->hitung_tagihan($penggunaan1, 1500);
        $this->unit->run($hasil_aktual1, 300000, 'Test Case 1: Perhitungan Normal');

            // Skenario 2: Meter Sama
        $penggunaan2 = (object)['meter_awal' => 1500, 'meter_akhir' => 1500];
        $hasil_aktual2 = $this->hitung_tagihan($penggunaan2, 1500);
        $this->unit->run($hasil_aktual2, 'is_string', 'Test Case 2: Meter Sama (Kasus Error)');

        // Skenario 3: Meter Mundur
        $penggunaan3 = (object)['meter_awal' => 2000, 'meter_akhir' => 1900];
        $hasil_aktual3 = $this->hitung_tagihan($penggunaan3, 1500);
        $this->unit->run($hasil_aktual3, 'is_string', 'Test Case 3: Meter Mundur (Kasus Error)');

        echo $this->unit->report();
    }
}