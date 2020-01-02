<?php defined('BASEPATH') OR exit('No direct script access allowed');

$id = @intval($_GET['id']);
if(!is_desa())
{
	$desa_id = @intval($_GET['desa_id']);
}else{
	if(!empty($_POST))
	{
		header('location: '.base_url('admin/desa/rekening_edit'));
	}
	$desa_id = $this->sipapat_model->get_desa_id();
}
$desa = $this->sipapat_model->get_desa($desa_id);
if((!empty($desa_id) && !empty($desa)) || !empty($id))
{
	$rekening = $this->sipapat_model->get_rekening($desa_id);

	$form = new zea();
	$form->init('edit');
	$form->setTable('desa_rekening');

	if(!empty($rekening))
	{
		$form->setId($rekening['id']);
	}else{
		$form->setId($id);
	}

	$form->setHeading('Rekening Desa');
	$form->addInput('nama','text');
	$form->setHelp('nama','nama sesuai di rekening');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);
	$form->addInput('alamat','textarea');
	$form->addInput('no_rek','text');
	$form->setLabel('no_rek','Nomor Rekening');
	$form->addInput('bank','text');
	$form->setLabel('bank','Nama Bank');
	$form->addInput('foto_rek','upload');
	$form->setAccept('foto_rek', '.jpg,.jpeg,.png');
	$form->setLabel('foto_rek','Foto Rekening');
	$form->addInput('no_npwp','text');
	$form->setLabel('no_npwp','Nomor NPWP');
	$form->addInput('foto_npwp','upload');
	$form->setAccept('foto_npwp', '.jpg,.jpeg,.png');

	$form->setRequired(['nama','alamat','no_rek','bank']);
	$form->form();
}else{
	msg('desa tidak diketahui','warning');
}