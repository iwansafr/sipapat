<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
$form->setEdit(TRUE);
$form->setDelete(TRUE);
$form->setUrl('admin/anggaran/clear_list/'.$type);
$form->form();
