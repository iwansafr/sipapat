<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Villages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list($id = 0)
	{
		$this->load->view('index',['district_id'=>@intval($id)]);
	}
	public function clear_list($id = 0)
	{
		$this->load->view('villages/list',['district_id'=>@intval($id)]);
	}
	public function all()
	{
		$data = $this->db->get('villages')->result_array();
		$output = [];
		foreach ($data as $key => $value) 
		{
			$output[$value['district_id']][] = $value;
		}
		output_json($output);
	}
	public function by_district_id($district_id = 0)
	{
		$output = [];
		if(!empty($district_id))
		{
			$this->db->where(['district_id'=>$district_id]);
			$data = $this->db->get('villages')->result_array();
			$output = [];
			foreach ($data as $key => $value) 
			{
				$output[$value['district_id']][] = $value;
			}
		}
		output_json($output);
	}
	public function by_regency_id($regency_id = 0)
	{
		$output = [];
		if(!empty($regency_id))
		{
			$this->db->select('villages.*,districts.id, regencies.name AS kabupaten, districts.name AS kecamatan');
			$this->db->join('districts','(villages.district_id=districts.id)');
			$this->db->join('regencies','districts.regency_id=regencies.id');
			$this->db->where(['regency_id'=>$regency_id]);
			$data = $this->db->get('villages')->result_array();
			$output = [];
			foreach ($data as $key => $value) 
			{
				$output[$value['district_id']][] = $value;
			}
		}
		output_json($output);
	}
}
