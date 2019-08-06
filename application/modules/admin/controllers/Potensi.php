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
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
		$bulan = array_start_one($bulan);
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu,'bulan'=>$bulan]);
	}
	public function desa()
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index',['desa_option'=>$this->pengguna_model->get_desa($kec)]);
	}
	public function kecamatan()
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan()]);
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
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}

	public function clear_bidang($item = 0)
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$items =
		[
			'perikanan',
			'pertanian',
			'peternakan',
			'perkebunan',
			'home_industri',
			'perdagangan',
			'wisata',
			'jasa',
			'seni_budaya',
		];
		$items = array_start_one($items);
		$this->load->view("potensi/".$items[$item],["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>1]);
	}

	public function perikanan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>1]);
	}
	public function pertanian() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>2]);
	}
	public function peternakan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>3]);
	}
	public function perkebunan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>4]);
	}
	public function home_industri() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>5]);
	}
	public function perdagangan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>6]);
	}
	public function wisata() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>7]);
	}
	public function jasa() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>8]);
	}
	public function seni_budaya() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>9]);
	}

	public function detail()
	{
		$id = @intval($_GET['id']);
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$data = $this->potensi_model->get_potensi($id);
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','septemper','oktober','november','desember'];
		$bulan = array_start_one($bulan);
		$this->load->view('index', ['data'=>$data,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu,'bulan'=>$bulan]);
	}
}