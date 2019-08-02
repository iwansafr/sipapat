<?php defined('BASEPATH') OR exit('No direct script access allowed');

	$form = new zea();
	$form->setTable('bumdes_pengurus');
	$form->init('edit');

	// $bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
	$form->addInput('bumdes_id','static');
	$form->setValue('bumdes_id', @intval($bumdes_id));

	$form->addInput('ketua','text');
	$form->addInput('hp_ketua','text');
	$form->setLabel('hp_ketua','No Hp Ketua');

	$form->addInput('sekretaris','text');
	$form->addInput('hp_sekretaris','text');
	$form->setLabel('hp_sekretaris','No Hp sekretaris');

	$form->addInput('bendahara','text');
	$form->addInput('hp_bendahara','text');
	$form->setLabel('hp_bendahara','No Hp bendahara');

	$form->addInput('penasehat','text');

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

	$form->addInput('tahun','text');
	$form->setType('tahun','number');

	$form->setRequired('All');
	$form->form();