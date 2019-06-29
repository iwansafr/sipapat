<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('survey_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function chart()
	{
		$data = $this->survey_model->get_chart();
		$this->load->view('index',['data'=>$data]);
	}
	public function kecamatan()
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan()]);
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
		$desa = $this->survey_model->getDesa();
		$this->esg_model->set_nav_title('survey');
		$this->load->view('index',['msg'=>$msg,'data'=>$data,'desa'=>$desa]);
	}
	public function clear_list()
	{
		$this->load->view('survey/index');
	}
	public function isi()
	{
		$name = @($_GET['name']);
		$form = $this->survey_model->get_survey($name);
		$this->load->view('index');
	}
}