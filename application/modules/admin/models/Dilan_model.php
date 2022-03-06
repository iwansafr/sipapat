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
			if(!empty($desa))
			{
				$keterangan = str_replace('{desa}', @ucfirst(strtolower($desa['nama'])), $keterangan);
				$keterangan = str_replace('{kecamatan}', @ucfirst(strtolower($desa['kecamatan'])), $keterangan);
				$keterangan = str_replace('{kabupaten}', @ucfirst(strtolower($kabupaten['kabupaten'])), $keterangan);
			}
			$value['keterangan'] = $keterangan;
			$data[$value['id']] = $value;
			$i++;
		}
		return $data;

	}
	public function get_penduduk_by_nik($nik = 0, $desa_id = 0)
	{
		if(!empty($nik))
		{
			if(!empty($desa_id))
			{
				return $this->db->query('SELECT * FROM penduduk WHERE nik = ? AND desa_id = ?',[$nik,$desa_id])->row_array();
			}else{
				return $this->db->query('SELECT * FROM penduduk WHERE nik = ?',$nik)->row_array();
			}
		}
	}
	public function get_penduduk($id = 0)
	{
		return $this->db->get_where('penduduk',['id'=>$id])->row_array();
	}
	public function get_surat($id = 0)
	{
		return $this->db->get_where('dilan_surat',['id'=>$id])->row_array();
	}

	public function get_surat_used($desa_id = 0,$cat_id = 0)
	{
		$where = [];
		if(!empty($desa_id))
		{
			$where['desa_id'] = $desa_id;
		}
		if(!empty($cat_id))
		{
			$where['dilan_surat_ket_id'] = $cat_id;
		}
		$this->db->select('dilan_surat_ket_id,count(dilan_surat_ket_id) AS total');
		$this->db->group_by('dilan_surat_ket_id');
		return $this->db->get_where('dilan_surat',$where)->result_array();
	}

	public function kelamin()
	{
		return ['0'=>'Tidak Diketahui','1'=>'Laki-laki', '2'=>'Perempuan'];
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

	public function umur()
	{
		return [
			'1'=>'balita (1-5 th)',
			'2'=>'anak-anak (6-11 th)',
			'3'=>'remaja (12-25 th)',
			'4'=>'dewasa (26-45 th)',
			'5'=>'lansia (lebih dari 45 th)',
		];
	}

	public function data_by_umur($desa_id)
	{
		$usia = $this->db->query("SELECT DATEDIFF(CURRENT_DATE, STR_TO_DATE(p.tgl_lhr, '%Y-%m-%d'))/365 AS usia FROM penduduk AS p where desa_id = ?",$desa_id)->result_array();
		$usia_tmp = [];
		if(!empty($usia))
		{
			$usia_tmp['balita'] = 0;
			$usia_tmp['anak-anak'] = 0;
			$usia_tmp['remaja'] = 0;
			$usia_tmp['dewasa'] = 0;
			$usia_tmp['lansia'] = 0;
			foreach ($usia as $key => $value) 
			{
				if($value['usia'] < 5)
				{
					$usia_tmp['balita'] +=1;
				}else if($value['usia'] <= 11)
				{
					$usia_tmp['anak-anak'] +=1;
				}else if($value['usia'] <= 25)
				{
					$usia_tmp['remaja'] +=1;
				}else if($value['usia'] <= 45){
					$usia_tmp['dewasa'] +=1;
				}else if($value['usia'] >= 46){
					$usia_tmp['lansia'] +=1;
				}
			}
		}		
	}

	public function surat_group($desa_id = 0)
	{
		$this->db->select('id,title');
		$surat_ket = $this->db->get('dilan_surat_ket')->result_array();
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}
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
		$total_pria = $this->db->query('SELECT count(id) AS total FROM penduduk WHERE desa_id = ? AND jk = 1',$desa_id)->row_array();
		if(!empty($total_pria))
		{
			$total_pria = $total_pria['total'];
		}
		$total_wanita = $this->db->query('SELECT count(id) AS total FROM penduduk WHERE desa_id = ? AND jk = 2',$desa_id)->row_array();
		if(!empty($total_wanita))
		{
			$total_wanita = $total_wanita['total'];
		}
		$usia = $this->db->query("SELECT DATEDIFF(CURRENT_DATE, STR_TO_DATE(p.tgl_lhr, '%Y-%m-%d'))/365 AS usia FROM penduduk AS p where desa_id = ?",$desa_id)->result_array();
		$usia_tmp = [];
		if(!empty($usia))
		{
			$usia_tmp['balita'] = 0;
			$usia_tmp['anak-anak'] = 0;
			$usia_tmp['remaja'] = 0;
			$usia_tmp['dewasa'] = 0;
			$usia_tmp['lansia'] = 0;
			foreach ($usia as $key => $value) 
			{
				if($value['usia'] < 5)
				{
					$usia_tmp['balita'] +=1;
				}else if($value['usia'] <= 11)
				{
					$usia_tmp['anak-anak'] +=1;
				}else if($value['usia'] <= 25)
				{
					$usia_tmp['remaja'] +=1;
				}else if($value['usia'] <= 45){
					$usia_tmp['dewasa'] +=1;
				}else if($value['usia'] >= 46){
					$usia_tmp['lansia'] +=1;
				}
			}
		}
		$janda = $this->db->query("SELECT count(id) AS total FROM penduduk where desa_id = ? AND (status = 3 OR status = 4) AND jk = 2",$desa_id)->row_array();
		$janda = @intval($janda['total']);		
		return ['penduduk'=>$total,'kk'=>$total_kk,'pria'=>$total_pria,'wanita'=>$total_wanita,'usia'=>$usia_tmp,'janda'=>$janda];
	}

	public function save_surat_pengajuan()
	{
		$last_id = $this->zea->get_insert_id();
		if(!empty($last_id))
		{
			$data = $this->db->get_where('dilan_surat',['id'=>$last_id])->row_array();
			if(!empty($data))
			{
				$desa     = $this->sipapat_model->get_desa($data['desa_id']);
				$user     = $this->session->userdata(base_url() . '_logged_in');
				if (empty($user)) {
					$user = $this->db->get_where('user_desa', ['desa_id' => $desa['id']])->row_array();
					$user['id'] = $user['user_id'];
				}
				$config   = $this->dilan_model->get_config($desa['id'] . '_' . $user['id']);

				if(empty($config['is_dilan']))
				{
					$last_surat = $this->db->query('SELECT no_urut FROM dilan_surat WHERE desa_id = ? AND YEAR(created) = ? ORDER BY no_urut DESC',[$data['desa_id'],date('Y')])->row_array();
				}else{
					$last_surat = $this->db->query('SELECT no_urut FROM dilan_surat WHERE desa_id = ? AND MONTH(created) = ? AND YEAR(created) = ? ORDER BY no_urut DESC',[$data['desa_id'],date('m'),date('Y')])->row_array();
				}
				if(!empty($last_surat))
				{
					$last_surat = @intval($last_surat['no_urut']);
					$no_urut = $last_surat+1;
				}else{
					$no_urut = 1;
				}
				if($no_urut < 10){
					$text_no = '000';
				}else if($no_urut < 100){
					$text_no = '00';
				}else if($no_urut < 1000){
					$text_no = '0';
				}else{
					$text_no = '';
				}

				$DLN = !empty($config['is_dilan']) ? 'DLN/' : '450/';
				$nomor = $DLN.$text_no.$no_urut.'/'.$data['desa_id'].'/'.date('d').'/'.date('Y');
				if($this->db->update('dilan_surat',['no_urut'=>$no_urut,'nomor'=>$nomor],['id'=>$last_id]))
				{
					header('location: '.base_url('dilan/cetak/'.$last_id));
				}
			}
		}
	}
}