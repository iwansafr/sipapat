<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root())
{
	$form = new Zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName(str_replace('/','_',base_url()).'_logo');
	$form->setHeading('Custom Logo Configuration');
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