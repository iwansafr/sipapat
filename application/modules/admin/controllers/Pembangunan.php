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
		$this->esg_model->set_nav_title('detail pembangunan '.$pembangunan['item']);
		$this->load->view('index',['data'=>$pembangunan]);
	}

	public function desa($view = 'fisik')
	{
		switch ($view) {
			case 'fisik':
				$view = $view;
				break;
			case 'non-fisik';
				$view = $view;
			default:
				$view = 'fisik';
				break;
		}
		$this->load->view('index', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa()]);
	}
	public function test()
	{
		$desa = $this->db->query('SELECT id,nama FROM desa')->result_array();
		echo json_encode($desa);
		$user = $this->db->query('SELECT id,username FROM user')->result_array();
		echo json_encode($user);
	}
	public function clear_desa($view = 'fisik')
	{
		switch ($view) {
			case 'fisik':
				$view = $view;
				break;
			case 'non-fisik';
				$view = $view;
			default:
				$view = 'fisik';
				break;
		}
		$this->load->view('pembangunan/desa', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa()]);
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
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = @intval($_GET['desa_id']);
		}
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'desa_id'=>$desa_id]);
	}
	public function clear_list($type = '')
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
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = $this->input->get('desa_id');
		}
		$this->load->view('pembangunan/index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'desa_id'=>$desa_id]);
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