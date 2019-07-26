<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->model('bumdes_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function detail()
	{
		$data             = $this->bumdes_model->get_bumdes(@intval($_GET['id']));
		$alamat           = $this->bumdes_model->get_alamat($data['alamat']);
		$pengurus         = $this->bumdes_model->get_alamat($data['pengurus']);
		$pengawas         = $this->bumdes_model->get_alamat($data['pengawas']);
		$data['alamat']   = $alamat;
		$data['pengurus'] = $pengurus;
		$data['pengawas'] = $pengawas;

		$this->load->view('index',['data'=>$data,'kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function index()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function edit()
	{
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
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