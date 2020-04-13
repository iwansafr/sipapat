<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($user))
{
	$form = new zea();

	$form->init('roll');
	$form->setTable('notification');
	$form->search();

	$form->setWhere('user_id = '.$user['id']);
	$form->addInput('id','plaintext');
	$form->setPlainText('id',[base_url('admin/notification/detail/{id}')=>'Detail']);
	$form->setLabel('id','detail');
	$form->setNumbering(true);
	$form->addInput('title','plaintext');

	$form->setDelete(true);
	$form->form();
}
