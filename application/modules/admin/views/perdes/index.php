<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->setTable('perdes');
$form->search();
$form->init('roll');
$form->addInput('id','hidden');
$form->setNumbering(TRUE);
$form->addInput('item','dropdown');
$form->setOptions('item',$perdes_options);
$form->setAttribute('item','disabled');
$form->addInput('no','plaintext');
$form->setLabel('no','Nomor');
$form->addInput('tgl_penetapan','plaintext');
$form->addInput('tgl_pelaksanaan','plaintext');
$form->addInput('progress','dropdown');
$form->setOptions('progress',$perdes_progress);
$form->setAttribute('progress','disabled');

$form->setUrl('admin/perdes/clear_list');
$form->form();