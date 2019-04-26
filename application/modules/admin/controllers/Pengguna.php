<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
		$this->load->view('index');
	}

	public function edit()
	{
		$this->load->view('index');
		$this->pengguna_model->save();
	}

	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Pengguna');

		$this->load->view('index', ['id'=>$id]);
	}

	public function list()
	{
		$this->pengguna_model->delete();
		$this->load->view('index');
	}

	public function clear_list()
	{
		$this->load->view('pengguna/list');
	}
}