<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/dilan_model');
	}
	
	public function index()
	{
		$this->load->view('index');
	}

	public function ajukan($desa_id = 0)
	{
		$custom_api = $this->esg->get_config(base_url().'_api')['url'];
		$desa_id = curl($custom_api.'/api/desa/is_exist/'.$desa_id);
		$desa_id = json_decode($desa_id,1);
		$data = [];
		$data['desa_id'] = $desa_id;
		$this->load->view('index',$data);
	}

	public function start()
	{
		$cookies = $_COOKIE;
		if(!empty($cookies['dilan_village_id']))
		{
			$custom_api = $this->esg->get_config(base_url().'_api')['url'];
			$desa_id = curl($custom_api.'/api/desa/detail_by_v_id/'.$cookies['dilan_village_id']);
			$desa_id = json_decode($desa_id,1);
			if(!empty($desa_id))
			{
				$desa_id = $desa_id['id'];
			}else{
				$desa_id = 0;
			}
			header('location: '.base_url('dilan/?id='.$desa_id));
		}
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		if(empty($sipapat_config))
		{
			$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		}else{
			$this->esg->add_js([base_url('assets/desa/script.js')]);
		}
		if(!empty($_POST))
		{
			$expired = time() + 60 * 60 * 24 * 30;
			$village_id = $_POST['village_id'];
			set_cookie('dilan_village_id',$village_id,$expired);
			set_cookie('dilan_device_token',$village_id.'_'.time(),$expired);
			header('location: '.base_url('dilan/start'));
		}
		$this->load->view('index');
	}

	public function config()
	{
		$this->load->view('index');
	}
	public function search($id = 0)
	{
		$nik = @intval($_GET['nik']);
		$data = [];
		if(!empty($nik))
		{
			$data['penduduk'] = $this->dilan_model->get_penduduk_by_nik($nik,$id);
		}
		$data['desa_id'] = $id;
		$this->load->view('index',$data);
	}
	public function suket($nik = 0)
	{
		$data = [];
		if(!empty($nik))
		{
			$data['surat_group'] = $this->dilan_model->surat_group();
			$data['nik'] = $nik;
		}
		$this->load->view('index',$data);
	}

	public function surat_pengantar_form($nik = 0, $ket_id = 0)
	{
		$data = 0;
		if(!empty($nik) && !empty($ket_id))
		{
			$penduduk = $this->dilan_model->get_penduduk_by_nik($nik);
			$pekerjaan = $this->dilan_model->pekerjaan();
			$desa = $this->sipapat_model->get_desa($penduduk['desa_id']);
			$kabupaten = $this->esg->get_config('sipapat_config');
			$keterangan = [];
			if(!empty($ket_id))
			{
				$keterangan = $this->dilan_model->get_keterangan($ket_id);
				if(!empty($keterangan))
				{
					$keterangan = $keterangan[$ket_id];
				}
				if(!empty($keterangan['keterangan']))
				{
					$keterangan['keterangan'] = str_replace('{desa}', @ucfirst(strtolower($desa['nama'])), $keterangan['keterangan']);
					$keterangan['keterangan'] = str_replace('{kecamatan}', @ucfirst(strtolower($desa['kecamatan'])), $keterangan['keterangan']);
					$keterangan['keterangan'] = str_replace('{kabupaten}', @ucfirst(strtolower($kabupaten['kabupaten'])), $keterangan['keterangan']);
				}

			}
			$this->load->view('index',['penduduk' => $penduduk,'desa'=>$desa,'keterangan'=>$keterangan,'pekerjaan'=>$pekerjaan,'kelamin'=>$this->dilan_model->kelamin()]);
			$this->dilan_model->save_surat_pengajuan();
		}
	}
	public function edit_pekerjaan($nik = 0)
	{
		$penduduk = $this->db->get_where('penduduk',['nik'=>$nik])->row_array();
		$this->load->view('index',compact('penduduk'));
	}
	public function cetak($id = 0)
	{
		$data = [];
		$data['id'] = $id;
		$this->load->view('index',$data);
	}
}