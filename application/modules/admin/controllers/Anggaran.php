<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->esg_model->set_nav_title('Perencanaan Anggaran Tahun');
		$this->load->view('index');
	}
	public function edit()
	{
		$this->esg_model->set_nav_title('Perencanaan Anggaran Tahun');
		$this->load->view('index');
	}
	public function clear_list($type = '')
	{
		$this->load->view('anggaran/index',['type'=>$type]);
	}
	public function fisik()
	{
		$this->load->view('index',['type'=>'fisik']);
	}
	public function non_fisik()
	{
		$this->load->view('index',['type'=>'non_fisik']);
	}
}