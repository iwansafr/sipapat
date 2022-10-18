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
    public function getStatistikAgama()
    {
        $output = [];    
        $output['islam'] = $this->db->query('SELECT sum(islam) AS `Jumlah Warga Beragama Islam` FROM statistik_penduduk')->row_array();
        $output['kristen'] = $this->db->query('SELECT sum(kristen) AS `Jumlah Warga Beragama Kristen` FROM statistik_penduduk')->row_array();
        $output['katholik'] = $this->db->query('SELECT sum(katholik) AS `Jumlah Warga Beragama Katholik` FROM statistik_penduduk')->row_array();
        $output['hindu'] = $this->db->query('SELECT sum(hindu) AS `Jumlah Warga Beragama Hindu` FROM statistik_penduduk')->row_array();
        $output['budha'] = $this->db->query('SELECT sum(budha) AS `Jumlah Warga Beragama Budha` FROM statistik_penduduk')->row_array();
        $output['khonghucu'] = $this->db->query('SELECT sum(khonghucu) AS `Jumlah Warga Beragama Khong Hucu` FROM statistik_penduduk')->row_array();
        $output['penghayat_kepercayaan'] = $this->db->query('SELECT sum(penghayat_kepercayaan) AS `Jumlah Warga Penghayat Kepercayaan` FROM statistik_penduduk')->row_array();
        return $output;
    }
    public function getStatistikPekerjaan()
    {
        $output = [];
        $output['asn'] = $this->db->query('SELECT SUM(asn) AS `Jumlah ASN` FROM statistik_penduduk')->row_array();
        $output['tni'] = $this->db->query('SELECT SUM(tni) AS `Jumlah TNI` FROM statistik_penduduk')->row_array();
        $output['polri'] = $this->db->query('SELECT SUM(polri) AS `Jumlah POLRI` FROM statistik_penduduk')->row_array();
        $output['karyawan_swasta'] = $this->db->query('SELECT SUM(karyawan_swasta) AS `Jumlah Karyawan Swasta` FROM statistik_penduduk')->row_array();
        $output['karyawan_bumn'] = $this->db->query('SELECT SUM(karyawan_bumn) AS `Jumlah Karyawan BUMN/BUMN` FROM statistik_penduduk')->row_array();
        $output['petani'] = $this->db->query('SELECT SUM(petani) AS `Jumlah Petani` FROM statistik_penduduk')->row_array();
        $output['buruh_tani'] = $this->db->query('SELECT SUM(buruh_tani) AS `Jumlah Buruh Tani` FROM statistik_penduduk')->row_array();
        $output['nelayan'] = $this->db->query('SELECT SUM(nelayan) AS `Jumlah Nelayan` FROM statistik_penduduk')->row_array();
        $output['wiraswasta'] = $this->db->query('SELECT SUM(wiraswasta) AS `Jumlah Wiraswasta` FROM statistik_penduduk')->row_array();
        $output['ibu_rumah_tangga'] = $this->db->query('SELECT SUM(ibu_rumah_tangga) AS `Jumlah Ibu Rumah Tangga` FROM statistik_penduduk')->row_array();
        $output['belum_bekerja'] = $this->db->query('SELECT SUM(belum_bekerja) AS `Jumlah Belum Bekerja` FROM statistik_penduduk')->row_array();

        return $output;
    }
}