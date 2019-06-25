<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
	}
	public function index()
	{
		$data = $this->db->query("SELECT * FROM potensi_desa where doc != '' ORDER BY id DESC LIMIT 12")->result_array();
		foreach ($data as $key => $value) 
		{
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa'] = $desa;
		}
		output_json($data);
	}
}