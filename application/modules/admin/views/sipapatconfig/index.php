<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$form = new zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName('sipapat_config');

	$form->addInput('kabupaten','text');
	$form->addInput('image', 'upload');
	$form->setAccept('image', 'image/jpeg,image/png');

	$form->setFormName('sipapat_config');
	$form->form();
}