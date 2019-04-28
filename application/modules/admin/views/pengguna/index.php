<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->init('roll');
$form->setTable('user_desa');
$form->setHeading
	(
		'Pengguna '.
		'<a target="_blank" href="'.base_url('admin/pengguna/pdf').'" class="btn btn-sm btn-default"><i class="fa fa-file-pdf-o"></i>/<i class="fa fa-print"></i></a>'.
		'<a target="_blank" href="'.base_url('admin/pengguna/excel').'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>'
	);
$form->search();
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlaintext('id','detail');
$form->setLink('id',base_url('admin/pengguna/detail'),'id');
$form->setClearGet(['id']);
$form->addInput('nama','plaintext');
$form->addInput('username','plaintext');
$form->addInput('user_role_id','dropdown');
$form->setAttribute('user_role_id','disabled');
$form->setLabel('user_role_id','group');
$form->tableOptions('user_role_id','user_role','id','title','level > 1');
$form->setLabel('nama','Nama Lengkap');
$form->addInput('email','plaintext');
$form->setAttribute('email',['type'=>'email']);
$form->addInput('phone','plaintext');
$form->setAttribute('phone',['type'=>'number']);
$form->addInput('desa_id','dropdown');
$form->setAttribute('desa_id','disabled');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','nama desa');
$form->addInput('active','checkbox');
$form->setUrl('admin/pengguna/clear_list');
$form->setNumbering(TRUE);
$form->setEdit(TRUE);
$form->setDelete(TRUE);
$form->form();
