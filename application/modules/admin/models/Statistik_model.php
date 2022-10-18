<?php defined('BASEPATH') or exit('No direct script access allowed');

class Statistik_model extends CI_Model
{

    public function getIdStatistikDesa($desa_id = 0)
    {
        if(!empty($desa_id))
        {
            $this->db->select('id');
            $this->db->where('desa_id',$desa_id);
            $output = $this->db->get('statistik_penduduk')->result_array();
            if(empty($output))
            {
                $this->db->insert('statistik_penduduk',[
                    'desa_id' => $desa_id,
                ]);
            }else{
                return $output;
            }
        }
    }
    public function getStatistikPendidikan()
    {
        $output = [];
    
        $output['tidak_belum_sekolah'] = $this->db->query('SELECT SUM(tidak_belum_sekolah) AS `Jumlah Warga Tidak / Belum Sekolah` FROM statistik_penduduk')->row_array();

        $output['tidak_tamat_sd'] = $this->db->query('SELECT SUM(tidak_tamat_sd) AS `Jumlah Warga Tidak Tamat SD` FROM statistik_penduduk')->row_array();

        $output['tamat_sd'] = $this->db->query('SELECT SUM(tamat_sd) AS `Jumlah Warga Tamat / Lulus SD` FROM statistik_penduduk')->row_array();

        $output['sltp'] = $this->db->query('SELECT SUM(sltp) AS `Jumlah Warga Tamat / Lulus SLTP` FROM statistik_penduduk')->row_array();

        $output['slta'] = $this->db->query('SELECT SUM(slta) AS `Jumlah Warga Tamat / Lulus SLTA` FROM statistik_penduduk')->row_array();

        $output['d1_d2'] = $this->db->query('SELECT SUM(d1_d2) `Jumlah Warga Tamat / Lulus D1 - D2` FROM statistik_penduduk')->row_array();

        $output['d3'] = $this->db->query('SELECT SUM(d3) `Jumlah Warga Tamat / Lulus D3 / Sarjana Muda` FROM statistik_penduduk')->row_array();

        $output['s1'] = $this->db->query('SELECT SUM(s1) `Jumlah Warga Sarjana` FROM statistik_penduduk')->row_array();

        $output['s2'] = $this->db->query('SELECT SUM(s2) `Jumlah Warga Pasca Sarjana` FROM statistik_penduduk')->row_array();

        $output['s3'] = $this->db->query('SELECT SUM(s3) `Jumlah Warga Dengan Gelar S3 / Doktor` FROM statistik_penduduk')->row_array();

        return $output;
    }
}