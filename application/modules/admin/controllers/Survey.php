<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('survey_model');
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
	}
	public function clear_list($type = '')
	{
		$this->load->view('survey/index',['type'=>$type]);
	}
	public function isi()
	{
		$name = @($_GET['name']);
		$form = $this->survey_model->get_survey($name);

		$this->load->view('index');
	}
}