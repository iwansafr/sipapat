<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function detail($id = 0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title('Detail Perangkat Desa');
		$this->load->view('index', ['id'=>$id,'jabatan'=>$jabatan,'pengguna'=>$pengguna]);
	}

	public function list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function clear_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('perangkat/index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function bpd($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' BPD ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function lpmp($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' LPMP ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function pkk($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' PKK ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function karang_taruna($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' karang_taruna ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function rt($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' rt ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function rw($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' rw ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
}