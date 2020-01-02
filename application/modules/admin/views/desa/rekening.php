<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_desa())
{
	$desa_id = @intval($_GET['desa_id']);
}else{
	$desa_id = $this->sipapat_model->get_desa_id();
}
$desa = $this->sipapat_model->get_desa($desa_id);
if(!empty($desa_id) && !empty($desa))
{
	$rekening = $this->sipapat_model->get_rekening($desa_id);
	if(!empty($rekening))
	{
		$form = new zea();
		$form->init('edit');
		$form->setTable('desa_rekening');

		$form->setId($rekening['id']);
		$form->setHeading('Rekening Desa');
		$form->setEditStatus(false);
		$form->addInput('nama','plaintext');
		$form->setHelp('nama','nama sesuai di rekening');
		$form->addInput('alamat','plaintext');
		$form->addInput('no_rek','plaintext');
		$form->setLabel('no_rek','Nomor Rekening');
		$form->addInput('bank','plaintext');
		$form->setLabel('bank','Nama Bank');
		$form->addInput('foto_rek','thumbnail');
		$form->setLabel('foto_rek','Foto Rekening');
		$form->addInput('no_npwp','plaintext');
		$form->setLabel('no_npwp','Nomor NPWP');
		$form->addInput('foto_npwp','thumbnail');
		$form->setLabel('foto_npwp','Foto NPWP');

		$form->setRequired(['nama','alamat','no_rek','bank','foto_rek','no_npwp']);
		$form->form();
	}else{
		msg('data belum ada','danger');
	}
}else{
	msg('desa tidak diketahui','warning');
}