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
		$msg = [];
		$this->esg->add_js(base_url('assets/survey/script.js'));
		if(!empty($_POST))
		{
			if($this->survey_model->save())
			{
				$msg = ['status'=>'success','msg'=>'Survey Berhasil Dikirim'];
			}else{
				$msg = ['status'=>'danger','msg'=>'Survey Gagal Dikirim'];
			}
		}
		$data = $this->survey_model->get_survey();
		$this->load->view('index',['msg'=>$msg,'data'=>$data]);
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