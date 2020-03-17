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
		$this->load->model('absensi_model');
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

	public function rekap($id = 0, $month = 0, $year = 0)
	{
		if($month!=10){
			$month = str_replace('0', '', $month);
			$month = $month <=10 ? '0'.$month : $month;
		}
		$this->esg_model->set_nav_title('Detail Absensi');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$data['perangkat'] = json_decode(file_get_contents(base_url('api/perangkat/get_by_id/'.$id)),1);
		}

		if(empty($month)){
			$data['data'] = [];
		}else{
			$data['data'] = $this->db->get_where('absensi', ['perangkat_desa_id'=>$id,'MONTH(created)'=> $month,'YEAR(created)'=>$year])->result_array();
		}
		$tmp_data = [];
		if(!empty($data['data']))
		{
			foreach ($data['data'] as $key => $value) 
			{
				$index = substr($value['created'],0,10);
				if(empty($tmp_data[$index]['jam_berangkat'])){
					$tmp_data[$index]['jam_berangkat'] = 'Kosong';
				}
				if(empty($tmp_data[$index]['jam_pulang'])){
					$tmp_data[$index]['jam_pulang'] = 'Kosong';
				}
				if(empty($value['valid'])){
					$tmp_data[$index]['valid'] = 'Kosong';
				}else{
					$tmp_data[$index]['valid'] = $value['valid'];
				}
				if($value['status'] == 1)
				{
					$tmp_data[$index]['jam_berangkat'] = substr($value['created'],11,16);
					$tmp_data[$index]['tgl'] = substr($value['created'],0,10);
				}else if($value['status'] == 2)
				{
					$tmp_data[$index]['jam_pulang'] = substr($value['created'],11,16);
					$tmp_data[$index]['tgl'] = substr($value['created'],0,10);
				}else{
					$tmp_data[$index]['izin'] = 1;
					$tmp_data[$index]['tgl'] = substr($value['created'],0,10);
					$tmp_data[$index]['jam_berangkat'] = 'Kosong';
					$tmp_data[$index]['jam_pulang'] = 'Kosong';
				}
				$tmp_data[$index]['status'] = $value['status'];
			}
		}
		$tgl = $this->absensi_model->tgl($year.'-'.$month.'-01');
		$output[] = [
			'tgl','status','jam_berangkat','jam_pulang','date_num','day_name','valid'
		];
		foreach ($tgl as $key => $value) 
		{
			if(!empty($tmp_data[$value['date']]))
			{
				$output[] =
				[
					'tgl' => $tmp_data[$value['date']]['tgl'],
					'status' => $tmp_data[$value['date']]['status'],
					'jam_berangkat' => $tmp_data[$value['date']]['jam_berangkat'],
					'jam_pulang' => $tmp_data[$value['date']]['jam_pulang'],
					'date_num' => $value['num'],
					'day_name' => $value['name'],
					'valid' => $tmp_data[$value['date']]['valid']
				];
			}else{
				$output[] =
				[
					'tgl' => $value['date'],
					'status' => 0,
					'jam_berangkat' => 'kosong',
					'jam_pulang' => 'kosong',
					'date_num' => $value['num'],
					'day_name' => $value['name'],
					'valid' => 'Kosong'
				];
			}
		}
		$this->load->view('index',['data'=>$output]);
	}

	public function tambah_izin($id=0)
	{
		$this->esg_model->set_nav_title('Tambah Izin');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$data['perangkat'] = json_decode(file_get_contents(base_url('api/perangkat/get_by_id/'.$id)),1);
		}
		$this->load->view('index', $data);
	}

}