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
		$field = @$_GET['field'];
		if(!empty($field))
		{
			$field = explode('-',$field);
			foreach ($field as $key => $value) 
			{
				if($value != 'page')
				{
					$this->db->select($value);
				}
			}
		}
		$data = $this->db->get('desa')->result_array();
		output_json($data);
	}

	public function tanpa_perangkat()
	{
		output_json($this->desa_model->tanpa_perangkat());
	}
	public function tanpa_potensi()
	{
		output_json($this->desa_model->tanpa_potensi());
	}
	public function detail($id = 0)
	{
		output_json($this->desa_model->detail($id));
	}
}