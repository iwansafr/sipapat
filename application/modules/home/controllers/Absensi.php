<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('absensi_model');
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
	}
	public function index()
	{
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		$this->home_model->home();
		$data = [];
		$get = $this->input->get();
		$this->load->view('index');
	}

	public function masuk($desa_id = 0)
	{
		if(!empty($this->input->post()))
		{
			$data = $this->input->post();
			$data['desa_id'] = $desa_id; 
			$data['status'] = $this->absensi_model->upload($data);
		}
		$this->load->model('admin/pengguna_model');
		$this->home_model->home();
		$data['jabatan'] = $this->pengguna_model->jabatan()[1];
		$data['perangkat'] = file_get_contents(base_url('api/perangkat/get_by_desa/'.$desa_id.'/1'));
		if(!empty($data['perangkat'])){
			$data['perangkat'] = json_decode($data['perangkat'],1);
		}
		$this->load->view('index', $data);
	}
}