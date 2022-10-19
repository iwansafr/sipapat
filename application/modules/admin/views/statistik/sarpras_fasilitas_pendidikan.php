<?php
$this->load->view('admin/statistik/menu');
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/sarpras_fasilitas_pendidikan_statistik').'"><i class="fa fa-chart-pie"></i> Fasilitas</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('faspen_tk','plaintext');
$form->setLabel('faspen_tk','Jumlah TK/PAUD/RA');

$form->addInput('faspen_sd','plaintext');
$form->setLabel('faspen_sd','Jumlah SD/MI');

$form->addInput('faspen_sltp','plaintext');
$form->setLabel('faspen_sltp','Jumlah SLTP/SMP/MTS');

$form->addInput('faspen_slta','plaintext');
$form->setLabel('faspen_slta','Jumlah SLTA');

$form->addInput('faspen_pesantren','plaintext');
$form->setLabel('faspen_pesantren','Jumlah Pondok Pesantren');

$form->addInput('faspen_perguruan_tinggi','plaintext');
$form->setLabel('faspen_perguruan_tinggi','Jumlah Perguruan Tinggi');

$form->setDataTable();
$form->form();