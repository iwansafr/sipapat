<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('config');
$form->setWhere(" name LIKE 'survey_%'");
$form->setNumbering(TRUE);
$form->addInput('id','link');
if(is_desa())
{
	$form->setLabel('id','isi survey');
	$form->setLink('id',base_url('admin/survey/isi'),'name');
	$form->setPlainText('id','<i class="fa fa-pencil-alt"></i> isi survey');
	$form->setAttribute('id',['class'=>'btn btn-default']);
	$form->addInput('name','plaintext');
}else{
	$form->setLabel('id','edit');
	$form->setLink('id',base_url('admin/survey/edit'),'name');
	$form->setPlainText('id','<i class="fa fa-pencil-alt"></i> edit');
	$form->setAttribute('id',['class'=>'btn btn-default']);
	$form->addInput('name','plaintext');
	$form->setDelete(TRUE);
}
$form->setUrl('admin/survey/clear_list');
$form->form();