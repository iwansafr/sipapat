<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->search();
$form->setTable('blt');


$form->setNumbering(true);
$form->setUrl('admin/blt/clear_list');
$form->join('desa','ON(desa.id=blt.desa_id)','blt.id,blt.nik,blt.kk,blt.nama,blt.alamat,blt.nominal,desa.nama AS desa,desa.kecamatan');
if(is_kecamatan())
{
	$district_id = @intval($_SESSION[base_url().'_logged_in']['pengguna']['district_id']);
	$form->setWhere(' desa.district_id = '.$district_id);
}else if(is_desa())
{
	$desa_id = @intval($_SESSION[base_url().'_logged_in']['pengguna']['desa_id']);
	if(!empty($desa_id))
	{
		$form->setWhere(' desa_id = '.$desa_id);
	}
	$form->setEdit(true);
	$form->setDelete(true);
}

$form->addInput('id','plaintext');
$form->setLabel('id','kode');
$form->addInput('nik','plaintext');
$form->addInput('kk','plaintext');
$form->addInput('nama','plaintext');
$form->setLabel('nama','penerima');
$form->addInput('nominal','plaintext');
$form->addInput('alamat','plaintext');
$form->addInput('desa','plaintext');
$form->addInput('kecamatan','plaintext');

$form->setDataTable(true);
$form->form();