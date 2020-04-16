<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($desa_id))
{
	$form = new zea();

	if(!empty($data))
	{
		$form->setId($data['id']);
	}
	$form->init('edit');
	$form->setTable('corona_posko');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);

	$form->addInput('alamat','textarea');
	$form->setLabel('alamat','Alamat Posko');

	$form->addInput('pj','text');
	$form->setLabel('pj','Penanggung Jawab');

	$form->addInput('hp','text');
	$form->setType('hp','number');
	$form->setLabel('hp','Nomor Hp');

	$form->addInput('foto','file');
	$form->setLabel('foto','Foto Posko');
	$form->setAccept('foto','.jpg,.png,.jpeg');

	$form->setRequired('All');

	$form->form();
}
