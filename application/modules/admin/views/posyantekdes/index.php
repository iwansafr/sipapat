<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->setTable('posyantekdes');

$form->init('roll');

$form->search();
$form->setNumbering(true);


if(is_desa())
{
	if(!empty($pengguna))
	{
		$form->setWhere('desa_id = '.@intval($pengguna['desa_id']));
	}
}

$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detal');
$form->setLink('id',base_url('admin/posyantekdes/detail'),'id');

$form->addInput('nama','plaintext');
$form->setLabel('nama','nama posyantekdes');

$form->addInput('user_id','dropdown');
$form->tableOptions('user_id','user','id','username');
$form->setLabel('user_id','penginput');
$form->setAttribute('user_id','disabled');

$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','nama desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('tgl_pendirian','plaintext');
$form->setLabel('tgl_pendirian','tgl pendirian');
$form->setType('tgl_pendirian','date');
$form->addInput('no_permakades','plaintext');
$form->setLabel('no_permakades','nomor permakades');
$form->addInput('no_bdn_hkm','plaintext');
$form->setLabel('no_bdn_hkm','nomor badan hukum');
$form->addInput('masa_berlaku','plaintext');
$form->setLabel('masa_berlaku','masa berlaku');
$form->addInput('jns_kegiatan','plaintext');
$form->setLabel('jns_kegiatan','jenis kegiatan');
$form->addInput('TTG','plaintext');
$form->setLabel('TTG','TTG yg dihasilkan');

if(is_desa() || is_root())
{
	$form->setDelete(true);
	$form->setEdit(true);
}
$form->setEditLink(base_url('admin/posyantekdes/edit?id='));
$form->setUrl('admin/posyantekdes/clear_list');
$form->setDataTable(true);

$form->form();
