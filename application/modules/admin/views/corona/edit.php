<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
	$desa_id = 0;
	if(!empty($user['pengguna']['desa_id']))
	{
		$desa_id = $user['pengguna']['desa_id'];
	}

	$form = new zea();
	$form->init('edit');
	$form->setTable('corona');

	$form->addInput('nama','text');
	$form->addInput('umur','text');

	$form->addInput('desa_id','dropdown');
	$form->setLabel('desa_id','desa');
	
	if(!empty($desa_id))
	{
		$form->tableOptions('desa_id','desa','id','nama','id = '.$desa_id);
	}else{
		$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);
	}
	// $form->setAttribute('desa_id','disabled');

	$form->addInput('rt','text');
	$form->addInput('rw','text');
	$form->addInput('dari','text');
	$form->addInput('tgl','text');
	$form->addInput('hp','text');

	$form->addInput('status','dropdown');
	$form->setOptions('status',['1'=>'ODP','2'=>'PDP','3'=>'Positive']);

	$form->form();
}