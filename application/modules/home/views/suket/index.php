<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');

$form->setTable('dilan_surat');

$form->addInput('keperluan','text');

$form->form();