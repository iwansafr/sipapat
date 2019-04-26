<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form  = new zea();

$form->init('param');
$form->setTable('config');
$form->setParamName('pengumuman');
$form->setHeading('Atur Pengumuman');
$form->addInput('judul', 'text');
$form->addInput('pengumuman','textarea');
$form->setAttribute('pengumuman',['id'=>'summernote']);
$form->form();