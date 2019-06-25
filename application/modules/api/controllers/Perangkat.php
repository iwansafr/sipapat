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
		foreach ($data as $key => $value) 
		{
			$jabatan = $this->sipapat_model->get_jabatan($value['kelompok'], $value['jabatan']);
			$data[$key]['foto'] = image_module('perangkat_desa',$value['id'].'/'.$value['foto']);
			$data[$key]['jabatan'] = $jabatan['jabatan'];
			$data[$key]['kelompok'] = $jabatan['kelompok'];
		}
		output_json($data);
	}
}