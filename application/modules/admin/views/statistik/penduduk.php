<?php

$pengguna = $this->pengguna_model->get_pengguna();

if(is_desa())
{
    $form = new Zea();
    $form->init('edit');
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('laki_laki','text');
    $form->setType('laki_laki','number');
    $form->setLabel('laki_laki','Jumlah Warga Laki-laki');
    
    $form->form();
}