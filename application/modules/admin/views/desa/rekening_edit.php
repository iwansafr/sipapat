<?php defined('BASEPATH') OR exit('No direct script access allowed');

$desa_id = @intval($_GET['desa_id']);
$desa = $this->sipapat_model->get_desa($desa_id);
if(!empty($desa_id) && !empty($desa))
{
	$form = new zea();
	$form->init('edit');
	$form->setTable('desa_rekening');

	$form->setHeading('Rekening Desa');

	$form->addInput('nama','text');
	$form->setValue('nama',$desa['nama']);
	$form->setHelp('nama','nama sesuai di rekening');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);
	$form->addInput('alamat','textarea');
	$form->addInput('no_rek','text');
	$form->setLabel('no_rek','Nomor Rekening');
	$form->addInput('bank','text');
	$form->setLabel('bank','Nama Bank');
	$form->addInput('foto_rek','file');
	$form->setLabel('foto_rek','Foto Rekening');
	$form->addInput('no_npwp','text');
	$form->setLabel('no_npwp','Nomor NPWP');
	$form->addInput('foto_npwp','file');
	$form->setLabel('foto_npwp','Foto NPWP');

	$form->setRequired(['nama','alamat','no_rek','bank','foto_rek','no_npwp']);
	$form->form();
}else{
	msg('desa tidak diketahui','warning');
}