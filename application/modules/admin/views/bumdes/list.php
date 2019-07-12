<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_bumdes())
{
	$form = new zea();

	$form->setTable('bumdes');
	$form->init('roll');

	$form->setNumbering(TRUE);

	$form->search();

	$form->addInput('id','link');
	$form->setLabel('id','detail');
	$form->setPlainText('id','detail');
	$form->setLink('id','detail','id');

	$form->addInput('nama','plaintext');
	$form->setLabel('nama','nama bumdes');

	$form->addInput('tgl_berdiri','plaintext');
	$form->setType('tgl_berdiri','date');
	$form->setlabel('tgl_berdiri','tanggal berdiri');

	$form->addInput('no_perdes','plaintext');
	$form->settype('no_perdes','number');
	$form->setLabel('no_perdes','Nomor Perdes');

	$form->addInput('no_perkades','plaintext');
	$form->settype('no_perkades','number');
	$form->setLabel('no_perkades','Nomor Perkades');

	$form->addInput('no_rek_bumdes','plaintext');
	$form->settype('no_rek_bumdes','number');
	$form->setLabel('no_rek_bumdes','Nomor Rekening Bumdes');

	$form->addInput('jangka_waktu','plaintext');
	$form->setlabel('jangka_waktu','jangka waktu');

	$form->addInput('jenis_usaha','plaintext');
	$form->setlabel('jenis_usaha','jenis usaha');

	$form->addInput('kategori_usaha','dropdown');
	$form->setAttribute('kategori_usaha','disabled');
	$form->setOptions('kategori_usaha',$kategori_usaha);
	$form->setlabel('kategori_usaha', 'KATEGORI USAHA');

	$form->addInput('tingkat_pemeringkatan','dropdown');
	$form->setAttribute('tingkat_pemeringkatan','disabled');
	$form->setOptions('tingkat_pemeringkatan',$tingkat_pemeringkatan);
	$form->setlabel('tingkat_pemeringkatan', 'TINGKAT PEMERINGKATAN');

	$form->setEdit(TRUE);
	$form->setDelete(TRUE);
	$form->setUrl('admin/bumdes/clear_list');

	$form->form();
}