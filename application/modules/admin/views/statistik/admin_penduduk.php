<?php
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/admin_penduduk_statistik').'"><i class="fa fa-chart-pie"></i> Statistik</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('laki_laki','plaintext');
$form->setLabel('laki_laki','Jumlah Warga Laki-laki');

$form->addInput('perempuan','plaintext');
$form->setLabel('perempuan','Jumlah Warga Perempuan');

$form->addInput('kepala_keluarga_laki_laki','plaintext');
$form->setLabel('kepala_keluarga_laki_laki','Jumlah Kepala Keluarga Laki-laki');

$form->addInput('kepala_keluarga_perempuan','plaintext');
$form->setLabel('kepala_keluarga_perempuan','Jumlah Kepala Keluarga Perempuan');

$form->addInput('kepala_keluarga','plaintext');
$form->setLabel('kepala_keluarga','Jumlah Total Kepala Keluarga');

$form->setDataTable();
$form->form();