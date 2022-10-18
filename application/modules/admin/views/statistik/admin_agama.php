<?php
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/admin_agama_statistik').'"><i class="fa fa-chart-pie"></i> Statistik</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('islam','plaintext');
$form->setLabel('islam','Jumlah Warga Beragama Islam');

$form->addInput('kristen','plaintext');
$form->setLabel('kristen','Jumlah Warga Beragama Kristen');

$form->addInput('katholik','plaintext');
$form->setLabel('katholik','Jumlah Warga Beragama Katholik');

$form->addInput('hindu','plaintext');
$form->setLabel('hindu','Jumlah Warga Beragama Hindu');

$form->addInput('budha','plaintext');
$form->setLabel('budha','Jumlah Warga Beragama Budha');

$form->addInput('khonghucu','plaintext');
$form->setLabel('khonghucu','Jumlah Warga Beragama Khong Hucu');

$form->addInput('penghayat_kepercayaan','plaintext');
$form->setLabel('penghayat_kepercayaan','Jumlah Warga Penghayat Kepercayaan');

$form->setDataTable();
$form->form();