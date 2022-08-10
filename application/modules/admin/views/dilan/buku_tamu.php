<?php

$pengguna = $this->pengguna_model->get_pengguna();
$form = new Zea();
$form->init('roll');
$form->setTable('buku_tamu');
if(is_desa()){
    $form->setWhere('desa_id = '.$pengguna['desa_id']);
}
$form->addInput('id','hidden');
$form->setNumbering(true);
$form->addInput('nama','link');
$form->setLink('nama',base_url('admin/dilan/buku_tamu_detail/'),'id');
$form->addInput('keperluan','dropdown');
$form->setOptions('keperluan',$this->buku_tamu_model->keperluan());
$form->setAttribute('keperluan','disabled');
$form->addInput('perangkat_desa_id','dropdown');
$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama');
$form->setLabel('perangkat_desa_id','Petugas');
$form->setAttribute('perangkat_desa_id','disabled');
$form->addInput('created_at','plaintext');
$form->setLabel('created_at','Waktu');
$form->setUrl('admin/dilan/buku_tamu_list');
$form->setDelete(true);

$form->form();