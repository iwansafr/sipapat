<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$form = new zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName(base_url());

	$form->addInput('province_id','dropdown');
	$form->setLabel('province_id','Provinsi');
	$form->setOptions('province_id',['none']);

	$form->addInput('regency_id','dropdown');
	$form->setLabel('regency_id','Kabupaten');
	$form->setOptions('regency_id',['none']);
	
	$form->addInput('image', 'upload');
	$form->setAccept('image', 'image/jpeg,image/png');

	$form->setFormName(base_url());
	$form->form();
}