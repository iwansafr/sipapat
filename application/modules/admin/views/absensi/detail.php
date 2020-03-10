<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($status)){
	msg($msg,$status);
}

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();

if(!empty($desa_id))
{
	$where = ' AND perangkat_desa_id = '.$id;
	$form->init('roll');
	$form->setTable('absensi');
	$form->setWhere('desa_id = '.$desa_id.' '.$where);

	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id',[base_url('admin/absensi/detail/{perangkat_desa_id}')=>'Detail']);

	$form->setNumbering(true);
	$form->addInput('perangkat_desa_id','dropdown');
	$form->setLabel('perangkat_desa_id','Nama Perangkat');
	$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama','desa_id = '.$desa_id);
	$form->setAttribute('perangkat_desa_id','disabled');

	$form->addInput('status','dropdown');
	$form->setOptions('status',['1'=>'Berangkat','2'=>'Pulang']);
	$form->setAttribute('status','disabled');

	$form->addInput('created','plaintext');
	$form->setUrl('admin/absensi/clear_list');

	// $form->setEdit(true);
	$form->setDelete(true);
	$form->form();
}