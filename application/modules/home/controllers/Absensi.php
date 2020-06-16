<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('absensi_home_model');
		$this->load->model('admin/absensi_model');
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
		$day = date('w')+1;
		$custom_api = $this->esg->get_config(base_url().'_api')['url'];
		$data['desa'] = json_decode(curl($custom_api.'api/desa/detail/'.$desa_id),1);
		$config_jam = [
			'mulai_masuk' => '06:00',
			'selesai_masuk' => '08:00',
			'mulai_pulang' => '13:00',
			'selesai_pulang' => '16:00',
		];
		// $config_hari = ['1','2','3','4','5','6'];
		if(!empty($data['desa']['district_id']))
		{
			if(!empty($data['desa']['id']))
			{
				$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_'.$data['desa']['id'].'_absensi_config_jam_'.$day);
				if(empty($config_jam_tmp))
				{
					$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_'.$data['desa']['id'].'_absensi_config_jam');
				}
				if(!empty($config_jam_tmp))
				{
					foreach ($config_jam_tmp as $key => $value) 
					{
						if(empty($value))
						{
							$config_jam_tmp = [];
							break;
						}
					}
				}
			}
			if(empty($config_jam_tmp))
			{
				$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_absensi_config_jam_'.$day);
				if(empty($config_jam_tmp))
				{
					$config_jam_tmp = $this->esg->get_config(base_url().'_'.$data['desa']['district_id'].'_absensi_config_jam');
				}
				if(!empty($config_jam_tmp))
				{
					foreach ($config_jam_tmp as $key => $value) 
					{
						if(empty($value))
						{
							$config_jam_tmp = [];
							break;
						}
					}
				}
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
	  $config_jam['status'] = $status;
	  $config_jam['h'] = $h;
	  ?>
		<script type="text/javascript">
			var config_jam = <?php echo json_encode($config_jam);?>;
			var __desa_id = <?php echo $desa_id;?>
		</script>
	  <?php
		if(!empty($this->input->post()))
		{
			$upload = $this->input->post();
			$success = 1;
			$upload['desa_id'] = $desa_id;
			$data['status'] = $this->absensi_home_model->upload($upload);
		}
		$data['perangkat'] = json_decode(curl($custom_api.'api/perangkat/get_by_desa/'.$desa_id.'/1'),1);
		$data['perangkat_pagi'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_pagi/'.$desa_id),1);
		$data['perangkat_sore'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_sore/'.$desa_id),1);
		$data['perangkat_izin'] = json_decode(curl($custom_api.'api/perangkat/get_absensi_izin/'.$desa_id),1);
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
				$perangkat_tmp = $data['perangkat_pagi'];
  			$perangkat_sore_tmp = $data['perangkat'];
  			if(!empty($perangkat_sore_tmp))
  			{
  				foreach ($perangkat_sore_tmp as $key => $value) 
  				{
  					foreach ($data['perangkat_pagi'] as $pkey => $pvalue) 
  					{
  						if($pvalue['id'] == $value['id'])
  						{
  							unset($perangkat_sore_tmp[$key]);
  						}
  					}
  				}
  				if(!empty($perangkat_sore_tmp))
  				{
  					$data['perangkat_bolos'] = $perangkat_sore_tmp;
  				}
  			}
	  		if(!empty($data['perangkat_sore']))
	  		{
					$data['sudah'] = $data['perangkat_sore'];
	  		}
	  		if(empty($perangkat_tmp))
	  		{
		  		$data['perangkat'] = [];
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
	  if(!empty($libur))
	  {
	  	$data['libur'] = $libur;
	  }
	  $data['valid'] = ['0'=>'Belum divalidasi','1'=>'Data Tersimpan','2'=>'Tidak Valid'];
		$this->load->model('admin/pengguna_model');
		$this->home_model->home();
		$data['jabatan'] = $this->pengguna_model->jabatan()[1];
		$this->esg->add_js(
			[
				base_url('assets/absensi/script.js?v=1.0'),
				base_url('assets/absensi/js/face-api.min.js?v=1.0'),
				base_url('assets/absensi/js/script.js?v=1.0'),
				'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js',
			]
		);
		$this->load->view('index', $data);
	}
}