<?php defined('BASEPATH') OR exit('No direct script access allowed');

$desa_id = $this->sipapat_model->get_desa_id();

$form = new zea();

$form->init('roll');
$form->setTable('perangkat_desa');
$form->search();

$form->addInput('id','plaintext');
$form->setWhere('desa_id = '.$desa_id.' AND kelompok = 1');
$form->setLabel('id','detail');
$form->setPlainText('id',[base_url('admin/absensi/detail/{id}')=>'Detail']);

$form->setNumbering(TRUE);

$form->addInput('nama','plaintext');
$form->setUrl('admin/absensi/clear_perangkat_list');

$form->form();