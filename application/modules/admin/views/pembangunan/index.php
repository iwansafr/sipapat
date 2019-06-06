<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($view))
{
	$form = new zea();
	$form->setTable('pembangunan');
	$form->init('roll');
	$form->addInput('id','link');
	$form->setLink('id',base_url('admin/pembangunan/detail/'),'id');
	$form->setClearGet('id');
	$form->setPlainText('id','Detail');
	$form->setLabel('id','Detail');
	$form->setNumbering(TRUE);
	$form->addInput('item','plaintext');
	$form->addInput('sumber_dana','dropdown');
	$form->setAttribute('sumber_dana','disabled');
	$form->setOptions('sumber_dana', $sumber);
	$form->setLabel('sumber_dana', 'Sumber Dana');

	$form->addInput('bidang','dropdown');
	$form->setAttribute('bidang','disabled');
	$form->setOptions('bidang', $bidang);

	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setLabel('desa_id','Desa');
	$form->setAttribute('desa_id','disabled');

	$form->addInput('anggaran','plaintext');
	$form->setType('anggaran','number');

	if($view == 'fisik')
	{
		// $form->addInput('doc_0','file');
		// $form->setLabel('doc_0','Dokumantasi 0 %');
		// $form->addInput('doc_50','file');
		// $form->setLabel('doc_50','Dokumantasi 50 %');
		// $form->addInput('doc_100','file');
		// $form->setLabel('doc_100','Dokumantasi 100 %');
	}else{
		$form->addInput('doc','file');
	}

	$form->addInput('tahap','dropdown');
	$form->setAttribute('tahap','disabled');
	$form->setOptions('tahap', ['-1'=>'1 X tahapan','1'=>'Kegiatan Tahap 1','2'=>'Kegiatan Tahap 2','3'=>'Kegiatan Tahap 3']);
	$form->addInput('th_anggaran','plaintext');
	$form->setLabel('th_anggaran','Tahun Anggaran');


	$form->form();
}else{
	msg('Maaf URL yg anda tuju tidak valid', 'danger');
}