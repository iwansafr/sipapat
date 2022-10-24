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

    public function getStatistikFasPen()
    {
        $output = [];
        $output['faspen_tk'] = $this->db->query('SELECT SUM(faspen_tk) AS `Jumlah TK/PAUD/RA` FROM statistik_penduduk')->row_array();
        $output['faspen_sd'] = $this->db->query('SELECT SUM(faspen_sd) AS `Jumlah SD/MI` FROM statistik_penduduk')->row_array();
        $output['faspen_sltp'] = $this->db->query('SELECT SUM(faspen_sltp) AS `Jumlah SLTP/SMP/MTS` FROM statistik_penduduk')->row_array();
        $output['faspen_slta'] = $this->db->query('SELECT SUM(faspen_slta) AS `Jumlah SLTA` FROM statistik_penduduk')->row_array();
        $output['faspen_pesantren'] = $this->db->query('SELECT SUM(faspen_pesantren) AS `Jumlah Pondok Pesantren` FROM statistik_penduduk')->row_array();
        $output['faspen_perguruan_tinggi'] = $this->db->query('SELECT SUM(faspen_perguruan_tinggi) AS `Jumlah Perguruan Tinggi` FROM statistik_penduduk')->row_array();

        return $output;
    }
    public function getStatistikFasPem()
    {
        $output = [];
        $output['faspem_kantor_desa'] = $this->db->query('SELECT SUM(faspem_kantor_desa) AS `Jumlah Kantor Desa` FROM statistik_penduduk')->row_array();
        $output['faspem_balai_desa'] = $this->db->query('SELECT SUM(faspem_balai_desa) AS `Jumlah Balai Desa` FROM statistik_penduduk')->row_array();
        $output['faspem_perpus_desa'] = $this->db->query('SELECT SUM(faspem_perpus_desa) AS `Jumlah Perpustakaan Desa` FROM statistik_penduduk')->row_array();
        return $output;
    }

    public function getStatistikFasIb()
    {
        $output = [];
        $output['fasib_masjid'] = $this->db->query('SELECT SUM(fasib_masjid) AS `Jumlah Masjid` FROM statistik_penduduk')->row_array();
        $output['fasib_mushola'] = $this->db->query('SELECT SUM(fasib_mushola) AS `Jumlah Mushola` FROM statistik_penduduk')->row_array();
        $output['fasib_gereja'] = $this->db->query('SELECT SUM(fasib_gereja) AS `Jumlah Gereja` FROM statistik_penduduk')->row_array();
        $output['fasib_wihara'] = $this->db->query('SELECT SUM(fasib_wihara) AS `Jumlah Wihara` FROM statistik_penduduk')->row_array();
        $output['fasib_klenteng'] = $this->db->query('SELECT SUM(fasib_klenteng) AS `Jumlah Klenteng` FROM statistik_penduduk')->row_array();
        return $output;
    }
    public function getStatistikFasEk()
    {
        $output = [];
        $output[] = $this->db->query('SELECT SUM(fasek_pasar_desa) AS `Jumlah Pasar Desa` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(fasek_toko) AS `Jumlah Toko` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(fasek_swalayan) AS `Jumlah Swalayan` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(fasek_restoran) AS `Jumlah Restoran` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(fasek_rumah_makan) AS `Jumlah Rumah Makan` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(fasek_warung_makan) AS `Jumlah Warung Makan` FROM statistik_penduduk')->row_array();
        return $output;
    }

    public function getStatistikFasKes()
    {
        $output = [];
        $output[] = $this->db->query('SELECT SUM(faskes_pkd) AS `Jumlah Pos Kesehatan Desa` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(faskes_puskesmas) AS `Jumlah Puskesmas` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(faskes_klinik) AS `Jumlah Klinik` FROM statistik_penduduk')->row_array();
        $output[] = $this->db->query('SELECT SUM(faskes_dokter_praktik) AS `Jumlah Dokter Praktik` FROM statistik_penduduk')->row_array();
        return $output;
    }
}