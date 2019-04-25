<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('desa');
$form->search();
$form->setHeading('<a href="'.base_url('admin/desa/edit').'"><button class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i></button></a>');
$form->setNumbering(TRUE);
$form->addInput('kode','plaintext');
$form->addInput('nama','plaintext');
$form->addInput('kecamatan','plaintext');
$form->addInput('kabupaten','plaintext');
$form->addInput('kode_pos','plaintext');
$form->addInput('telepon','plaintext');
$form->addInput('email','plaintext');
$form->addInput('website','plaintext');
$form->addInput('alamat','plaintext');
$form->form();