<?php

$form = new zea();

$form->init('roll');
$form->setTable('apbdes');
$form->setNumbering();
$form->search();
$form->join('desa','on(desa.id=apbdes.desa_id)','apbdes.id,apbdes.infografi,apbdes.nominal,desa.nama,apbdes.tahun');
$form->addInput('id','hidden');
$form->addInput('tahun','plaintext');
$form->setType('tahun','number');

$form->addInput('nama','plaintext');

$form->addInput('infografi','thumbnail');

$form->addInput('nominal','plaintext');
$form->settype('nominal','number');
$form->setEdit(true);
$form->setDelete(true);
$form->setUrl('admin/apbdes/clear_list');

$form->form();