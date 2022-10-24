<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_kesehatan_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('faskes_pkd','plaintext');
$form->setLabel('faskes_pkd','Jumlah Pos Kesehatan Desa');

$form->addInput('faskes_puskesmas','plaintext');
$form->setLabel('faskes_puskesmas','Jumlah Puskesmas');

$form->addInput('faskes_klinik','plaintext');
$form->setLabel('faskes_klinik','Jumlah Klinik');

$form->addInput('faskes_dokter_praktik','plaintext');
$form->setLabel('faskes_dokter_praktik','Jumlah Dokter Praktik');


$form->setDataTable();
$form->form();