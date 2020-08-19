<?php

if(is_desa())
{
	$form = new zea();

	$form->setId(@intval($_GET['id']));
	$form->init('edit');
	$form->setTable('apbdes');
	$form->addInput('tahun','text');
	$form->setType('tahun','number');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$user['pengguna']['desa_id']);

	$form->addInput('infografi','file');
	$form->setAccept('infografi','.jpg,.jpeg,.png');
	$form->setLabel('infografi','infografi (upload gambar)');

	$form->addInput('nominal','text');
	$form->settype('nominal','number');
	$form->setRequired(['tahun','nominal']);

	$form->form();
}