<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_kecamatan() || is_root())
{
	$form = new zea();
	$form->init('param');
	if(!empty($user['pengguna']['district_id']))
	{
		$form->setParamName(base_url().'_'.$user['pengguna']['district_id'].'_absensi_config_jam');
	}else{
		$form->setParamName(base_url().'_absensi_config_jam');
	}
	$form->setTable('config');
	
	$form->addInput('mulai_masuk','text');
	$form->setType('mulai_masuk','time');

	$form->addInput('selesai_masuk','text');
	$form->setType('selesai_masuk','time');

	$form->addInput('mulai_pulang','text');
	$form->setType('mulai_pulang','time');

	$form->addInput('selesai_pulang','text');
	$form->setType('selesai_pulang','time');
	$form->form();
}