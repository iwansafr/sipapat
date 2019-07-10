<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('bumdes');
$form->init('edit');


$form->addInput('nama','text');

$form->form();