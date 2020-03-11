<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function list()
	{
		$this->load->view('index');
	}
	public function clear_list()
	{
		$this->load->view('absensi/list');
	}
	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Absensi');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$data['perangkat'] = json_decode(file_get_contents(base_url('api/perangkat/get_by_id/'.$id)),1);
		}
		$this->load->view('index', $data);
	}
	public function clear_detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Absensi');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$data['perangkat'] = json_decode(file_get_contents(base_url('api/perangkat/get_by_id/'.$id)),1);
		}
		$this->load->view('absensi/detail',$data);
	}

	public function rekap($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Absensi');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$data['perangkat'] = json_decode(file_get_contents(base_url('api/perangkat/get_by_id/'.$id)),1);
		}

		$data['data'] = $this->db->get_where('absensi', ['perangkat_desa_id'=>$id])->result_array();
		$tmp_data = [];
		if(!empty($data['data']))
		{
			foreach ($data['data'] as $key => $value) 
			{
				$index = substr($value['created'],0,10);
				$tmp_data[$index]['foto'] = $value['foto'];
				if($value['status'] == 1)
				{
					$tmp_data[$index]['berangkat'] = $value['created'];
				}else if($value['status'] == 2)
				{
					$tmp_data[$index]['pulang'] = $value['created'];
				}else{
					$tmp_data[$index]['izin'] = 1;
				}
			}
		}
		pr($tmp_data);
		pr($data['data']);die();
	}
}