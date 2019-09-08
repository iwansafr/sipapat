<?php defined('BASEPATH') OR exit('No direct script access allowed');
pr($penduduk);
$form = new zea();

$form->init('edit');
$form->setTable('dilan_surat');

$form->form();