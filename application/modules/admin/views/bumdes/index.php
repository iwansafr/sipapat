<?php defined('BASEPATH') OR exit('No direct script access allowed');
$form = new zea();

$form->setTable('bumdes');
$form->init('roll');
if(is_desa() || is_root() || is_bumdes())
{
	$form->setHeading('<a href="'.base_url('admin/bumdes/edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');
}

$form->join('desa','ON(desa.id=bumdes.desa_id)','desa.nama AS nama_desa,desa.kecamatan, bumdes.id,bumdes.nama,bumdes.tgl_berdiri,bumdes.no_perdes,bumdes.no_perkades,bumdes.no_rek_bumdes,bumdes.jangka_waktu');

if(is_desa() || is_bumdes())
{
	$form->setWhere('desa_id = '.$pengguna['desa_id']);
}
$form->order_by('bumdes.id','DESC');

$form->search();
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlaintext('id','<i class="fa fa-eye"></i> Detail');
$form->setLink('id',base_url('admin/bumdes/detail/'),'id');
$form->setNumbering(true);

$form->addInput('nama','plaintext');
$form->setLabel('nama','nama bumdes');

// $form->setId(@intval($_GET['id']));
// $form->addInput('desa_id','dropdown');
// $form->tableOptions('desa_id','desa','id','nama');
// $form->setLabel('desa_id','Desa');
// $form->setAttribute('desa_id','disabled');

$form->addInput('nama_desa','plaintext');
$form->setLabel('nama_desa','nama desa');

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

if(is_desa() || is_root() || is_bumdes())
{
	$form->setEdit(TRUE);
	$form->setDelete(TRUE);
}
$form->setEditLink(base_url('admin/bumdes/edit?id='));

$form->setUrl('admin/bumdes/clear_list');

$form->form();