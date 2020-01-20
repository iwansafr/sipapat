<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');
$form->setTable('notification');

$form->setId($id);
$form->setEditStatus(false);
$form->addInput('title','plaintext');
$form->addInput('link','plaintext');
$form->setLabel('link','Klik Untuk Buka');
$form->setPlaintext('link','<a href="{link}">Lihat {title}</a>');

$form->setSave(false);
$form->form();
