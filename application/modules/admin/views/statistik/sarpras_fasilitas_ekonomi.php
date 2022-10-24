<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_ekonomi_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('fasek_pasar_desa','plaintext');
$form->setLabel('fasek_pasar_desa','Jumlah Pasar Desa');

$form->addInput('fasek_toko','plaintext');
$form->setLabel('fasek_toko','Jumlah Toko');

$form->addInput('fasek_swalayan','plaintext');
$form->setLabel('fasek_swalayan','Jumlah Swalayan');

$form->addInput('fasek_restoran','plaintext');
$form->setLabel('fasek_restoran','Jumlah Restoran');

$form->addInput('fasek_rumah_makan','plaintext');
$form->setLabel('fasek_rumah_makan','Jumlah Rumah Makan');

$form->addInput('fasek_warung_makan','plaintext');
$form->setLabel('fasek_warung_makan','Jumlah Warung Makan');

$form->setDataTable();
$form->form();