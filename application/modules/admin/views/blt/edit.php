<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
	$pengguna = [];
	if(!empty($_SESSION[base_url().'_logged_in']['pengguna']))
	{
		$pengguna = $_SESSION[base_url().'_logged_in']['pengguna'];
		$desa_id = $pengguna['desa_id'];

		$id = @intval($_GET['id']);
		$form = new zea();

		$form->init('edit');
		$form->setTable('blt');

		$form->setId($id);
		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$desa_id);

		$form->addInput('nik','text');
		$form->setType('nik','number');

		$form->addInput('kk','text');
		$form->setType('kk','number');

		$form->addInput('nama','text');
		$form->setLabel('nama','Nama Penerima');

		$form->addInput('nominal','text');
		$form->setType('nominal','number');

		$form->addInput('alamat','textarea');

		$form->setRequired('All');
		$form->setUnique(['kk','nik'],'{value} Sudah Terdaftar');
		$form->form();
	}
}else{
	msg('Hanya desa yg dapat melakukan perubahan','danger');
}
