<?php defined('BASEPATH') OR exit('No direct script access allowed');


	if(empty($bumdes_id)){
		msg('anda belum memiliki bumdes, silahkan mengisi data bumdes terlebih dahulu <a class="btn btn-sm btn-primary" href="'.base_url('admin/bumdes/edit').'">di sini</a>','danger');
		die();
	}
	$form = new zea();
	$form->setTable('bumdes_pengurus');
	$form->init('roll');

	$form->setNumbering(TRUE);

	$form->search();

	if(is_desa())
	{
		$form->setWhere('bumdes_id = '.@intval($bumdes_id));
	}

	$form->addInput('id','hidden');
	
	$form->setHeading('<a href="'.base_url('admin/bumdes/pengurus_edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');

	$form->addInput('bumdes_id','dropdown');
	$form->tableOptions('bumdes_id','bumdes','id','nama');
	$form->setAttribute('bumdes_id','disabled');
	$form->setLabel('bumdes_id','nama bumdes');

	$form->addInput('ketua','plaintext');
	$form->setLabel('hp_ketua','No Hp Ketua');

	$form->addInput('sekretaris','plaintext');
	$form->setLabel('hp_sekretaris','No Hp sekretaris');

	$form->addInput('bendahara','plaintext');
	$form->setLabel('hp_bendahara','No Hp bendahara');

	$form->addInput('penasehat','plaintext');

	$form->addInput('jenis_usaha','plaintext');
	$form->setAttribute('jenis_usaha',['placeholder'=>'deskripsi singkat dari jenis usaha']);
	$form->setlabel('jenis_usaha','jenis usaha');

	$form->addInput('kategori_usaha','dropdown');
	$form->setAttribute('kategori_usaha','disabled');
	$form->setOptions('kategori_usaha',$kategori_usaha);
	$form->setlabel('kategori_usaha', 'KATEGORI USAHA');

	$form->addInput('tingkat_pemeringkatan','dropdown');
	$form->setAttribute('tingkat_pemeringkatan','disabled');
	$form->setOptions('tingkat_pemeringkatan',$tingkat_pemeringkatan);
	$form->setlabel('tingkat_pemeringkatan', 'TINGKAT PEMERINGKATAN');

	$form->addInput('tahun','plaintext');
	$form->setType('tahun','number');

	$form->setUrl('admin/bumdes/pengurus_list');

	$form->setDelete(true);
	$form->setEdit(true);
	$form->setEditLink(base_url('admin/bumdes/pengurus_edit/?id='));

	$form->form();