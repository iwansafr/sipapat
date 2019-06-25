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
		$data = $this->db->query("SELECT * FROM perangkat_desa where foto != '' AND jabatan = 1 AND kelompok = 1 ORDER BY id DESC LIMIT 12")->result_array();
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
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['foto'] = image_module('perangkat_desa',$value['id'].'/'.$value['foto']);
			$data[$key]['jabatan'] = $jabatan['jabatan'];
			$data[$key]['kelompok'] = $jabatan['kelompok'];
			$data[$key]['desa'] = $desa;
			$data[$key]['kelamin'] = $kelamin[$value['kelamin']];
			$data[$key]['agama'] = $agama[$value['agama']];
			$data[$key]['status_perkawinan'] = $status_perkawinan[$value['status_perkawinan']];
			$data[$key]['pendidikan_terakhir'] = $pendidikan_terakhir[$value['pendidikan_terakhir']];
		}
		output_json($data);
	}
}