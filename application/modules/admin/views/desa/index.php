<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->setTable('desa');
if(!is_admin() && !is_root())
{
	// $form->setWhere(' id = '.$pengguna['desa_id']);
	$form->setId($pengguna['desa_id']);
	$form->init('edit');
	$form->setHeading
		(
			'<a href="'.base_url('admin/desa/edit?id='.$pengguna['desa_id']).'" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Ubah</a>'.
			'<a href="'.base_url('admin/desa/list_report?t=pdf').'" class="btn btn-sm btn-warning"><i class="fa fa-pdf"></i></a>'.
			'<a href="'.base_url('admin/desa/list_report?t=excel').'" class="btn btn-sm btn-warning"><i class="fa fa-excel"></i></a>'
		);
	$form->setEditStatus(FALSE);
	$form->addInput('kode','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('kabupaten','plaintext');
	$form->addInput('kode_pos','plaintext');
	$form->addInput('telepon','plaintext');
	$form->addInput('email','plaintext');
	$form->addInput('website','plaintext');
	$form->addInput('alamat','plaintext');
	$form->setSave(FALSE);
	$form->form();
}else{
	$form->init('roll');
	$form->search();
	$form->setHeading
		(
			'<a href="'.base_url('admin/desa/edit').'"><button class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i></button></a>'.
			'<a target="_blank" href="'.base_url('admin/desa/pdf').'" class="btn btn-sm btn-default"><i class="fa fa-file-pdf-o"></i>/<i class="fa fa-print"></i></a>'.
			'<a target="_blank" href="'.base_url('admin/desa/export').'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>'
		);
	$form->setNumbering(TRUE);
	$form->addInput('id','link');
	$form->setLabel('id','detail');
	$form->setPlainText('id','lihat detail');
	$form->setLink('id',base_url('admin/desa/detail'),'id');
	$form->setClearGet('id');
	$form->addInput('kode','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('kabupaten','plaintext');
	$form->addInput('kode_pos','plaintext');
	$form->addInput('telepon','plaintext');
	$form->addInput('email','plaintext');
	$form->addInput('website','plaintext');
	$form->addInput('alamat','plaintext');
	$form->setUrl('admin/desa/clear_list');
	$form->setEdit(TRUE);
	$form->setDelete(TRUE);
	$form->form();
}
