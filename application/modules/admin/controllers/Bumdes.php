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
		$this->load->model('pembangunan_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	// public function detail()
	// {
	// 	$data             = $this->bumdes_model->get_bumdes(@intval($_GET['id']));
	// 	$alamat           = $this->bumdes_model->get_alamat($data['alamat']);
	// 	$pengurus         = $this->bumdes_model->get_alamat($data['pengurus']);
	// 	$pengawas         = $this->bumdes_model->get_alamat($data['pengawas']);
	// 	$data['alamat']   = $alamat;
	// 	$data['pengurus'] = $pengurus;
	// 	$data['pengawas'] = $pengawas;

	// 	$this->load->view('index',['data'=>$data,'kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	// }

	public function index()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna]);
	}

	public function edit()
	{
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function detail()
	{
		$id        = @intval($_GET['id']);
		$pengguna  = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$status    = true;
		$data      = [];
		$alamat    = '';

		if(is_desa())	
		{
			if($id!=$bumdes_id)
			{
				$status = false;
			}
		}
		if($status)
		{
			$data             = $this->bumdes_model->get_bumdes($id);
			$alamat           = $this->bumdes_model->get_alamat($data['alamat']);
			$data['alamat']   = $alamat;
		}
		$this->load->view('index',['id'=>$id,'status'=>$status,'data'=>$data]);
	}

	public function list()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function clear_list()
	{
		$this->load->view('bumdes/list',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}


	public function pengurus_edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function pengurus()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function pengurus_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('bumdes/pengurus',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}


	public function lembaga_edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function lembaga()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function lembaga_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('bumdes/lembaga',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function dana()
	{
		$this->load->view('index');
	}
	
	public function dana_kat()
	{
		$this->load->view('index');
	}
	public function clear_dana()
	{
		$this->load->view('bumdes/dana');
	}

	public function clear_dana_kat()
	{
		$this->load->view('bumdes/dana_kat');
	}

	public function usaha()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$usaha = $this->bumdes_model->get_usaha($bumdes_id);
		$this->load->view('index',['pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id,'usaha'=>$usaha]);
	}

	public function indikator_usaha()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$dana_kat = $this->bumdes_model->get_dana_kat();
		$this->load->view('index',['dana_kat'=>$dana_kat,'bumdes_id'=>$bumdes_id,'desa_id'=>$pengguna['desa_id'],'user_id'=>$pengguna['user_id']]);
	}

	public function simpan_pinjam()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$dana_kat = $this->bumdes_model->get_dana_kat();
		$this->load->view('index',['dana_kat'=>$dana_kat,'bumdes_id'=>$bumdes_id,'desa_id'=>$pengguna['desa_id'],'user_id'=>$pengguna['user_id']]);
	}

	public function bumdesma_mandiri_sejahtera()
	{
		$sumber = $this->pembangunan_model->sumber_dana();
		$id = @intval($_GET['id']);
		$pengguna = $this->pengguna_model->get_pengguna();
		$sumber_selected = @$_GET['sumber'];
		$bumdesma = [];
		if(!empty($id))
		{
			$bumdesma = $this->bumdes_model->get_bumdesma($id);
		}
		$this->load->view('index',['pengguna'=>$pengguna,'sumber'=>$sumber,'sumber_selected'=>$sumber_selected,'bumdesma'=>$bumdesma]);
	}

	public function clear_bumdesma_mandiri_sejahtera()
	{
		$sumber = $this->pembangunan_model->sumber_dana();
		$id = @intval($_GET['id']);
		$pengguna = $this->pengguna_model->get_pengguna();
		$sumber_selected = @$_GET['sumber'];
		$bumdesma = [];
		if(!empty($id))
		{
			$bumdesma = $this->bumdes_model->get_bumdesma($id);
		}
		$this->load->view('bumdes/bumdesma_mandiri_sejahtera',['pengguna'=>$pengguna,'sumber'=>$sumber,'sumber_selected'=>$sumber_selected,'bumdesma'=>$bumdesma]);
	}
}