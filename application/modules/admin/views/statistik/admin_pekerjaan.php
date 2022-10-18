<?php
$form = new Zea();
$form->setHeading('<a class="btn btn-sm btn-info" href="'.base_url('admin/statistik/admin_pekerjaan_statistik').'"><i class="fa fa-chart-pie"></i> Statistik</a>');
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('asn','plaintext');
$form->setLabel('asn','Jumlah ASN');

$form->addInput('tni','plaintext');
$form->setLabel('tni','Jumlah TNI');

$form->addInput('polri','plaintext');
$form->setLabel('polri','Jumlah POLRI');

$form->addInput('karyawan_swasta','plaintext');
$form->setLabel('karyawan_swasta','Jumlah Karyawan Swasta');

$form->addInput('karyawan_bumn','plaintext');
$form->setLabel('karyawan_bumn','Jumlah Karyawan BUMN/BUMN');

$form->addInput('petani','plaintext');
$form->setLabel('petani','Jumlah Petani');

$form->addInput('buruh_tani','plaintext');
$form->setLabel('buruh_tani','Jumlah Buruh Tani');

$form->addInput('nelayan','plaintext');
$form->setLabel('nelayan','Jumlah Nelayan');

$form->addInput('wiraswasta','plaintext');
$form->setLabel('wiraswasta','Jumlah Wiraswasta');

$form->addInput('ibu_rumah_tangga','plaintext');
$form->setLabel('ibu_rumah_tangga','Jumlah Ibu Rumah Tangga');

$form->addInput('belum_bekerja','plaintext');
$form->setLabel('belum_bekerja','Jumlah Belum Bekerja');

$form->addInput('pekerjaan_lainnya','plaintext');
$form->setLabel('pekerjaan_lainnya','Jumlah Pekerja Lainnya');

$form->setDataTable();
$form->form();