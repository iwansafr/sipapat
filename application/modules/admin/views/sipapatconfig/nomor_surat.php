<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
	$form = new zea();
	$form->setTable('config');
	$form->init('param');

	$form->setParamName($this->sipapat_model->get_desa_id());

	$form->addInput('no_surat','text');
	$form->setLabel('no_surat','format nomor surat');

	$form->form();
}else{
	msg('login sebagai desa untuk setting format nomor surat','danger');
}