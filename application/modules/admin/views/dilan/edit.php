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
	if(is_kecamatan())
	{
		$district_id = $this->indonesia_model->get_district_id();
		$form->addInput('desa_id','dropdown');
		$form->tableOptions('desa_id','desa','id','nama','district_id = '.$district_id);
	}else{
		$form->addInput('desa_id','dropdown');
		$form->tableOptions('desa_id','desa','id','nama');
	}
	$form->setLabel('desa_id','desa');
}

$form->addInput('no_kk','text');
$form->addInput('nik','text');
$form->setUnique(array('nik'),'{value} sudah terdaftar sbg {table}');
$form->addInput('no_paspor','text');
$form->addInput('nama','text');
$form->addInput('jk','dropdown');
$form->setOptions('jk',['1'=>'LAKI-LAKI','2'=>'PEREMPUAN']);
$form->addInput('tmpt_lhr','text');
$form->addInput('tgl_lhr','text');
$form->setType('tgl_lhr','date');
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
$form->addInput('shdk','dropdown');
$form->setOptions('shdk',$this->dilan_model->shdk());
$form->addInput('shdrt','text');
$form->addInput('pnydng_cct','dropdown');
$form->setLabel('pnydng_cct','Penyandang Cacat');
$form->setOptions('pnydng_cct',$this->dilan_model->cacat());
$form->addInput('pddk_akhir','dropdown');
$form->setOptions('pddk_akhir',$this->dilan_model->pendidikan());
$form->addInput('pekerjaan','dropdown');
$form->setOptions('pekerjaan', $this->dilan_model->pekerjaan());
$form->addInput('nama_ibu','text');
$form->addInput('nama_ayah','text');
$form->addInput('nama_kep_kel','text');
$form->addInput('alamat','text');
$form->addInput('no_rt','text');
$form->addInput('no_rw','text');
$form->form();