<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan_model extends CI_Model
{
	public function upload($file = '', $mode = '')
	{
		if(!empty($file['tmp_name']))
		{
			$dir = FCPATH.'images/modules/dilan/';
			if(!is_dir($dir))
			{
				mkdir($dir, 0777);
			}
			if(copy($file['tmp_name'] , $dir.$_SESSION[base_url().'_logged_in']['username'].$mode.'.xlsx'))
			{
				return $_SESSION[base_url().'_logged_in']['username'].'.xlsx';
			}
		}
	}
	public function get_config($name = '')
  {
		$data = array();
		if(!empty($name))
		{
			$value = $this->db->query('SELECT value FROM dilan_config WHERE name = ?', $name)->row_array();
			if(!empty($value))
			{
				$data = json_decode($value['value'], 1);
			}
		}
		return $data;
	}

	public function get_keterangan($id = 0)
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$desa = $this->sipapat_model->get_desa($desa_id);
		$data = [];
		if(!empty($id))
		{
			$this->db->where(['id'=>$id]);
		}
		$this->load->model('sipapat_model');
		// $this->load->model('sipapat_model');
		$kabupaten = $this->esg->get_config('sipapat_config');
		$data_tmp = $this->db->get('dilan_surat_ket')->result_array();
		$i = 0;
		foreach ($data_tmp as $key => $value) 
		{
			$keterangan = $value['keterangan'];
			$keterangan = strtolower($keterangan);
			$keterangan = str_replace('{desa}', @ucfirst(strtolower($desa['nama'])), $keterangan);
			$keterangan = str_replace('{kecamatan}', @ucfirst(strtolower($desa['kecamatan'])), $keterangan);
			$keterangan = str_replace('{kabupaten}', @ucfirst(strtolower($kabupaten['kabupaten'])), $keterangan);
			$value['keterangan'] = $keterangan;
			$data[$i] = $value;
			$i++;
		}
		return $data;

	}
	public function get_penduduk($id = 0)
	{
		return $this->db->get_where('penduduk',['id'=>$id])->row_array();
	}
	public function get_surat($id = 0)
	{
		return $this->db->get_where('dilan_surat',['id'=>$id])->row_array();
	}

	public function kelamin()
	{
		return ['1'=>'Laki-laki', '2'=>'Perempuan'];
	}

	public function golongan_darah()
	{
		$data = ['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-','tidak tahu'];
		$data = array_start_one($data);
		return $data;
	}

	public function agama()
	{
		$data = ['1'=>'Islam','2'=>'Kristen','3'=>'Katholik','4'=>'Hindu','5'=>'Budha','6'=>'Khong Hucu','7'=>'Penghayat Kepercayaan ','8'=>'Lainnya'];
		return $data;
	}

	public function status()
	{
		return ['1'=>'Belum Kawin','2'=>'Kawin','3'=>'Cerai Hidup','4'=>'Cerai Mati'];
	}

	public function shdk()
	{
		$data = [
			'1'=>'Kepala Keluarga',
			'2'=>'Suami',
			'3'=>'Isteri',
			'4'=>'Anak',
			'5'=>'Menantu',
			'6'=>'Cucu',
			'7'=>'Orang Tua',
			'8'=>'Mertua',
			'9'=>'Famili Lain',
			'10'=>'Pembantu',
			'11'=>'Lainnya'
		];
		return $data;
	}

	public function cacat()
	{
		$data = [
			 '0'=>'Tidak Cacat',
			 '1'=>'Cacat Fisik',
			 '2'=>'Cacat Netra/Buta',
			 '3'=>'Cacat Rungu/Wicara',
			 '4'=>'Cacat Mental/Jiwa',
			 '5'=>'Cacat Fisik dan Mental',
			 '6'=>'Cacat lainnya'
		];
		return $data;
	}

	public function pendidikan()
	{
		$data = [
			1=>'Tidak/Belum Sekolah',
			2=>'Tidak Tamat SD/Sederajat',
			3=>'Tamat SD/Sederajat',
			4=>'SLTP/Sederajat',
			5=>'SLTA/Sederjat',
			6=>'Diploma I/II',
			7=>'Akademi/Diploma III/S. Muda',
			8=>'DilpomaIV/Strata I',
			9=>'Strata II',
			10=>'Strata III'
		];
		return $data;
	}

	public function pekerjaan()
	{
		return [
      '1' => 'BELUM/TIDAK BEKERJA',
      '2' => 'MENGURUS RUMAH TANGGA',
      '3' => 'PELAJAR/MAHASISWA',
      '4' => 'PENSIUNAN',
      '5' => 'PEGAWAI NEGRI SIPIL',
      '6' => 'TENTARA NASIONAL INDONESIA',
      '7' => 'KEPOLISIAN RI',
      '8' => 'PERDAGANGAN',
      '9' => 'PETANI/PEKEBUN',
      '10' => 'PETERNAK',
      '11' => 'NELAYAN/PERIKANAN',
      '12' => 'INDUSTRI',
      '13' => 'KONSTRUKSI',
      '14' => 'TRANSPORTASI',
      '15' => 'KARYAWAN SWASTA',
      '16' => 'KARYAWAN BUMN',
      '17' => 'KARYAWAN BUMD',
      '18' => 'KARYAWAN HONORER',
      '19' => 'BURUH HARIAN LEPAS',
      '20' => 'BURUH TANI/PERKEBUNAN',
      '21' => 'BURUH NELAYAN/PERIKANAN',
      '22' => 'BURUH PETERNAKAN',
      '23' => 'PEMBANTU RUMAH TANGGA',
      '24' => 'TUKANG CUKUR',
      '25' => 'TUKANG LISTRIK',
      '26' => 'TUKANG BATU',
      '27' => 'TUKANG KAYU',
      '28' => 'TUKANG SOL SEPATU',
      '29' => 'TUKANG LAS/PANDAI BESI',
      '30' => 'TUKANG JAHIT',
      '31' => 'PENATA RAMBUT',
      '32' => 'PENATA RIAS',
      '33' => 'PENATA BUSANA',
      '34' => 'MEKANIK',
      '35' => 'TUKANG GIGI',
      '36' => 'SENIMAN',
      '37' => 'TABIB',
      '38' => 'PARAJI',
      '39' => 'PERANCANG BUSANA',
      '40' => 'PENTERJEMAH',
      '41' => 'IMAM MASJID',
      '42' => 'PENDETA',
      '43' => 'PASTUR',
      '44' => 'WARTAWAN',
      '45' => 'USTADZ/MUBALIGH',
      '46' => 'JURU MASAK',
      '47' => 'PROMOTOR ACARA',
      '48' => 'ANGGOTA DPR-RI',
      '49' => 'ANGGOTA DPD',
      '50' => 'ANGGOTA BPK',
      '51' => 'PRESIDEN',
      '52' => 'WAKIL PRESIDEN',
      '53' => 'ANGGOTA MAHKAMAH',
      '54' => 'KONSTITUSI',
      '55' => 'ANGGOTA KABINET/KEMENTRIAN',
      '56' => 'DUTA BESAR',
      '57' => 'GUBERNUR',
      '58' => 'WAKIL GUBERNUR',
      '59' => 'BUPATI',
      '60' => 'WAKIL BUPATI',
      '61' => 'WALIKOTA',
      '62' => 'WAKIL WALIKOTA',
      '63' => 'ANGGOTA DPRD PROPINSI ANGGOTA DPRD KABUPATEN/KOTA',
      '64' => 'DOSEN',
      '65' => 'GURU',
      '66' => 'PILOT',
      '67' => 'PENGACARA',
      '68' => 'NOTARIS',
      '69' => 'ARSITEK',
      '70' => 'AKUNTAN',
      '71' => 'KONSULTAN',
      '72' => 'DOKTER',
      '73' => 'BIDAN',
      '74' => 'PERAWAT',
      '75' => 'APOTEKER',
      '76' => 'PSIKATER/PSIKOLOG',
      '77' => 'PENYIAR TELEVISI',
      '78' => 'PENYIAR RADIO',
      '79' => 'PELAUT',
      '80' => 'PENELITI',
      '81' => 'SOPIR',
      '82' => 'PIALANG',
      '83' => 'PARANORMAL',
      '84' => 'PEDAGANG',
      '85' => 'PERANGKAT DESA',
      '86' => 'KEPALA DESA',
      '87' => 'BIARAWATI',
      '88' => 'WIRASWASTA',
      '89' => 'LAINNYA'
    ];
	}

	public function surat_group()
	{
		$this->db->select('id,title');
		$surat_ket = $this->db->get('dilan_surat_ket')->result_array();
		$desa_id = $this->sipapat_model->get_desa_id();
		if(!empty($surat_ket))
		{
			foreach ($surat_ket as $key => $value) 
			{
				$this->db->select("COUNT('id') AS total");
				$surat_ket[$key]['total'] = $this->db->get_where('dilan_surat',['dilan_surat_ket_id'=>$value['id'],'desa_id'=>$desa_id])->row_array()['total'];
				$surat_ket[$key]['query'] = $this->db->last_query();
			}
		}
		return $surat_ket;
	}
	public function laporan()
	{
		return $this->db->query('SELECT desa_id,desa.nama FROM penduduk INNER JOIN desa ON(desa.id=penduduk.desa_id) GROUP BY desa_id')->result_array();
	}
	public function total_penduduk($desa_id = 0)
	{
		$ids = $this->db->query('SELECT count(id) AS total FROM penduduk WHERE desa_id = ?',$desa_id)->row_array();
		if(!empty($ids))
		{
			$total = $ids['total'];
		}
		$total_kk = $this->db->query('SELECT count(no_kk) AS total FROM penduduk WHERE desa_id = ? GROUP BY no_kk',$desa_id)->result_array();

		$total_kk = count($total_kk);
		return ['penduduk'=>$total,'kk'=>$total_kk];
		// $rt = $this->db->query('SELECT no_rt FROM penduduk WHERE desa_id = ? GROUP BY no_rt', $desa_id)->result_array();
		// pr($rt);
		// $rw = $this->db->query('SELECT no_rw FROM penduduk WHERE desa_id = ? GROUP BY no_rw', $desa_id)->result_array();
		// pr($rw);
		// foreach ($rt as $key => $value) 
		// {
		// 	$kk_rt = $this->db->query('SELECT no_kk FROM penduduk WHERE desa_id = ? AND no_rt = ? group by no_kk', [$desa_id,$value])->result_array();
		// 	pr(count($kk_rt));
		// }
	}
}