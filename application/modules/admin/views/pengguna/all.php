<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$form = new zea();
	$form->setNumbering(true);

	$form->search();
	$form->init('roll');
	$form->setTable('user_desa');

	$form->join('user_role',
	    'ON(user_role.id=user_desa.user_role_id)',
	    '
	    user_desa.id,
	    user_desa.username,
	    user_desa.user_role_id,
	    user_role.level,
	    user_desa.nama,
	    user_desa.email,
	    user_desa.sandi,
	    user_desa.active');

	$form->addInput('id','plaintext');
	$form->addInput('username','plaintext');
	$form->addInput('sandi','plaintext');
	$form->addInput('level','plaintext');

	$form->setUrl('admin/pengguna/clear_all');

	$form->setEdit(true);
	$form->setDelete(true);

	$form->form();
}