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

		$data = $this->db->query("SELECT * FROM perangkat_desa where foto != '' AND jabatan = 1 AND kelompok = 1 $where ORDER BY id DESC LIMIT $limit ", $desa_id)->result_array();
		pr($this->db->last_query());
		pr($data);die();
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
}