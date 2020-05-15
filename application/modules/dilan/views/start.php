<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->setTable('config');
$form->init('param');
$form->setParamName('ujicoba');

$form->addInput('province_id','dropdown');
$form->setLabel('province_id','Provinsi');
$form->setOptions('province_id',['none']);

$form->addInput('regency_id','dropdown');
$form->setLabel('regency_id','Kabupaten');
$form->setOptions('regency_id',['none']);

$form->addInput('district_id','dropdown');
$form->setLabel('district_id','Kecamatan');
$form->setOptions('district_id',['none']);

$form->addInput('village_id','dropdown');
$form->setLabel('village_id','Desa');
$form->setOptions('village_id',['none']);

$sipapat_config = $this->esg->get_config(base_url());
if(!empty($sipapat_config))
{
	$form->tableOptions('province_id','provinces','id','name',' id = '.$sipapat_config['province_id']);
	$form->tableOptions('regency_id','regencies','id','name',' id = '.$sipapat_config['regency_id']);
	$form->setSelected('province_id',$sipapat_config['province_id']);
	$form->setSelected('regency_id',$sipapat_config['regency_id']);
	$form->tableOptions('district_id','districts','id','name',' regency_id = '.$sipapat_config['regency_id']);
}

$form->form();