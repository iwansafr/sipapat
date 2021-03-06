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

	public function masuk()
	{
		$data = [];
		$user = $this->esg->get_esg('user');
		if(!empty($user['pengguna']['desa_id']))
		{
			$id = $user['pengguna']['desa_id'];
			$custom_api = $this->esg->get_config(base_url().'_api');
			if(!empty($custom_api['url']))
			{
				$custom_api = $custom_api['url'];
				$desa = curl($custom_api.'/api/desa/detail/'.$id);
				if(!empty($desa))
				{
					$desa = json_decode($desa,1);
					if(!empty($desa))
					{
						$data['desa'] = $desa;
						$kepdes = curl($custom_api.'/api/perangkat/get_kepdes_by_desa/'.$id);
						if(!empty($kepdes))
						{
							$kepdes = json_decode($kepdes,1);
							$data['perangkat'] = $kepdes;
							$data['kepdes'] = $kepdes;
							$config_jam = [
								'mulai_masuk' => '06:00',
								'selesai_masuk' => '08:00',
								'mulai_pulang' => '13:00',
								'selesai_pulang' => '16:00'
							];
							if(!empty($desa['district_id']))
							{
								$day = date('w')+1;
								if(!empty($data['desa']['id']))
								{
									$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_'.$data['desa']['id'].'_absensi_config_jam_'.$day);
									if(empty($config_jam_tmp))
									{
										$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_'.$data['desa']['id'].'_absensi_config_jam');
									}
								}
								if(empty($config_jam_tmp))
								{
									$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_absensi_config_jam');
								}
								if(!empty($config_jam_tmp))
								{
									$config_jam = $config_jam_tmp;
								}
								// $config_hari = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_absensi_config_hari');
								// if(empty($config_hari))
								// {
								// 	$config_hari = $this->esg->get_config(base_url().'_absensi_config_hari');
								// }
								// if(!empty($config_hari['hari']))
								// {
								// 	$config_hari = $config_hari['hari'];
								// 	$today = date('w');
								// 	if(in_array($today, $config_hari))
								// 	{
								// 		$libur = true;
								// 	}else{
								// 		$libur = false;
								// 	}
								// 	$libur = false;
								// }else{
								// 	$libur = false;
								// 	// echo 'Mohon Maaf Sistem Belum tersetting';die();
								// }
								$libur = false;

								$libur_status = $this->absensi_model->is_libur();
								$data['libur_status'] = $libur_status;
							}
							$data['libur'] = $libur;
							$h = date('H:i');
							if(empty($config_jam['selesai_masuk'])){
								?>
								<p style="background: red;color: white;">
									Maaf Sepertinya Jaringan Anda bermasalah<br>
									silahkan hubungi teknisi
								</p>
								<hr>
								<a href=""><button>Refresh halaman</button></a>
								<?php
								die();
							}
							if($config_jam['mulai_masuk']<=$h && $h<=$config_jam['selesai_masuk']){
					  		$status = 1;
					  		//berangkat
						  }else if($config_jam['selesai_masuk'] <= $h && $h <= $config_jam['mulai_pulang']){
					  		$status = 4;
					  		//terlambat
						  }else if($h <= $config_jam['selesai_pulang'] && $h >= $config_jam['mulai_pulang']){
					  		$status = 3;
					  		//pulang
						  }else{
					  		$status = 0;
					  		//off
						  }
						  ?>
							<script type="text/javascript">
								var config_jam = <?php echo json_encode($config_jam);?>;
								var __desa_id = <?php echo $id;?>
							</script>
						  <?php
							if(!empty($this->input->post()))
							{
								$upload = $this->input->post();
								$success = 1;
								$upload['desa_id'] = $desa['id'];
								$data['status'] = $this->absensi_model->upload($upload);
							}
							$data['perangkat_pagi'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_pagi/'.$desa['id'].'/1'),1);
							$data['perangkat_sore'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_sore/'.$desa['id'].'/1'),1);
							$data['perangkat_izin'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_izin/'.$desa['id'].'/1'),1);
							$data['sudah'] = [];
							if(!empty($status))
						  {
						  	if($status == 1 || $status == 4)
						  	{
						  		if(!empty($data['perangkat_pagi']))
						  		{
										$data['sudah'] = $data['perangkat_pagi'];
						  		}
						  	}
						  	if($status == 3)
						  	{
									$perangkat_tmp = $data['perangkat_pagi'];
						  		if(!empty($data['perangkat_sore']))
						  		{
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
						  $data['valid'] = ['0'=>'Belum divalidasi','1'=>'Data Tersimpan','2'=>'Tidak Valid'];
						}
					}
				}
			}
		}
		$this->esg->add_js(
			[
				base_url('assets/absensi/script.js?v=1.0'),
				// base_url('assets/absensi/js/face-api.min.js?v=1.0'),
				// base_url('assets/absensi/js/script.js?v=1.0'),
				// 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js',
			]
		);
		$this->load->view('index',$data);
	}

	public function list()
	{
		if(is_root() || is_admin() || is_kecamatan())
		{
			$this->esg->add_js(base_url('assets/absensi/list.js'));
		}
		$this->load->view('index');
	}
	public function clear_list()
	{
		$this->load->view('absensi/list');
	}

	public function user_list()
	{
		$this->load->view('index');
	}
	public function user_clear_list()
	{
		$this->load->view('absensi/user_list');
	}
	public function user_edit()
	{
		$this->load->view('index');
	}

	public function bolos_list()
	{
		$this->load->model('pengguna_model');
		
		if(!empty(($this->session->userdata(base_url('_logged_in'))['pengguna']['desa_id'])))
		{
			$desa_id = $this->session->userdata(base_url('_logged_in'))['pengguna']['desa_id'];
		}else{
			$desa_id = @intval($_GET['desa']);
		}
		
		$date = $this->input->get('tgl');
		$date = empty($date) ? date('Y-m-d'): $date;
		$date = strtotime($date);
		$date = date('Y-m-d',$date);
		$jabatan = $this->pengguna_model->jabatan()[1];
		$tmp_data = $this->absensi_model->get_bolos_list($desa_id,$date);
		$data['data'][0] = [
			'no','nama','jabatan'
		];
		$i = 1;
		foreach ($tmp_data as $key => $value) {
			// $value['jabatan'] = @$jabatan[$value['jabatan']];
			$data['data'][$i]['no'] = $i;
			$data['data'][$i]['nama'] = $value['nama'];
			$data['data'][$i]['jabatan'] = @$jabatan[$value['jabatan']];
			$i++;
		}
		$this->esg_model->set_nav_title('Daftar Perangkat Tidak Masuk');
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
			$this->load->model('pengguna_model');
			$data['jabatan'] = $this->pengguna_model->jabatan()[1];
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
			$data['perangkat'] = json_decode(curl($custom_api.'api/perangkat/get_by_id/'.$id),1);
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
			$data['perangkat'] = json_decode(curl($custom_api.'api/perangkat/get_by_id/'.$id),1);
		}

		if(empty($month)){
			$data['data'] = [];
		}else{
			$data['data'] = $this->db->get_where('absensi', ['perangkat_desa_id'=>$id,'MONTH(created)'=> $month,'YEAR(created)'=>$year])->result_array();
		}
		$tmp_data = [];
		$libur_month = $this->db->query('SELECT * FROM absensi_libur WHERE MONTH(date) = ? ORDER BY id DESC',$month)->result_array();
		$liburs = [];
		foreach ($libur_month as $key => $value) 
		{
			$liburs[$value['date']] = $value['title'];
		}
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
				if($value['status'] == 1 || $value['status'] == 4)
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
				$tmp_data[$index]['status'] = ($value['status'] == 0 || $value['status'] == 1 || $value['status'] == 4) ? 0 : 1;
			}
			$tgl = $this->absensi_model->tgl($year.'-'.$month.'-01');
		}
		$output[] = [
			'tgl','nama','hari','status','jam_berangkat','jam_pulang','valid'
		];
		$message_status = 
			[
				'<span class="btn-sm btn-danger">Absen</span>',
				'<span class="btn-sm btn-success">Berangkat</span>'
			];
		$message_validation = $this->absensi_model->valid();
		if(!empty($tgl))
		{
			foreach ($tgl as $key => $value) 
			{
				$is_libur = (array_key_exists($value['date'], $liburs)) ? $liburs[$value['date']] : 'kosong';
				if(!empty($tmp_data[$value['date']]))
				{
					$pesan_status = $tmp_data[$value['date']]['jam_pulang'] != 'Kosong' ? $message_status[$tmp_data[$value['date']]['status']] : '<span class="btn-sm btn-warning">Bolos</span>';
					$output[] =
					[
						'tgl' => $tmp_data[$value['date']]['tgl'],
						'nama' => $data['perangkat']['nama'],
						'day_name' => $value['name'],
						'status' => $pesan_status,
						'jam_berangkat' => $tmp_data[$value['date']]['jam_berangkat'],
						'jam_pulang' => $tmp_data[$value['date']]['jam_pulang'],
						// 'date_num' => $value['num'],
						'valid' => $message_validation[$tmp_data[$value['date']]['valid']]
					];
				}else{
					$pesan_status = $is_libur == 'kosong' ? $message_status[0] : '<span class="btn-sm btn-info">'.$liburs[$value['date']].'</span>';
					$output[] =
					[
						'tgl' => $value['date'],
						'nama' => $data['perangkat']['nama'],
						'day_name' => $value['name'],
						'status' => $pesan_status,
						'jam_berangkat' => $is_libur,
						'jam_pulang' => $is_libur,
						// 'date_num' => $value['num'],
						'valid' => $message_validation[0]
					];
				}
			}
		}
		// pr($output);die();
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
			$data['perangkat'] = json_decode(curl($custom_api.'api/perangkat/get_by_id/'.$id),1);
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
	public function config_jam($id = 0)
	{
		$this->esg_model->set_nav_title('Config Jam');
		$custom_api = $this->esg->get_config(base_url().'_api')['url'];
		$desa = json_decode(curl($custom_api.'/api/desa/detail/'.$id),1);
		$data = [];
		if(!empty($desa))
		{
			$data['desa'] = $desa;
		}
		$this->load->view('index',$data);
	}
	public function config_off_day()
	{
		$this->esg_model->set_nav_title('Config Hari Libur');
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
	public function not_valid($id = 0)
	{
		if(!empty($id))
		{
			if($this->db->update('absensi',['valid'=>2],['id'=>$id])){
				$data = ['status'=>'success','msg'=>'Data Berhasil dirubah'];
			}else{
				$data = ['status'=>'danger','msg'=>'Data tidak ditemukan'];
			}
			$this->load->view('index',$data);
		}
	}

	public function libur()
	{
		$this->load->view('index');
	}
	public function clear_libur()
	{
		$this->load->view('admin/absensi/libur');
	}
}