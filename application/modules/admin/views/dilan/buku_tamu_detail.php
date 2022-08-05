<?php
$form = new Zea();
$form->init('edit');
$form->setHeading('Detail Buku Tamu');
$form->setEditStatus(false);
$form->setTable('buku_tamu');
$form->setId(@intval($_GET['id']));
$form->addInput('nama','plaintext');
$form->addInput('hp','plaintext');
$form->addInput('jk','dropdown');
$form->setOptions('jk',['1'=>'Laki-laki','2'=>'Perempuan']);
$form->setAttribute('jk','disabled');
$form->setLabel('jk','Jenis Kelamin');
$form->addInput('alamat','plaintext');
$form->addInput('asal_instansi','plaintext');
$form->setLabel('asal_instansi','Asal Instansi');
$form->addInput('perangkat_desa_id','dropdown');
$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama');
$form->setLabel('perangkat_desa_id','Bertemu Dengan');
$form->setAttribute('perangkat_desa_id','disabled');
$form->addInput('keperluan','dropdown');
$form->setOptions('keperluan',$this->bukutamu->keperluan());
$form->setAttribute('keperluan','disabled');

$form->setSave(false);
$form->form();
echo '<a href="'.base_url('admin/dilan/buku_tamu').'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>';
