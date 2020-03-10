<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();

if(!empty($desa_id))
{
	$form->init('roll');
	$form->setTable('absensi');
	$form->setWhere('desa_id = '.$desa_id);

	$form->addInput('id','plaintext');

	$form->addInput('perangkat_desa_id','dropdown');
	$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama','desa_id = '.$desa_id);
	$form->setAttribute('perangkat_desa_id','disabled');

	$form->addInput('status','dropdown');
	$form->setOptions('status',['1'=>'Berangkat','2'=>'Pulang']);
	$form->setAttribute('status','disabled');

	$form->setEdit(true);
	$form->setDelete(true);

	$form->form();
}else{
	msg('desa tidak diketahui','danger');
}