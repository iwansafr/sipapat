<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($sipapat_config))
{
	$form = new zea();

	$form->init('roll');
	$form->setTable('dilan_surat');
	$form->join('desa','ON(desa.id = dilan_surat.desa_id)','desa_id AS id,nama, COUNT(desa_id) AS total');
	$form->setWhere('desa.province_id = '.$sipapat_config['province_id']);

	$form->group_by('desa_id');

	$form->disable_order_by();

	$form->search();
	$form->addInput('id','plaintext');
	$form->setPlainText('id',[base_url('admin/dilan/surat_used_detail/{id}')=>'detail']);
	$form->setLabel('id','action');
	$form->addInput('nama','plaintext');
	// $form->addInput('desa_id','plaintext');
	$form->addInput('total','plaintext');

	$form->setNumbering(true);
	$form->setUrl('admin/dilan/clear_surat_used');
	$form->form();

	pr($form->getData()['query']);
}