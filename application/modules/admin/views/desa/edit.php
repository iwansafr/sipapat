<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_root() || is_admin() || @$pengguna['desa_id'] == $_GET['id'])
{
	$form = new zea();
	$form->setId(@intval($_GET['id']));
	$form->init('edit');
	$form->setTable('desa');
	$form->setHeading('Data Desa');
	$form->addInput('kode','text');
	$form->setLabel('kode','Kode Desa');
	$form->addInput('nama','text');
	$form->setLabel('nama','Nama Desa');
	$form->addInput('kecamatan','text');
	$form->setAttribute('kecamatan','onkeyup="this.value = this.value.toUpperCase();"');
	$form->addInput('kabupaten','text');
	$form->setAttribute('kabupaten','onkeyup="this.value = this.value.toUpperCase();"');
	$form->addInput('provinsi','text');
	$form->setAttribute('provinsi','onkeyup="this.value = this.value.toUpperCase();"');
	$form->addInput('kode_pos','text');
	$form->setLabel('kode_pos','Kode Pos');
	$form->setAttribute('kode_pos',['type'=>'number']);
	$form->addInput('telepon','text');
	$form->setLabel('telepon','Nomor Telepon');
	$form->setAttribute('telepon',['type'=>'number']);
	$form->addInput('email','text');
	$form->setAttribute('email',['type'=>'email','placeholder'=>'nama@gmail.com']);
	$form->addInput('website','text');
	$form->setAttribute('website',['type'=>'url','placeholder'=>'http://website.com']);
	$form->addInput('alamat','textarea');
	$form->setLabel('alamat','Alamat Balai Desa');
	$form->setRequired(['nama','kecamatan','kabupaten']);
	$form->form();
}else{
	msg('maaf anda tidak diperkenankan mengakses halaman ini', 'danger');
}