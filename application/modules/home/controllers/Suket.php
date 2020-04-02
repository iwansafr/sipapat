<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suket extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('suket_model');
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
	}
	public function index()
	{
		// $sipapat_config = $this->esg->get_esg('sipapat_config');
		// if(empty($sipapat_config))
		// {
		// 	$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		// }else{
		// 	$this->esg->add_js([base_url('assets/desa/script.js')]);
		// }
		$this->home_model->home();
		$data = [];
		$get = $this->input->get();
		if(!empty($get['village_id']) && !empty($get['nik']))
		{
			$data = $this->suket_model->cari_penduduk(@intval($get['nik']),@intval($get['village_id']));
			if(!empty($data))
			{
				$this->load->model('admin/sipapat_model');
				$this->load->model('admin/dilan_model');
				$data['keterangan'] = $this->dilan_model->get_keterangan();
				$data['data_pekerjaan'] = $this->dilan_model->pekerjaan();
			}
		}
		$this->load->view('index',['data'=>$data]);
	}

	public function ajukan()
	{
		$post = $this->input->post();
		$msg = ['status'=>'danger','msg'=>'Data Tidak Valid'];
		if(!empty($post))
		{
			if($this->suket_model->ajukan($post))
			{
				$msg = ['status'=>'success','msg'=>'Terima Kasih Pengajuan Suket Anda akan segera diproses'];
			}else{
				$msg = ['status'=>'danger','msg'=>'Mohon Maaf Data anda tidak ditemukan, proses pengajuan Suket dibatalkan'];
			}
		}
		$this->load->view('index',$msg);
	}
}