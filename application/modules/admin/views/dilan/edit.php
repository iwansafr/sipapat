<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');
$form->setTable('penduduk');

$form->setId(@intval($_GET['id']));

if(is_desa())
{
	$form->addInput('desa_id','static');
	$form->setValue('desa_id', $desa['id']);
}else{
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
}

$form->addInput('no_kk','text');
$form->addInput('nik','text');
$form->addInput('no_paspor','text');
$form->addInput('nama','text');
$form->addInput('jk','dropdown');
$form->setOptions('jk',['L'=>'LAKI-LAKI','P'=>'PEREMPUAN']);
$form->addInput('tmpt_lhr','text');
$form->addInput('tgl_lhr','text');
$form->addInput('gdr','dropdown');
$form->setLabel('gdr','golongan darah');
$form->setOptions('gdr',$this->dilan_model->golongan_darah());
$form->addInput('agama','dropdown');
$form->setOptions('agama',$this->dilan_model->agama());

$form->addInput('agama_lainnya','text');
$form->setLabel('agama_lainnya','sebutkan (jika anda memilih penghayat kepercayaan atau lainnya)*');

$form->startCollapse('agama','agama');
$form->endCollapse('agama_lainnya');
$form->setCollapse('agama',TRUE);

$form->addInput('status','dropdown');
$form->setOptions('status', $this->dilan_model->status());
$form->addInput('no_akta_kwn','text');
$form->addInput('no_akta_crai','text');
$form->addInput('shdk','text');
$form->addInput('shdrt','text');
$form->addInput('pnydng_cct','text');
$form->addInput('pddk_akhir','text');
$form->addInput('pekerjaan','text');
$form->addInput('nama_ibu','text');
$form->addInput('nama_ayah','text');
$form->addInput('nama_kep_kel','text');
$form->addInput('alamat','text');
$form->addInput('no_rt','text');
$form->addInput('no_rw','text');
$form->form();