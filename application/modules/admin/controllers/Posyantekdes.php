<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posyantekdes extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->model('posyantekdes_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}
	public function clear_list(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('posyantekdes/index',['pengguna'=>$pengguna]);
	}
	public function edit(){
		$this->esg->add_js(base_url('assets/posyantekdes/script.js'));
		$pengguna = $this->pengguna_model->get_pengguna();
		$data = ['id'=>@intval($_GET['id']),'pengguna'=>$pengguna];
		$this->load->view('index', $data);
	}

	public function detail(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$data = ['id'=>@intval($_GET['id']),'pengguna'=>$pengguna];
		$this->load->view('index', $data);
	}
}