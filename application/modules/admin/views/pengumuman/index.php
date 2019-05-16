<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_admin())
{
	$form  = new zea();

	$form->init('param');
	$form->setTable('config');
	$form->setParamName('pengumuman');
	$form->setHeading('Atur Pengumuman');
	for($i=1;$i<4;$i++)
	{
		$form->addInput('judul'.$i, 'text');
		$form->addInput('pengumuman'.$i,'textarea');
		$form->setAttribute('pengumuman'.$i,['class'=>'form-control summernote']);
	}
	$form->addInput('background_image','image');
	$form->form();
}else if(is_kecamatan()){
	$form  = new zea();

	$form->init('param');
	$form->setTable('pengumuman');
	$form->setParamName($user['username']);
	$form->setHeading('Atur Pengumuman');
	$form->addInput('judul', 'text');
	$form->addInput('pengumuman','textarea');
	$form->setAttribute('pengumuman',['class'=>'form-control summernote']);
	$form->form();
}else{
	msg('Maaf, Anda tidak punya akses ke halaman ini','danger');
}