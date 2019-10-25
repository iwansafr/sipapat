<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/bumdes_model');
	}
	public function index()
	{
		$this->db->limit('12');
		$data = $this->db->get_where('bumdes',"no_perdes != '' AND no_perkades != ''")->result_array();
		foreach ($data as $key => $value) 
		{
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa'] = $desa;
		}
		output_json($data);
	}
}