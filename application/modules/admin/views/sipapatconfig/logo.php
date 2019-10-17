<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_sipapat())
{
	$this->load->view('admin/config/logo');
}else{
	$form = new Zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName('sispudes_logo');
	$form->setHeading('Sispudes Logo Configuration');
	$form->addInput('title', 'text');
	$form->addInput('image', 'upload');
	$form->setAccept('image', 'image/jpeg,image/png');
	$form->addInput('width', 'text');
	$form->setAttribute('width',array('type'=>'number'));
	$form->addInput('height', 'text');
	$form->setAttribute('height',array('type'=>'number'));
	$form->addInput('display','dropdown');
	$form->setOptions('display',['title'=>'text','image'=>'logo image']);
	$form->setFormName('logo_config_form');
	$form->form();
}