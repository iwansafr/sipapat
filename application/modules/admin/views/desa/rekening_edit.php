<?php defined('BASEPATH') OR exit('No direct script access allowed');

$id = @intval($_GET['id']);
if(!is_desa())
{
	$desa_id = @intval($_GET['desa_id']);
}else{
	if(!empty($_POST))
	{
		echo '<a href="'.base_url('admin/desa/rekening_edit').'" class="btn btn-warning btn-sm"><i class="fa fa-sync"></i> reload</a>';
	}
	$desa_id = $this->sipapat_model->get_desa_id();
}
$desa = $this->sipapat_model->get_desa($desa_id);
if((!empty($desa_id) && !empty($desa)) || !empty($id))
{
	$rekening = $this->sipapat_model->get_rekening($desa_id);
	if(!empty($rekening))
	{
		echo '<a href="'.base_url('admin/desa/rekening').'" class="btn btn-warning btn-sm"><i class="fa fa-search"></i> detail</a>';
	}

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
	$form->setLabel('nama','Nama Pemilik Rekening');
	$form->setAttribute('nama',['placeholder'=>strtoupper('nama sesuai di rekening desa')]);
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);
	$form->addInput('alamat','textarea');
	$form->setLabel('alamat','Alamat Pemilik Rekening');
	$form->setAttribute('alamat',['placeholder'=>strtoupper('alamat sesuai di rekening desa')]);
	$form->addInput('no_rek','text');
	$form->setLabel('no_rek','Nomor Rekening');
	$form->setAttribute('no_rek',['placeholder'=>strtoupper('nomor rekening desa')]);
	$form->addInput('bank','text');
	$form->setLabel('bank','Nama Bank');
	$form->setAttribute('bank',['placeholder'=>strtoupper('nama rekening bank')]);
	$form->addInput('bank_detail','text');
	$form->setLabel('bank_detail','Nama Detil Bank');
	$form->setAttribute('bank_detail',['placeholder'=>strtoupper('nama detil bank')]);
	$form->addInput('foto_rek','upload');
	$form->setAccept('foto_rek', '.jpg,.jpeg,.png');
	$form->setLabel('foto_rek','Foto Rekening');
	$form->addInput('no_npwp','text');
	$form->setLabel('no_npwp','Nomor NPWP');
	$form->setAttribute('no_npwp',['placeholder'=>strtoupper('nomor npwp')]);
	$form->addInput('foto_npwp','upload');
	$form->setAccept('foto_npwp', '.jpg,.jpeg,.png');

	$form->setRequired(['nama','alamat','no_rek','bank']);
	$form->form();
}else{
	msg('desa tidak diketahui','warning');
}