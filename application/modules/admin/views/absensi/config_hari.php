<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_kecamatan() || is_root() || is_admin())
{
	$form = new zea();
	$form->init('param');
	if(!empty($user['pengguna']['district_id']))
	{
		$paramname = base_url().'_'.$user['pengguna']['district_id'].'_absensi_config_hari';
		$form->setParamName($paramname);
	}else{
		$form->setParamName(base_url().'_absensi_config_hari');
	}
	$form->setHeading('Hari Kerja');
	$form->setTable('config');
	
	$form->addInput('hari','multiselect');
	$hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
	$hari_output = [];
	foreach ($hari as $key => $value) 
	{
		$hari_output[] = [
			'id' => $key+1,
			'par_id' => 0,
			'title' => $value,
		];
	}
	$form->setMultiSelect('hari',$hari_output,'id,par_id,title');
	$form->setLabel('hari','Hari Kerja ( ctrl+click untuk memilih hari)');
	$form->form();
}