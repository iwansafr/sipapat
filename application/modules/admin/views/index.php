<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->esg->check_login();
ini_set('display_errors', 1);
$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();
$this->load->model('sipapat_model');
if($mod['name'] == 'admin' && $mod['task'] == 'index')
{
	$dashboard_config = $this->esg->get_config(base_url('_dashboard_config'));
	if(!empty($dashboard_config))
	{
		$this->esg->set_esg('dashboard_config',$dashboard_config);
		if(!empty($dashboard_config['absensi']) && is_kecamatan())
		{
			$user = $this->esg->get_esg('user');
			if(!empty($user['pengguna']['district_id']))
			{
				$this->load->model('absensi_model');
				$absensi = $this->absensi_model->get_all($user['pengguna']['district_id']);
				if(!empty($absensi))
				{
					$this->esg->set_esg('absensi',$absensi);
				}
			}
		}
	}
	$this->load->model('notification_model');
	$this->load->model('pengguna_model');
	$pengguna = $this->pengguna_model->get_pengguna();
	$desa = array();
	$pengumuman = array();
	if(!empty($pengguna))
	{
		$desa = $this->sipapat_model->get_desa($pengguna['desa_id']);
	}
	if(!empty($desa) && !empty($dashboard_config['pengumuman']))
	{
		$pengumuman = $this->sipapat_model->get_pengumuman(strtolower($desa['kecamatan']));
	}
	$amj_alert = $this->sipapat_model->perangkat_alert();
	if(!empty($amj_alert))
	{
		$this->esg->set_esg('amj_alert', $amj_alert);
	}
	if(!empty($pengumuman))
	{
		$this->esg->set_esg('pengumuman_kecamatan', $pengumuman);
	}
}
$this->sipapat_model->site();
$date = date('Y-m-d');
$deadline = date('2019-08-24');
$allowed = TRUE;
// if($date > $deadline)
// {
// 	if(is_desa())
// 	{
// 		$allowed = FALSE;
// 	}
// }
if($allowed)
{
	// pr($this->esg->get_esg());die();
	$this->load->view('templates'.DIRECTORY_SEPARATOR.$this->esg->get_esg('templates')['admin_template'].DIRECTORY_SEPARATOR.'index', $this->esg->get_esg());
}else{
	?>
	<style>
		body{
			 /*background: black;*/
			 color: red;
		}
	</style>
	<div style="text-align: center;">
		<h1>Untuk Sementara Sipapat ditutup Karena Tim Kami sedang Melakukan Identifikasi Pemenang Lomba Kemerdekaan</h1>
		<img src="https://i.pinimg.com/originals/87/5d/80/875d8095922b780d7709927c9581a8eb.gif" alt="">
		<hr>
		<div style="width: 100%; background: black; height: 100%;">
			<img src="https://simpliv.files.wordpress.com/2018/03/computer-programming-for-beginners3.gif?w=392&h=294" alt="">
		</div>
	</div>
	<?php
}