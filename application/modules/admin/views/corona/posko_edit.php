<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($desa_id))
{
	$form = new zea();

	$id = @intval($_GET['id']);
	$form->setId($id);

	$form->init('edit');
	$form->setTable('corona_posko');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);

	$form->addInput('alamat','textarea');
	$form->setLabel('alamat','Alamat Posko');

	$form->addInput('pj','text');
	$form->setLabel('pj','Penanggung Jawab');

	$form->addInput('hp','text');
	$form->setType('hp','number');
	$form->setLabel('hp','Nomor Hp');

	$form->addInput('foto','file');
	$form->setLabel('foto','Foto Posko');
	$form->setAccept('foto','.jpg,.png,.jpeg');

	$form->addInput('kegiatan','textarea');
	if(empty($id))
	{
		$form->setValue('kegiatan',"-\n-");
	}
	$form->setLabel('kegiatan','kegiatan <span style="background: red;color:white;">(nyalakan capslock saat input kegiatan)</span>');
	$form->addInput('peralatan','textarea');
	if(empty($id))
	{
		$form->setValue('peralatan',"-\n-");
	}
	$form->setLabel('peralatan','peralatan / perlengkapan <span style="background: red;color:white;">(nyalakan capslock saat input peralatan)</span>');

	$form->setRequired('All');

	$form->form();
}
