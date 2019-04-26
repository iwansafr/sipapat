<?php defined('BASEPATH') OR exit('No direct script access allowed');
	echo '<a class="btn btn-warning btn-sm" href="'.base_url('admin/pengguna/list').'"><i class="fa fa-arrow-left"></i> kembali</a>';
if(!empty($id) && is_numeric($id))
{
	$form = new zea();

	$form->init('edit');
	$form->setTable('user_desa');
	$form->setHeading('Data Pengguna');
	$form->setEDitStatus(FALSE);
	$form->setTable('user_desa');
	$form->setId(@intval($id));
	$form->setHeading('Pengguna');
	$form->addInput('nama','plaintext');
	$form->addInput('username','plaintext');
	$form->addInput('user_role_id','dropdown');
	$form->setLabel('user_role_id','group');
	$form->tableOptions('user_role_id','user_role','id','title','level > 1');
	$form->setAttribute('user_role_id','disabled');
	$form->setLabel('nama','Nama Lengkap');
	$form->addInput('email','plaintext');
	$form->setAttribute('email',['type'=>'email']);
	$form->addInput('phone','plaintext');
	$form->setAttribute('phone',['type'=>'number']);
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','nama desa');
	$form->setSave(FALSE);
	$form->form();
}else{
	msg('url tidak valid','danger');
}