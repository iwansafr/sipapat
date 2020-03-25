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
		$custom_api = $this->esg->get_config(base_url().'_api')['url'];
		$data['perangkat'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_by_desa/'.$desa_id.'/1'),1);
		$data['perangkat_pagi'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_pagi/'.$desa_id.'/1'),1);
		$data['perangkat_sore'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_sore/'.$desa_id.'/1'),1);
		$data['perangkat_izin'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_absensi_izin/'.$desa_id.'/1'),1);
		$data['desa'] = json_decode(file_get_contents($custom_api.'api/desa/detail/'.$desa_id),1);
		$h = date('h');
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
	  if(!empty($status))
	  {
	  	if($status == 1 || $status == 4)
	  	{
	  		if(!empty($data['perangkat_pagi']))
	  		{
	  			$perangkat_tmp = [];
	  			foreach ($data['perangkat'] as $key => $value)
					{
						foreach ($data['perangkat_pagi'] as $pgkey => $pgvalue) 
						{
							if($pgvalue['id'] != $value['id']){
								$perangkat_tmp[$key] = $value;
							}
						}
					}
	  		}
	  	}
	  	if($status == 3)
	  	{
	  		if(!empty($data['perangkat_pagi']))
	  		{
	  			$perangkat_tmp = [];
	  			foreach ($data['perangkat'] as $key => $value)
					{
						foreach ($data['perangkat_sore'] as $pgkey => $pgvalue) 
						{
							if($pgvalue['id'] != $value['id']){
								$perangkat_tmp[$key] = $value;
							}
						}
					}
	  		}
	  	}
	  }

	  if(!empty($perangkat_tmp))
	  {
	  	$data['perangkat'] = $perangkat_tmp;
	  }
		if(!empty($this->input->post()))
		{
			$upload = $this->input->post();
			$success = 1;
			if($upload['status'] == 1 || $upload['status'] == 4)
			{
				if(!empty($data['perangkat_pagi']))
				{
					foreach ($data['perangkat_pagi'] as $key => $value)
					{
						if($value['id'] == $upload['perangkat_desa_id']){
							$success = 0;
						}
					}
				}
			}else if($upload['status'] == 2){
				if(!empty($data['perangkat_sore']))
				{
					foreach ($data['perangkat_sore'] as $key => $value)
					{
						if($value['id'] == $upload['perangkat_desa_id']){
							$success = 0;
						}
					}
				}
			}else{
				if(!empty($data['perangkat_izin']))
				{
					foreach ($data['perangkat_izin'] as $key => $value)
					{
						if($value['id'] == $upload['perangkat_desa_id']){
							$success = 0;
						}
					}
				}
			}
			$upload['desa_id'] = $desa_id;
			if($success){
				$data['status'] = $this->absensi_model->upload($upload);
			}else{
				$data['status'] = ['status'=>'danger','msg'=>'Maaf Anda Sudah Melakukan Absen Sebelumnya'];
			}
		}
		$this->load->model('admin/pengguna_model');
		$this->home_model->home();
		$data['jabatan'] = $this->pengguna_model->jabatan()[1];
		$this->esg->add_js(base_url('assets/absensi/script.js'));
		$this->load->view('index', $data);
	}
}