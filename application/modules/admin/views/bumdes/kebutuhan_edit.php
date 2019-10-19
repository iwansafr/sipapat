<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->init('edit');
$form->setTable('bumdes_kebutuhan');
$form->setHeading('kebutuhan bumdes');

$form->setId($this->input->get('id'));

if(is_desa() || is_bumdes())
{
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$this->sipapat_model->get_desa_id());
}else{
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setLabel('desa_id','desa');
}

$form->addInput('item','text');

$form->addInput('length','text');
$form->setType('length','number');
$form->setAttribute('length',['placeholder'=>'Centimeter']);
$form->setLabel('length','panjang');

$form->addInput('width','text');
$form->setType('width','number');
$form->setAttribute('width',['placeholder'=>'Centimeter']);
$form->setLabel('width','lebar');

$form->addInput('height','text');
$form->setType('height','number');
$form->setAttribute('height',['placeholder'=>'Centimeter']);
$form->setLabel('height','tinggi');

$form->startCollapse('length','volume');
$form->endCollapse('height');
$form->setCollapse('length',TRUE);

$form->addInput('weight','text');
$form->setType('weight','number');
$form->setAttribute('weight',['placeholder'=>'Kilogram']);
$form->setLabel('weight','berat');


$form->addInput('period_start','text');
$form->setLabel('period_start','mulai tgl');
$form->setType('period_start','date');

$form->addInput('period_end','text');
$form->setLabel('period_end','sampai tgl');
$form->setType('period_end','date');

$form->startCollapse('period_start','periode membeli produk');
$form->endCollapse('period_end');
$form->setCollapse('period_start',true);

$form->addInput('status','dropdown');
$form->setLabel('status','Pembelian');
$form->setOptions('status',[1=>'Sekali',2=>'Langganan']);

$form->setFormName('kebutuhan_edit_form');
$form->form();