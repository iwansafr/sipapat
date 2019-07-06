<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('desa_model');
	}

	public function index()
	{
		$data = $this->db->get('desa')->result_array();
		output_json($data);
	}

	public function tanpa_perangkat()
	{
		output_json($this->desa_model->tanpa_perangkat());
	}
}