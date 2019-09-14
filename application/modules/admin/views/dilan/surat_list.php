<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('dilan_surat');
if(is_desa())
{
	$form->setWhere(' desa_id = '.$this->sipapat_model->get_desa_id());
}

$form->search();

$form->addInput('id','plaintext');
$form->setLabel('id','display');
// $form->setLink('id',base_url('admin/dilan/surat_pengantar/'),'id');
// $form->setClearGet('id');
$form->setPlainText('id','<a class="btn btn-default btn-sm" href="'.base_url('admin/dilan/surat_pengantar/').'{id}/surat_pengantar" target="_blank">lihat surat <i class="fa fa-search"></i></a>');

$form->setNumbering(true);
$form->addInput('keperluan','plaintext');

// $form->setEdit(true);
$form->setDelete(true);
$form->setUrl('admin/dilan/clear_surat_list');

$form->form();