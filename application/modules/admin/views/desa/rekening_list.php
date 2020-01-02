<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_desa())
{
	$form = new zea();
	$form->init('roll');
	$form->search();
	$form->setTable('desa_rekening');
	$form->setHeading('Rekening Desa');
	$form->addInput('id','hidden');
	$form->setNumbering(true);
	$form->addInput('nama','plaintext');
	$form->setHelp('nama','nama sesuai di rekening');
	$form->addInput('alamat','plaintext');
	$form->addInput('no_rek','plaintext');
	$form->setLabel('no_rek','Nomor Rekening');
	$form->addInput('bank','plaintext');
	$form->setLabel('bank','Nama Bank');
	$form->addInput('no_npwp','plaintext');
	$form->setLabel('no_npwp','Nomor NPWP');
	$form->setEdit(true);
	$form->setDelete(true);
	$form->setUrl('admin/desa/rekening_list_clear');
	$form->setEditLink(base_url('admin/desa/rekening_edit?id='),'id');
	$form->form();
}else{
	msg('anda tidak punya hak akses ke halaman ini','danger');
}