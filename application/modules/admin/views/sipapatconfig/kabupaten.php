<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$form = new zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName(base_url());
	$form->setHeading('Config Kabupaten <a href="'.base_url('admin/sipapatconfig/kabupaten').'" class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left"></i> kembali</a>');

	$form->addInput('province_id','dropdown');
	// $form->setAttribute('province_id',['class'=>'form-control']);
	$form->setLabel('province_id','Provinsi');
	$form->setOptions('province_id',['none']);

	$form->addInput('regency_id','dropdown');
	// $form->setAttribute('regency_id',['class'=>'form-control']);
	$form->setLabel('regency_id','Kabupaten');
	$form->setOptions('regency_id',['none']);

	$form->addInput('image', 'upload');
	$form->setAccept('image', 'image/jpeg,image/png');

	$form->setDirImage('kabupaten_image_'.str_replace('/','_',base_url()));

	$form->setFormName(base_url());
	$form->form();
}