<?php defined('BASEPATH') OR exit('No direct script access allowed');

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