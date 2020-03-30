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

	public function bolos_list()
	{
		$this->load->model('pengguna_model');
		$desa_id = @intval($_GET['desa']);
		$date = $this->input->get('tgl');
		$date = strtotime($date);
		$date = date('Y-m-d',$date);
		$jabatan = $this->pengguna_model->jabatan()[1];
		$tmp_data = $this->absensi_model->get_bolos_list($desa_id,$date);
		pr($tmp_data);die();
		$data['data'][] = [
			'id','nama','jabatan'
		];
		foreach ($tmp_data as $key => $value) {
			$value['jabatan'] = @$jabatan[$value['jabatan']];
			$data['data'][] = $value;
		}
		$this->load->view('index',$data);
	}
	
	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Absensi');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$custom_api = $this->esg->get_config(base_url().'_api')['url'];
			$data['perangkat'] = json_decode(curl($custom_api.'api/perangkat/get_by_id/'.$id),1);
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
			$custom_api = $this->esg->get_config(base_url().'_api')['url'];
			$data['perangkat'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_by_id/'.$id),1);
		}
		$this->load->view('absensi/detail',$data);
	}

	public function rekap($id = 0, $month = 0, $year = 0)
	{
		if(!empty($_GET['bl'])){
			$month = $_GET['bl'];
		}
		if(!empty($_GET['th'])){
			$year = $_GET['th'];
		}
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
			$custom_api = $this->esg->get_config(base_url().'_api')['url'];
			$data['perangkat'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_by_id/'.$id),1);
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
					$tmp_data[$index]['valid'] = 0;
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
			$tgl = $this->absensi_model->tgl($year.'-'.$month.'-01');
		}
		$output[] = [
			'tgl','hari','status','jam_berangkat','jam_pulang','valid'
		];
		$message_status = $this->absensi_model->status();
		$message_validation = $this->absensi_model->valid();
		if(!empty($tgl))
		{
			foreach ($tgl as $key => $value) 
			{
				if(!empty($tmp_data[$value['date']]))
				{
					$output[] =
					[
						'tgl' => $tmp_data[$value['date']]['tgl'],
						'day_name' => $value['name'],
						'status' => $message_status[$tmp_data[$value['date']]['status']],
						'jam_berangkat' => $tmp_data[$value['date']]['jam_berangkat'],
						'jam_pulang' => $tmp_data[$value['date']]['jam_pulang'],
						// 'date_num' => $value['num'],
						'valid' => $message_validation[$tmp_data[$value['date']]['valid']]
					];
				}else{
					$output[] =
					[
						'tgl' => $value['date'],
						'day_name' => $value['name'],
						'status' => $message_status[0],
						'jam_berangkat' => 'kosong',
						'jam_pulang' => 'kosong',
						// 'date_num' => $value['num'],
						'valid' => $message_validation[0]
					];
				}
			}
		}
		$this->load->view('index',['id'=>$id,'data'=>$output,'bulan'=>$this->absensi_model->bulan(),'month'=>$month,'year'=>$year]);
	}

	public function rekap_data($desa_id = 0,$month = 0,$year = 0)
	{
		$desa_id = !empty($desa_id) ? $desa_id : $this->sipapat_model->get_desa_id();
		if(!empty($_GET['desa_id'])){
			$desa_id = intval($_GET['desa_id']);
		}
		if(!empty($_GET['bl'])){
			$month = intval($_GET['bl']);
		}
		if(!empty($_GET['th'])){
			$year = intval($_GET['th']);
		}
		$this->load->view('index');
	}

	public function tambah_izin($id=0)
	{
		$this->esg_model->set_nav_title('Tambah Izin');
		$data = ['id'=>$id];
		if(empty($id))
		{
			$data = ['status'=>'danger','msg'=>'Data Tidak ditemukan'];
		}else{
			$custom_api = $this->esg->get_config(base_url().'_api')['url'];
			$data['perangkat'] = json_decode(file_get_contents($custom_api.'api/perangkat/get_by_id/'.$id),1);
		}
		$post = $this->input->post();
		$exist = [];
		if(!empty($post))
		{
			$this->db->select('id');
			$exist = $this->db->get_where('absensi',['perangkat_desa_id'=>$id,'CAST(created AS date) = '=>$post['created']])->row_array();
			if(!empty($exist)){
				$data['exist'] = $exist;
				$data['status'] = 'danger';
				$data['msg'] = 'Izin sudah ada';
			}
		}
		$this->load->view('index', $data);
	}

	public function config()
	{
		$this->load->view('index');
	}
	public function config_jam()
	{
		$this->load->view('index');
	}
	public function perangkat_list()
	{
		$this->load->view('index');
	}
	public function clear_perangkat_list()
	{
		$this->load->view('absensi/perangkat_list');
	}
}