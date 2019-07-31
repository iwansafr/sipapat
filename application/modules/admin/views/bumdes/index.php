<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_desa() || is_root())
{
	$form = new zea();

	$form->setTable('bumdes');
	$form->init('roll');

	$form->setHeading('<a href="'.base_url('admin/bumdes/edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');

	if(is_desa())
	{
		$form->setWhere('desa_id = '.$pengguna['desa_id']);
	}

	$form->addInput('id','link');
	$form->setLabel('id','detail');
	$form->setPlaintext('id','<i class="fa fa-eye"></i> Detail');
	$form->setLink('id',base_url('admin/bumdes/detail/'),'id');
	$form->setNumbering(true);

	$form->addInput('nama','plaintext');
	$form->setLabel('nama','nama bumdes');

	$form->setId(@intval($_GET['id']));
	$form->addInput('desa_id','dropdown');
	$form->setOptions('desa_id',['0'=>'None']);
	$form->setLabel('desa_id','Desa');
	$form->setAttribute('desa_id','disabled');

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

		$form->setEdit(TRUE);
	$form->setDelete(TRUE);

	$form->setUrl('admin/bumdes/clear_list');

	$form->form();
}