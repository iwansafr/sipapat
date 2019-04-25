<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setId(@intval($_GET['id']));

$form->init('edit');
$form->setTable('desa');
$form->setHeading('Data Desa');
$form->addInput('kode','text');
$form->setLabel('kode'.'Kode Desa');
$form->addInput('nama','text');
$form->setLabel('nama'.'Nama Desa');
$form->addInput('kecamatan','text');
$form->addInput('kabupaten','text');
$form->addInput('kode_pos','text');
$form->setLabel('kode_pos'.'Kode Pos');
$form->setAttribute('kode_pos',['type'=>'number']);
$form->addInput('telepon','text');
$form->setLabel('telepon'.'Nomor Telepon');
$form->setAttribute('telepon',['type'=>'number']);
$form->addInput('email','text');
$form->setAttribute('email',['type'=>'email']);
$form->addInput('website','text');
$form->setAttribute('website',['type'=>'url']);
$form->addInput('alamat','textarea');
$form->setLabel('alamat','Alamat Balai Desa');
$form->form();