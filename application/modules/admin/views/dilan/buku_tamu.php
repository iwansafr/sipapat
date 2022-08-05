<?php

$form = new Zea();
$form->init('roll');
$form->setTable('buku_tamu');
$form->addInput('id','hidden');
$form->setNumbering(true);
$form->addInput('nama','link');
$form->setLink('nama',base_url('admin/dilan/buku_tamu_detail/'),'id');
$form->addInput('keperluan','dropdown');
$form->setOptions('keperluan',$this->bukutamu->keperluan());
$form->setAttribute('keperluan','disabled');
$form->addInput('perangkat_desa_id','dropdown');
$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama');
$form->setLabel('perangkat_desa_id','Petugas');
$form->setAttribute('perangkat_desa_id','disabled');
$form->addInput('created_at','plaintext');
$form->setLabel('created_at','Waktu');
$form->setDelete(true);

$form->form();