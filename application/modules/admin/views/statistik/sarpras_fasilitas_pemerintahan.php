<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_pemerintahan_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('faspem_kantor_desa','plaintext');
$form->setLabel('faspem_kantor_desa','Jumlah Kantor Desa');

$form->addInput('faspem_balai_desa','plaintext');
$form->setLabel('faspem_balai_desa','Jumlah Balai Desa');

$form->addInput('faspem_perpus_desa','plaintext');
$form->setLabel('faspem_perpus_desa','Jumlah Perpustakaan Desa');


$form->setDataTable();
$form->form();