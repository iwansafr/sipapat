<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa() || is_root())
{
	$desa_id = 0;
	if(!empty($user['pengguna']['desa_id']))
	{
		$desa_id = $user['pengguna']['desa_id'];
	}

	$form = new zea();
	$form->init('edit');
	$form->setTable('corona');

	$form->setId(@intval($_GET['id']));

	$form->addInput('nik','text');
	$form->setType('nik','number');
	$form->setUnique(['nik'],'{value} sudah terdata sebelumnya');
	
	$form->addInput('nama','text');
	$form->addInput('rt','text');
	$form->setType('rt','number');
	$form->addInput('rw','text');
	$form->setType('rw','number');
	$form->addInput('umur','text');
	$form->setType('umur','number');
	$form->addInput('jk','dropdown');
	$form->setLabel('jk','Jenis Kelamin');
	$form->setOptions('jk',['1'=>'Laki-laki','2'=>'Perempuan']);
	$form->addInput('hp','text');
	$form->setLabel('hp','No Handphone');
	$form->setType('hp','number');

	
	if(!empty($desa_id))
	{
		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$desa_id);
	}else{
		$form->addInput('desa_id','dropdown');
		$form->setLabel('desa_id','desa');
		$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);
	}
	// $form->setAttribute('desa_id','disabled');

	$form->addInput('dari','text');
	$form->setLabel('dari','Dari Negara / Daerah');
	$form->addInput('tgl','text');
	$form->setLabel('tgl','Tgl Kedatangan');
	$form->setType('tgl','date');
	$form->startCollapse('dari','riwayat perjalanan');
	$form->endCollapse('tgl');
	$form->setCollapse('dari');


	$form->addInput('demam','dropdown');
	$form->setOptions('demam',['Tidak','Iya']);
	$form->setLabel('demam','Apakah mengalami demam ?');

	$form->addInput('bpst','dropdown');
	$form->setOptions('bpst',['Tidak','Iya']);
	$form->setLabel('bpst','Apakah Batuk,Pilek, Sakit Tenggorokan ?');

	$form->addInput('sesak_nafas','dropdown');
	$form->setOptions('sesak_nafas',['Tidak','Iya']);
	$form->setLabel('sesak_nafas','Apakah mengalami sesak nafas ?');

	$form->addInput('no_keluhan','dropdown');
	$form->setOptions('no_keluhan',['1'=>'Iya','0'=>'Tidak']);
	$form->setLabel('no_keluhan','tidak ada keluhan');

	$form->addInput('pkdpc','dropdown');
	$form->setOptions('pkdpc',['Tidak','Iya']);
	$form->setLabel('pkdpc','Pernah Kontak dg Penderita Covid19 ?');

	$form->startCollapse('demam','Kondisi Saat Ini');
	$form->endCollapse('pkdpc');
	$form->setCollapse('demam');

	$form->addInput('tatalaksana','textarea');
	$form->setLabel('tatalaksana','Tatalaksana yg dilakukan');

	$form->addInput('keterangan','textarea');
	$form->setLabel('keterangan','keterangan (alasan penyebab mudik / pulang)');

	$form->addInput('status','static');
	$form->setValue('status',1);
	$form->setRequired('All');

	$form->form();
}