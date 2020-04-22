<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa() || is_root())
{
	$desa_id = 0;
	if(!empty($user['pengguna']['desa_id']))
	{
		$desa_id = $user['pengguna']['desa_id'];
	}else if(!empty($user['desa_id']))
	{
		$desa_id = $user['desa_id'];
	}

	$form = new zea();
	$form->init('roll');
	$form->setTable('corona');
	$form->search();

	if(!empty($desa_id))
	{
		$form->setWhere('desa_id = '.$desa_id.' AND status = 0');
	}

	$form->setNumbering(true);
	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id',[base_url('admin/corona/detail/{id}')=>'Detail']);

	$form->addInput('nik','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('umur','plaintext');

	$form->addInput('desa_id','dropdown');
	$form->setLabel('desa_id','desa');
	
	if(!empty($sipapat_config))
	{
		$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);
	}else{
		$form->tableOptions('desa_id','desa','id','nama');
	}
	$form->setAttribute('desa_id','disabled');

	$form->addInput('rt','plaintext');
	$form->addInput('rw','plaintext');
	$form->addInput('dari','plaintext');
	$form->addInput('tgl','plaintext');
	$form->addInput('hp','plaintext');

	$form->addInput('status','checkbox');

	$form->setUrl('admin/corona/clear_list');
	$form->setDataTable(true);

	// $form->setEdit(true);
	$form->setDelete(true);
	$form->form();
	pr($form->getData());
}