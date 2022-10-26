<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_lingkungan_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('fasling_tpa','plaintext');
$form->setLabel('fasling_tpa','Jumlah BANK SAMPAH/TPA');

$form->addInput('fasling_makam','plaintext');
$form->setLabel('fasling_makam','Jumlah Makam');

$form->addInput('fasling_lap_or','plaintext');
$form->setLabel('fasling_lap_or','Jumlah Lapangan Olah Raga');

$form->addInput('fasling_pamsimas','plaintext');
$form->setLabel('fasling_pamsimas','Jumlah Pamsimas');


$form->setDataTable();
$form->form();