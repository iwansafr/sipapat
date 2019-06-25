<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends CI_Controller
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
		$data = $this->db->query("SELECT * FROM pembangunan where doc != '' OR doc_0 != '' OR doc_40 != '' OR doc_50 != '' OR doc_80 != '' OR doc_100 != '' ORDER BY id DESC LIMIT 12")->result_array();
		foreach ($data as $key => $value) 
		{
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa'] = $desa;
		}
		output_json($data);
	}
}