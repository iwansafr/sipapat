<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root())
{
	$form = new zea();
	$form->init('param');
	$form->setParamName(base_url().'_absensi_config');
	$form->setTable('config');
	$form->addInput('header','text');
	$form->setHelp('header','bungkus variabel dg diawali [ dan diakhiri ]');
	$form->addInput('header_color','text');
	$form->setType('header_color','color');
	$form->form();
}