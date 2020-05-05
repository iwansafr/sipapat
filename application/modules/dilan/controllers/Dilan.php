<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
		$this->load->model('admin/dilan_model');
	}
	
	public function index()
	{
		$this->load->view('index');
	}

	public function config()
	{
		$this->load->view('index');
	}
	public function search()
	{
		$nik = @intval($_GET['nik']);
		$data = [];
		if(!empty($nik))
		{
			$data['penduduk'] = $this->dilan_model->get_penduduk_by_nik($nik);

		}
		$this->load->view('index',$data);
	}
	public function suket($nik = 0)
	{
		$data = [];
		if(!empty($nik))
		{
			$data['surat_group'] = $this->dilan_model->surat_group();
		}
		$this->load->view('index',$data);
	}
}