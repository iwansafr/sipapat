<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->model('sipapat_model');
		$this->load->model('potensi_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function edit()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}
	public function desa()
	{
		$this->load->view('index',['desa_option'=>$this->pengguna_model->get_desa()]);
	}
	public function list()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}
	public function clear_list()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('potensi/list',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}
	public function index()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);$this->load->view('index');
	}
	public function detail()
	{
		$id = @intval($_GET['id']);
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$data = $this->potensi_model->get_potensi($id);
		$this->load->view('index', ['data'=>$data,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}
}