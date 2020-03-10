<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/pengguna_model');
		$this->load->model('admin/sipapat_model');
	}
	public function index()
	{
		$desa_id = @intval($_GET['d_id']);
		$page = @intval($_GET['page']);
		$page = (@intval($page) > 0 ) ? $page-1 : $page;
		$limit = 12;
		$limit = $limit*$page.','.$limit;
		$where = '';
		if(!empty($desa_id))
		{
			$where = ' AND desa_id = ? ';
		}else{
			$desa_id = '';
		}

		$data = $this->db->query("SELECT * FROM perangkat_desa where foto != '' AND jabatan = 1 AND kelompok = 1 $where ORDER BY RAND() LIMIT $limit ", $desa_id)->result_array();

		$desa_ids = [];
		foreach ($data as $key => $value) 
		{
			foreach($value AS $vkey => $vvalue)
			{
				if($vkey=='desa_id')
				{
					$desa_ids[] = $value['desa_id'];
				}
			}
		}
		$desa_ids = array_unique($desa_ids);
		$kelamin = ['Perempuan','Laki-laki'];
		$agama = 
			[
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
		$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		$pendidikan_terakhir = 
			[
				'1'=>strtoupper('akademi/diploma iii/s.muda'),
				'2'=>strtoupper('belum tamat sd/sederajat'),
				'3'=>strtoupper('diploma i/ii'),
				'4'=>strtoupper('diploma iv/strata i'),
				'5'=>strtoupper('slta/sederajat'),
				'6'=>strtoupper('sltp/sederajat'),
				'7'=>strtoupper('strata ii'),
				'8'=>strtoupper('strata iii'),
				'9'=>strtoupper('tamat sd/sederajat'),
				'10'=>strtoupper('tidak/belum sekolah')
			];

		if(!empty($desa_ids))
		{

		}
		$this->db->where_in('id', $desa_ids);
		$desa_tmp = $this->db->get('desa')->result_array();
		$desa = [];
		foreach ($desa_tmp as $key => $value) 
		{
			$desa[$value['id']] = $value;
		}
		foreach ($data as $key => $value) 
		{
			$jabatan = $this->sipapat_model->get_jabatan($value['kelompok'], $value['jabatan']);
			$data[$key]['foto'] = image_module('perangkat_desa',$value['id'].'/'.$value['foto']);
			$data[$key]['jabatan'] = $jabatan['jabatan'];
			$data[$key]['kelompok'] = $jabatan['kelompok'];
			$data[$key]['desa'] = $desa[$value['desa_id']];
			$data[$key]['kelamin'] = $kelamin[$value['kelamin']];
			$data[$key]['agama'] = $agama[$value['agama']];
			$data[$key]['status_perkawinan'] = $status_perkawinan[$value['status_perkawinan']];
			$data[$key]['pendidikan_terakhir'] = $pendidikan_terakhir[$value['pendidikan_terakhir']];
		}
		output_json($data);
	}

	public function kep_des()
	{
		$data = [];

		$sipapat_config = $this->esg->get_esg('sipapat_config');
		$page = !empty($_GET['page']) ? @intval($_GET['page']) : '';


		// if(!empty($page))
		// {
		// 	$page = (@intval($_GET['page']) > 0 ) ? $_GET['page']-1 : @intval($_GET['page']);
		// 	$limit = 12;
		// 	$page = $page*$limit;
		// 	$this->db->limit($limit,$page);
		// }

		$this->db->select('perangkat_desa.id, perangkat_desa.nama, perangkat_desa.kelamin, desa.nama AS desa, desa.kecamatan AS kecamatan');
		$this->db->order_by('RAND()');
		$this->db->where(['kelompok'=>1]);
		$this->db->where(['jabatan'=>1]);
		if(!empty($sipapat_config['regency_id']))
		{
			$this->db->where(['regency_id'=>$sipapat_config['regency_id']]);
		}
		$this->db->join('desa','desa.id=perangkat_desa.desa_id');
		$data = $this->db->get('perangkat_desa')->result_array();
		// $data['query'] = $this->db->last_query();

		$kelamin = ['Perempuan','Laki-laki'];
		// $agama = $this->pengguna_model->agama();
		// $status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		// $pendidikan_terakhir = 
		// 	[
		// 		'1'=>strtoupper('akademi/diploma iii/s.muda'),
		// 		'2'=>strtoupper('belum tamat sd/sederajat'),
		// 		'3'=>strtoupper('diploma i/ii'),
		// 		'4'=>strtoupper('diploma iv/strata i'),
		// 		'5'=>strtoupper('slta/sederajat'),
		// 		'6'=>strtoupper('sltp/sederajat'),
		// 		'7'=>strtoupper('strata ii'),
		// 		'8'=>strtoupper('strata iii'),
		// 		'9'=>strtoupper('tamat sd/sederajat'),
		// 		'10'=>strtoupper('tidak/belum sekolah')
		// 	];

		foreach ($data as $key => $value) 
		{
			// $jabatan = $this->sipapat_model->get_jabatan($value['kelompok'], $value['jabatan']);
			// $data[$key]['foto'] = image_module('perangkat_desa',$value['id'].'/'.$value['foto']);
			// $data[$key]['jabatan'] = $jabatan['jabatan'];
			// $data[$key]['kelompok'] = $jabatan['kelompok'];
			$data[$key]['kelamin'] = $kelamin[$value['kelamin']];
			// $data[$key]['agama'] = $agama[$value['agama']];
			// $data[$key]['status_perkawinan'] = $status_perkawinan[$value['status_perkawinan']];
			// $data[$key]['pendidikan_terakhir'] = $pendidikan_terakhir[$value['pendidikan_terakhir']];
		}

		output_json($data);

	}

	public function kep_des_detail()
	{
		$data = [];

		$id = @intval($_GET['id']);

		$this->db->select('perangkat_desa.*, desa.nama AS desa, desa.kecamatan AS kecamatan');
		$this->db->order_by('nama','asc');
		$this->db->where(['kelompok'=>1]);
		$this->db->where(['jabatan'=>1]);
		$this->db->where(['perangkat_desa.id'=>$id]);
		$this->db->join('desa','desa.id=perangkat_desa.desa_id');
		$data = $this->db->get('perangkat_desa')->row_array();
		// $data['query'] = $this->db->last_query();

		if(!empty($data))
		{
			$kelamin = ['Perempuan','Laki-laki'];
			$agama = $this->pengguna_model->agama();
			$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
			$pendidikan_terakhir = 
				[
					'1'=>strtoupper('akademi/diploma iii/s.muda'),
					'2'=>strtoupper('belum tamat sd/sederajat'),
					'3'=>strtoupper('diploma i/ii'),
					'4'=>strtoupper('diploma iv/strata i'),
					'5'=>strtoupper('slta/sederajat'),
					'6'=>strtoupper('sltp/sederajat'),
					'7'=>strtoupper('strata ii'),
					'8'=>strtoupper('strata iii'),
					'9'=>strtoupper('tamat sd/sederajat'),
					'10'=>strtoupper('tidak/belum sekolah')
				];

			$jabatan = $this->sipapat_model->get_jabatan($data['kelompok'], $data['jabatan']);
			$data['foto'] = image_module('perangkat_desa',$data['id'].'/'.$data['foto']);
			$data['jabatan'] = $jabatan['jabatan'];
			$data['kelompok'] = $jabatan['kelompok'];
			$data['kelamin'] = $kelamin[$data['kelamin']];
			$data['agama'] = $agama[$data['agama']];
			$data['status_perkawinan'] = $status_perkawinan[$data['status_perkawinan']];
			$data['pendidikan_terakhir'] = $pendidikan_terakhir[$data['pendidikan_terakhir']];
		}

		output_json($data);

	}	

	public function all()
	{
		$desa_id = @intval($_GET['d_id']);
		$full = @intval($_GET['full']);
		$kelompok = @intval($_GET['kelompok']);
		$jabatan = @intval($_GET['jabatan']);
		$page = @intval($_GET['page']);
		$page = (@intval($page) > 0 ) ? $page-1 : $page;
		$limit = 12;
		$limit = 'LIMIT '.$limit*$page.','.$limit;
		$where = '';
		if(!empty($desa_id))
		{
			$where = ' WHERE desa_id = ? ';
			if(!empty($full))
			{
				$limit = '';
			}
			if(!empty($kelompok))
			{
				$where .= ' AND kelompok = '.$kelompok;
				if(!empty($jabatan))
				{
					$where .= ' AND jabatan = '.$jabatan;
				}
			}
		}else{
			$desa_id = '';
		}

		$data = $this->db->query("SELECT * FROM perangkat_desa $where ORDER BY id DESC $limit", $desa_id)->result_array();
		$data_tmp = [];

		$kelamin = ['Perempuan','Laki-laki'];
		$agama = 
			[
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
		$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		$pendidikan_terakhir = 
			[
				'1'=>strtoupper('akademi/diploma iii/s.muda'),
				'2'=>strtoupper('belum tamat sd/sederajat'),
				'3'=>strtoupper('diploma i/ii'),
				'4'=>strtoupper('diploma iv/strata i'),
				'5'=>strtoupper('slta/sederajat'),
				'6'=>strtoupper('sltp/sederajat'),
				'7'=>strtoupper('strata ii'),
				'8'=>strtoupper('strata iii'),
				'9'=>strtoupper('tamat sd/sederajat'),
				'10'=>strtoupper('tidak/belum sekolah')
			];


		foreach ($data as $key => $value) 
		{
			$jabatan = $this->sipapat_model->get_jabatan($value['kelompok'], $value['jabatan']);
			$data_tmp[$key] = $value;
			$data_tmp[$key]['foto'] = image_module('perangkat_desa',$value['id'].'/'.$value['foto']);
			$data_tmp[$key]['jabatan_kode'] = $value['jabatan'];
			$data_tmp[$key]['jabatan'] = $jabatan['jabatan'];
			$data_tmp[$key]['kelompok_kode'] = $value['kelompok'];
			$data_tmp[$key]['kelompok'] = $jabatan['kelompok'];
			$data_tmp[$key]['kelamin_kode'] = $value['kelamin'];
			$data_tmp[$key]['kelamin'] = $kelamin[$value['kelamin']];
			$data_tmp[$key]['agama_kode'] = $value['agama'];
			$data_tmp[$key]['agama'] = $agama[$value['agama']];
			$data_tmp[$key]['status_perkawinan_kode'] = $value['status_perkawinan'];
			$data_tmp[$key]['status_perkawinan'] = $status_perkawinan[$value['status_perkawinan']];
			$data_tmp[$key]['pendidikan_terakhir_kode'] = $value['pendidikan_terakhir'];
			$data_tmp[$key]['pendidikan_terakhir'] = $pendidikan_terakhir[$value['pendidikan_terakhir']];
			// $data_tmp[$value['kelompok']][] = $value;
		}
		$data = $data_tmp;
		$data_tmp = [];
		foreach ($data as $key => $value) 
		{
			$data_tmp[$value['jabatan_kode']][] = $value;
		}
		$data = $data_tmp;
		output_json($data);
	}

	public function get_by_desa($desa_id = 0, $kelompok = 0)
	{
		if(!empty($desa_id))
		{
			$where = '';
			if(!empty($kelompok)){
				$where = ' AND kelompok = '.$kelompok;
			}
			$data = $this->db->query('SELECT * FROM perangkat_desa WHERE desa_id = ?'.$where.' ORDER BY jabatan ASC', $desa_id)->result_array();
			output_json($data);
		}
	}

	public function get_absensi_pagi($desa_id = 0, $kelompok = 0)
	{
		$where = '';
		if(!empty($kelompok)){
			$where = ' AND kelompok = '.$kelompok;
		}
		$data = $this->db->query("SELECT perangkat_desa.id,perangkat_desa.nama FROM perangkat_desa INNER JOIN absensi ON(perangkat_desa.id=absensi.perangkat_desa_id) WHERE absensi.desa_id = ? AND CAST(absensi.created AS DATE) = '".date('Y-m-d')."' AND status = 1 ".$where." ORDER BY perangkat_desa.jabatan ASC", $desa_id)->result_array();
		output_json($data);
	}

	public function get_absensi_sore($desa_id = 0, $kelompok = 0)
	{
		$where = '';
		if(!empty($kelompok)){
			$where = ' AND kelompok = '.$kelompok;
		}
		$data = $this->db->query("SELECT perangkat_desa.id,perangkat_desa.nama FROM perangkat_desa INNER JOIN absensi ON(perangkat_desa.id=absensi.perangkat_desa_id) WHERE absensi.desa_id = ? AND CAST(absensi.created AS DATE) = '".date('Y-m-d')."' AND status = 2".$where." ORDER BY perangkat_desa.jabatan ASC", $desa_id)->result_array();
		output_json($data);
	}

	public function get_absensi_izin($desa_id = 0, $kelompok = 0)
	{
		$where = '';
		if(!empty($kelompok)){
			$where = ' AND kelompok = '.$kelompok;
		}
		$data = $this->db->query("SELECT perangkat_desa.id,perangkat_desa.nama FROM perangkat_desa INNER JOIN absensi ON(perangkat_desa.id=absensi.perangkat_desa_id) WHERE absensi.desa_id = ? AND CAST(absensi.created AS DATE) = '".date('Y-m-d')."' AND status = 3".$where." ORDER BY perangkat_desa.jabatan ASC", $desa_id)->result_array();
		output_json($data);
	}
}