<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('bumdes_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function edit()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function list()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function clear_list()
	{
		$this->load->view('bumdes/list',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}
}