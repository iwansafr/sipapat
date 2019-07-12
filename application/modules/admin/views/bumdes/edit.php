<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_bumdes())
{
	$form = new zea();

	$form->setTable('bumdes');
	$form->init('edit');

	$form->setId(@intval($_GET['id']));
	$form->addInput('nama','text');
	$form->setLabel('nama','nama bumdes');

	$form->addInput('user_id','static');
	$form->setValue('user_id', @intval($user['id']));

	$form->addInput('tgl_berdiri','text');
	$form->setType('tgl_berdiri','date');
	$form->setlabel('tgl_berdiri','tanggal berdiri');

	$form->addInput('no_perdes','text');
	$form->settype('no_perdes','number');
	$form->setLabel('no_perdes','Nomor Perdes');

	$form->addInput('no_perkades','text');
	$form->settype('no_perkades','number');
	$form->setLabel('no_perkades','Nomor Perkades');

	$form->addInput('no_rek_bumdes','text');
	$form->settype('no_rek_bumdes','number');
	$form->setLabel('no_rek_bumdes','Nomor Rekening Bumdes');

	$form->addInput('jangka_waktu','text');
	$form->setlabel('jangka_waktu','jangka waktu');

	$form->addInput('alamat','textarea');
	$form->setHelp('alamat','alamat email tetap ditulis kapital');
	if(empty($id))
	{
		$form->setValue('alamat', "JALAN : -\nDESA : -\nKODE POS: -\nTELEPON : -\nEMAIL : -");
	}

	$form->addInput('pengurus','textarea');
	$form->setHelp('pengurus','kolom yang kurang bisa ditambah sendiri');
	if(empty($id))
	{
		$form->setValue('pengurus', "KETUA : -\nNO HP KETUA : -\nSEKRETARIS : -\nNO HP SEKRETARIS : -\nBENDAHARA : -\nNO HP BENDAHARA : -");
	}

	$form->addInput('pengawas','textarea');
	$form->setHelp('pengawas','kolom yang kurang bisa ditambah sendiri');
	if(empty($id))
	{
		$form->setValue('pengawas', "KETUA : -\nANGGOTA 1 : -\nANGGOTA 2 : -");
	}

	$form->addInput('jenis_usaha','textarea');
	$form->setAttribute('jenis_usaha',['placeholder'=>'deskripsi singkat dari jenis usaha']);
	$form->setlabel('jenis_usaha','jenis usaha');

	$form->addInput('kategori_usaha','dropdown');
	$form->setOptions('kategori_usaha',$kategori_usaha);
	$form->setlabel('kategori_usaha', 'KATEGORI USAHA');

	$form->addInput('tingkat_pemeringkatan','dropdown');
	$form->setOptions('tingkat_pemeringkatan',$tingkat_pemeringkatan);
	$form->setlabel('tingkat_pemeringkatan', 'TINGKAT PEMERINGKATAN');

	$form->form();
}