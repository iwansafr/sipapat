<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');
$form->setTable('anggaran');

$form->search();
$form->setHeading('Perencaan Anggaran Tahun');
$form->setEditStatus(FALSE);
$form->setId(@intval($_GET['id']));
$form->setNumbering(TRUE);
$form->addInput('title','text');
$form->setLabel('title','Judul');
$form->addInput('type','radio');
$form->setLabel('type','Jenis pembangunan');
$form->setRadio('type',['Non Fisik','Fisik']);
$form->setEdit(TRUE);
$form->setDelete(TRUE);
$form->setRequired('All');
$form->form();