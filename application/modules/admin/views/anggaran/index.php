<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($type))
{
	$form = new zea();

	$form->init('roll');
	$form->setTable('anggaran');

	$form->search();
	$task = ['fisik','non_fisik'];
	$new_type = array_keys($task,$type);
	if(!empty($new_type))
	{
		$new_type = $new_type[0];
		$form->setWhere(' type = '.$new_type);
	}
	$form->setHeading('Perencaan Anggaran Tahun');
	$form->setEditStatus(FALSE);
	$form->setNumbering(TRUE);
	$form->addInput('id','plaintext');
	$form->addInput('title','plaintext');
	$form->addInput('created','plaintext');
	if(is_root() || is_desa())
	{
		$form->setEdit(TRUE);
		$form->setDelete(TRUE);
	}
	$form->setUrl('admin/anggaran/clear_list/'.$type);
	$form->form();
}else{
	msg('Url yang anda akses tidak valid','danger');
}
