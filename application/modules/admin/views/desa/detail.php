<?php defined('BASEPATH') OR exit('No direct script access allowed');
	echo '<a class="btn btn-warning btn-sm" href="'.base_url('admin/desa/list').'"><i class="fa fa-arrow-left"></i> kembali</a>';
if(!empty($id) && is_numeric($id))
{
	$form = new zea();

	$form->init('edit');
	$form->setTable('desa');
	$form->setHeading('Data Desa');
	$form->setEditStatus(FALSE);
	$form->setId($id);
	$form->addInput('kode','plaintext');
	$form->setLabel('kode','Kode Desa');
	$form->addInput('nama','plaintext');
	$form->setLabel('nama','Nama Desa');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('kabupaten','plaintext');
	$form->addInput('provinsi','plaintext');
	$form->addInput('kode_pos','plaintext');
	$form->setLabel('kode_pos','Kode Pos');
	$form->setAttribute('kode_pos',['type'=>'number']);
	$form->addInput('telepon','plaintext');
	$form->setLabel('telepon','Nomor Telepon');
	$form->setAttribute('telepon',['type'=>'number']);
	$form->addInput('email','plaintext');
	$form->setAttribute('email',['type'=>'email','placeholder'=>'nama@gmail.com']);
	$form->addInput('website','plaintext');
	$form->setAttribute('website',['type'=>'url','placeholder'=>'http://website.com']);
	$form->addInput('alamat','plaintext');
	$form->setLabel('alamat','Alamat Balai Desa');
	$form->setRequired(['nama','kecamatan','kabupaten','provinsi']);
	$form->setSave(FALSE);
	$form->form();
}else{
	msg('url tidak valid','danger');
}