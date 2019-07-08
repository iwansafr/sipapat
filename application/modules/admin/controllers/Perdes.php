<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perdes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('perdes_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function kecamatan()
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}
	public function index()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id]);
	}
	public function edit()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id]);
	}
	public function clear_list()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$this->load->view('perdes/index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id]);
	}
}