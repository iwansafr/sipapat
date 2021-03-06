<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sipapatconfig extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('restore_model');
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function api()
	{
		$this->load->view('index');
	}

	public function custom_api()
	{
		$this->load->view('index');
	}

	public function nomor_surat()
	{
		$this->load->view('index');
	}

	public function logo()
	{
		$this->load->view('index');
	}
	public function site()
	{
		$this->load->view('index');
	}
	public function kabupaten()
	{
		$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		$this->load->view('index');
	}

	public function kabupaten_api()
	{
		$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		$this->load->view('index');
	}

	public function config_kab()
	{
		$config = $this->esg->get_config(base_url());
		output_json($config);
	}

	public function absensi()
	{
		$this->load->view('index');
	}
	public function dashboard()
	{
		$this->load->view('index');
	}

}