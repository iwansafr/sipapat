<?php
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/admin_pendidikan_statistik').'"><i class="fa fa-chart-pie"></i> Statistik</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('tidak_belum_sekolah','plaintext');
$form->setLabel('tidak_belum_sekolah','Jumlah Warga Tidak / Belum Sekolah');

$form->addInput('tidak_tamat_sd','plaintext');
$form->setLabel('tidak_tamat_sd','Jumlah Warga Tidak Tamat SD');

$form->addInput('tamat_sd','plaintext');
$form->setLabel('tamat_sd','Jumlah Warga Tamat / Lulus SD');

$form->addInput('sltp','plaintext');
$form->setLabel('sltp','Jumlah Warga Tamat / Lulus SLTP');

$form->addInput('slta','plaintext');
$form->setLabel('slta','Jumlah Warga Tamat / Lulus SLTA');

$form->addInput('d1_d2','plaintext');
$form->setLabel('d1_d2','Jumlah Warga Tamat / Lulus D1 - D2');

$form->addInput('d3','plaintext');
$form->setLabel('d3','Jumlah Warga Tamat / Lulus D3 / Sarjana Muda');

$form->addInput('s1','plaintext');
$form->setLabel('s1','Jumlah Warga Sarjana');

$form->addInput('s2','plaintext');
$form->setLabel('s2','Jumlah Warga Pasca Sarjana');

$form->addInput('s3','plaintext');
$form->setLabel('s3','Jumlah Warga Dengan Gelar S3 / Doktor');

$form->setDataTable();
$form->form();