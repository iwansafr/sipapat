<?php defined('BASEPATH') OR exit('No direct script access allowed');$form = new zea();

$form->init('roll');

$form->setTable('dilan_surat_pengajuan');
$form->join('penduduk','ON(dilan_surat_pengajuan.penduduk_id=penduduk.id)','dilan_surat_pengajuan.id,dilan_surat_pengajuan.hp,dilan_surat_pengajuan.email,dilan_surat_pengajuan.keterangan,dilan_surat_pengajuan.dilan_surat_ket_id,penduduk.nik,penduduk.nama,penduduk.nama_ibu');

$form->setNumbering(true);

$form->setEditStatus(false);
$form->setHeading('pengajuan Suket');
$form->addInput('id','plaintext');
$form->setLabel('id','action');
$form->setPlainText('id',[base_url('admin/dilan/surat_pengajuan/{id}')=>'Detail']);
$form->addInput('nama','plaintext');
$form->addInput('dilan_surat_ket_id','dropdown');
$form->setLabel('dilan_surat_ket_id','keperluan');
$form->setAttribute('dilan_surat_ket_id','disabled');
$form->tableOptions('dilan_surat_ket_id','dilan_surat_ket','id','title');

$form->addInput('keterangan','plaintext');
$form->addInput('email','plaintext');
$form->addInput('hp','plaintext');

$form->setUrl('admin/dilan/surat_pengajuan_clear');

$form->setDelete(true);
$form->form();