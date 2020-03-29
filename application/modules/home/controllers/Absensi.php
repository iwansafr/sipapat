<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('absensi_model');
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
	}
	public function index()
	{
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		$this->home_model->home();
		$data = [];
		$get = $this->input->get();
		$this->load->view('index');
	}

	public function masuk($desa_id = 0)
	{
		$h = date('H');
		if($h<8 && $h>=6){
  		$status = 1;
  		//berangkat
	  }else if($h>=8 && $h<14){
  		$status = 4;
  		//terlambat
	  }else if($h<16 && $h>=14){
  		$status = 3;
  		//pulang
	  }else if($h==16 && $m==0){
  		$status = 3;
  		//pulang
	  }else{
  		$status = 0;
  		//off
	  }
		if(!empty($this->input->post()))
		{
			$upload = $this->input->post();
			$success = 1;
			$upload['desa_id'] = $desa_id;
			$data['status'] = $this->absensi_model->upload($upload);
		}
		$custom_api = $this->esg->get_config(base_url().'_api')['url'];
		$data['perangkat'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_by_desa/'.$desa_id.'/1'),1);
		$data['perangkat_pagi'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_pagi/'.$desa_id.'/1'),1);
		$data['perangkat_sore'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_sore/'.$desa_id.'/1'),1);
		$data['perangkat_izin'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_izin/'.$desa_id.'/1'),1);
		$data['desa'] = json_decode(file_get_contents($custom_api.'api/desa/detail/'.$desa_id),1);
		$data['sudah'] = [];		
	  if(!empty($status))
	  {
	  	if($status == 1 || $status == 4)
	  	{
	  		if(!empty($data['perangkat_pagi']))
	  		{
	  		// 	$perangkat_tmp = $data['perangkat'];
	  		// 	foreach ($data['perangkat'] as $key => $value)
					// {
					// 	foreach ($data['perangkat_pagi'] as $pgkey => $pgvalue) 
					// 	{
					// 		if($pgvalue['id'] == $value['id']){
					// 			unset($perangkat_tmp[$key]);
					// 		}
					// 	}
					// }
					$data['sudah'] = $data['perangkat_pagi'];
	  		}
	  	}
	  	if($status == 3)
	  	{
	  		if(!empty($data['perangkat_sore']))
	  		{
	  		// 	$perangkat_tmp = $data['perangkat'];
	  		// 	foreach ($data['perangkat'] as $key => $value)
					// {
					// 	foreach ($data['perangkat_sore'] as $pgkey => $pgvalue) 
					// 	{
					// 		if($pgvalue['id'] == $value['id']){
					// 			unset($perangkat_tmp[$key]);
					// 		}
					// 	}
					// }
					$data['sudah'] = $data['perangkat_sore'];
	  		}
	  	}
		  if(!empty($perangkat_tmp))
		  {
		  	$data['perangkat'] = $perangkat_tmp;
		  }
	  }
	  if(!empty($data['sudah']))
	  {
	  	$data_tmp_sudah = [];
	  	foreach ($data['sudah'] as $key => $value) 
	  	{
	  		$data_tmp_sudah[$value['id']] = $value;
	  	}
	  	$data['sudah'] = $data_tmp_sudah;
	  }
		$this->load->model('admin/pengguna_model');
		$this->home_model->home();
		$data['jabatan'] = $this->pengguna_model->jabatan()[1];
		$this->esg->add_js(base_url('assets/absensi/script.js'));
		$this->load->view('index', $data);
	}
}