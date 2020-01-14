<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($id))
{
	$form = new zea();

	$form->init('edit');
	$form->setTable('penduduk');
	$form->setId(@intval($id));

	$form->setEditStatus(false);

	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','desa');

	$form->addInput('no_kk','plaintext');
	$form->addInput('nik','plaintext');
	$form->setUnique(array('nik'),'{value} sudah terdaftar sbg {table}');
	$form->addInput('no_paspor','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('jk','dropdown');
	$form->setOptions('jk',['1'=>'LAKI-LAKI','2'=>'PEREMPUAN']);
	$form->setAttribute('jk','disabled');
	$form->addInput('tmpt_lhr','plaintext');
	$form->addInput('tgl_lhr','plaintext');
	$form->setType('tgl_lhr','date');
	$form->addInput('gdr','dropdown');
	$form->setLabel('gdr','golongan darah');
	$form->setOptions('gdr',$this->dilan_model->golongan_darah());
	$form->setAttribute('gdr','disabled');
	$form->addInput('agama','dropdown');
	$form->setOptions('agama',$this->dilan_model->agama());
	$form->setAttribute('agama','disabled');

	$form->addInput('agama_lainnya','plaintext');

	$form->addInput('status','dropdown');
	$form->setOptions('status', $this->dilan_model->status());
	$form->setAttribute('status','disabled');
	$form->addInput('no_akta_kwn','plaintext');
	$form->addInput('no_akta_crai','plaintext');
	$form->addInput('shdk','dropdown');
	$form->setOptions('shdk',$this->dilan_model->shdk());
	$form->setAttribute('shdk','disabled');
	$form->addInput('shdrt','plaintext');
	$form->addInput('pnydng_cct','dropdown');
	$form->setLabel('pnydng_cct','Penyandang Cacat');
	$form->setOptions('pnydng_cct',$this->dilan_model->cacat());
	$form->setAttribute('pnydng_cct','disabled');
	$form->addInput('pddk_akhir','dropdown');
	$form->setOptions('pddk_akhir',$this->dilan_model->pendidikan());
	$form->setAttribute('pddk_akhir','disabled');
	$form->addInput('pekerjaan','dropdown');
	$form->setOptions('pekerjaan', $this->dilan_model->pekerjaan());
	$form->setAttribute('pekerjaan','disabled');
	$form->addInput('nama_ibu','plaintext');
	$form->addInput('nama_ayah','plaintext');
	$form->addInput('nama_kep_kel','plaintext');
	$form->addInput('alamat','plaintext');
	$form->addInput('no_rt','plaintext');
	$form->addInput('no_rw','plaintext');
	$form->setSave(false);
	$form->form();
}