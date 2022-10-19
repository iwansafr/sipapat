<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_ibadah_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('fasib_masjid','plaintext');
$form->setLabel('fasib_masjid','Jumlah Masjid');

$form->addInput('fasib_mushola','plaintext');
$form->setLabel('fasib_mushola','Jumlah Mushola');

$form->addInput('fasib_gereja','plaintext');
$form->setLabel('fasib_gereja','Jumlah Gereja');

$form->addInput('fasib_wihara','plaintext');
$form->setLabel('fasib_wihara','Jumlah Wihara');

$form->addInput('fasib_klenteng','plaintext');
$form->setLabel('fasib_klenteng','Jumlah Klenteng');


$form->setDataTable();
$form->form();