<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pembangunan_model');
		$this->load->model('pengguna_model');
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function detail($id=0)
	{
		$pembangunan = $this->pembangunan_model->get_pembangunan($id);
		$sumber_dana = $this->pembangunan_model->sumber_dana();
		$bidang = $this->pembangunan_model->bidang();
		$desa = $this->sipapat_model->get_desa($pembangunan['desa_id']);
		$this->esg_model->set_nav_title('detail pembangunan '.$pembangunan['item']);
		$this->load->view('index',['data'=>$pembangunan,'desa'=>$desa,'sumber_dana'=>$sumber_dana,'bidang'=>$bidang]);
	}

	public function desa($type = '')
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
		$this->load->view('index', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa()]);
	}
	public function test()
	{
		
	}
	public function clear_desa($type = '')
	{
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;
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
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$this->load->view('pembangunan/desa', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa()]);
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function list($type = '')
	{
		$sumber    = $this->pembangunan_model->sumber_dana();
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;

		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = $this->input->get('desa_id');
		}
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
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'bidang_id'=>$bidang_id,'desa_id'=>$desa_id]);
	}
	public function clear_list($type = '')
	{
		$sumber    = $this->pembangunan_model->sumber_dana();
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = $this->input->get('desa_id');
		}
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
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$this->load->view('pembangunan/index',['view'=>$view,'sumber'=>$sumber,'bidang_id'=>$bidang_id,'bidang'=>$bidang,'desa_id'=>$desa_id]);
	}
	public function buat()
	{
		$this->esg_model->set_nav_title('buat laporan pembangunan');
		$this->load->view('index');
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