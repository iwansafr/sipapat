<?php

$form = new Zea();
$form->init('roll');
$form->search();
$form->setTable('buku_tamu');
$form->addInput('id','plaintext');
$form->addInput('nama','plaintext');

$form->form();