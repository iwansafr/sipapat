<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->esg->check_login();
// pr($this->esg->get_esg());die();
$data = array(
						'title' => 'sipapat',
						'keyword' => 'software development',
						'description' => 'PT media nusa perkasa',
						'developer' => 'esoftgreat',
						'author' => 'esoftgreat',
						'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
						'phone' => '6285640510460',
						'icon' => base_url('images/icon.png'),
					);
$this->esg_model->set_meta($data);
$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();
if($mod['name'] == 'admin' && $mod['task'] == 'index')
{
	$this->load->model('sipapat_model');
	$this->load->model('pengguna_model');
	$pengguna = $this->pengguna_model->get_pengguna();
	$desa = array();
	$pengumuman = array();
	if(!empty($pengguna))
	{
		$desa = $this->sipapat_model->get_desa($pengguna['desa_id']);
	}
	if(!empty($desa))
	{
		$pengumuman = $this->sipapat_model->get_pengumuman(strtolower($desa['kecamatan']));
		$kepdes_alert = $this->sipapat_model->kepdes_alert();
	}
	if(!empty($kepdes_alert))
	{
		$this->esg->set_esg('kepdes_alert', $kepdes_alert);
	}
	if(!empty($pengumuman))
	{
		$this->esg->set_esg('pengumuman_kecamatan', $pengumuman);
	}
}
$this->load->view('templates'.DIRECTORY_SEPARATOR.$this->esg->get_esg('templates')['admin_template'].DIRECTORY_SEPARATOR.'index', $this->esg->get_esg());