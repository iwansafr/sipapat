<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_kecamatan())
{
	$form = new zea();
	$form->setTable('posyantekdes');

	$form->init('edit');
	$form->addInput('nama','plaintext');
	$form->setLabel('nama','nama posyantekdes');

	$form->setId($id);

	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setLabel('desa_id','desa');
	$form->setAttribute('desa_id','disabled');

	$form->addInput('user_id','dropdown');
	$form->tableOptions('user_id','user','id','username');
	$form->setLabel('user_id','penginput');
	$form->setAttribute('user_id','disabled');

	$form->addInput('tgl_pendirian','plaintext');
	$form->setLabel('tgl_pendirian','tgl pendirian');
	$form->setType('tgl_pendirian','date');
	$form->addInput('no_permakades','plaintext');
	$form->setLabel('no_permakades','nomor permakades');
	$form->addInput('no_bdn_hkm','plaintext');
	$form->setLabel('no_bdn_hkm','nomor badan hukum');
	$form->addInput('masa_berlaku','plaintext');
	$form->setLabel('masa_berlaku','masa berlaku');
	$form->addInput('alamat','plaintext');
	$form->setLabel('alamat','alamat');
	$form->addInput('pengurus','plaintext');
	$form->setLabel('pengurus','pengurus');

	$form->setHelp('pengurus','nyalakan capslock saat mengetik');
	$form->addInput('jns_kegiatan','plaintext');
	$form->setLabel('jns_kegiatan','jenis kegiatan');
	$form->addInput('TTG','plaintext');
	$form->setLabel('TTG','TTG yg dihasilkan');
	$form->setSave(false);
	$form->form();

}
