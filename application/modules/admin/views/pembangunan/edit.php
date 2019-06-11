<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($view) || is_desa() || is_root())
{
	$form = new zea();
	$form->setTable('pembangunan');
	$form->init('edit');
	$form->setId(@intval($_GET['id']));
	$form->addInput('item','text');
	$form->addInput('sumber_dana','dropdown');
	$form->setOptions('sumber_dana', $sumber);
	$form->setLabel('sumber_dana', 'Sumber Dana');

	$form->addInput('bidang','dropdown');
	$form->setOptions('bidang', $bidang);

	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);

	$form->addInput('user_id','static');
	$form->setValue('user_id',@intval($user['id']));

	$form->addInput('anggaran','text');
	$form->setType('anggaran','number');

	if($view == 'fisik')
	{
		$form->addInput('doc_0','file');
		$form->setLabel('doc_0','Dokumantasi 0 %');
		$form->addInput('doc_50','file');
		$form->setLabel('doc_50','Dokumantasi 50 %');
		$form->addInput('doc_100','file');
		$form->setLabel('doc_100','Dokumantasi 100 %');
	}else{
		$form->addInput('peserta','text');
		$form->addInput('jenis','static');
		$form->setValue('jenis',0);
		$form->addInput('doc','file');
		$form->setLabel('doc','Foto Kegiatan');
		$form->addInput('tahap','dropdown');
		$form->setOptions('tahap', ['-1'=>'1 X tahapan','1'=>'Kegiatan Tahap 1','2'=>'Kegiatan Tahap 2','3'=>'Kegiatan Tahap 3']);
	}

	$form->addInput('th_anggaran','text');
	$form->setLabel('th_anggaran','Tahun Anggaran');
	$form->setType('th_anggaran','number');


	$form->form();
}else{
	msg('Maaf URL yg anda tuju tidak valid', 'danger');
}