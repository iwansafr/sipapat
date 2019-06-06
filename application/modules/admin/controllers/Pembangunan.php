<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pembangunan_model');
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function detail($id=0)
	{
		$this->esg_model->set_nav_title('detail');
		$this->load->view('index');
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function list($type = '')
	{
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		$sumber = $this->pembangunan_model->sumber_dana();
		$bidang = $this->pembangunan_model->bidang();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'desa_id'=>$desa_id]);
	}
	public function edit($type = '')
	{
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}

		$sumber = $this->pembangunan_model->sumber_dana();
		$bidang = $this->pembangunan_model->bidang();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'desa_id'=>$desa_id]);
	}
}