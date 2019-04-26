<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->zea->init('edit');
$this->zea->setTable('user_desa');
$this->zea->setId(@intval($_GET['id']));
$this->zea->setHeading('Pengguna');
$this->zea->addInput('nama','text');
$this->zea->addInput('username','text');
$this->zea->addInput('user_role_id','dropdown');
$this->zea->setLabel('user_role_id','group');
$this->zea->tableOptions('user_role_id','user_role','id','title','level > 1');
$this->zea->setLabel('nama','Nama Lengkap');
$this->zea->addInput('email','text');
$this->zea->setAttribute('email',['type'=>'email']);
$this->zea->addInput('phone','text');
$this->zea->setAttribute('phone',['type'=>'number']);
$this->zea->addInput('desa_id','dropdown');
$this->zea->tableOptions('desa_id','desa','id','nama');
$this->zea->setLabel('desa_id','nama desa');
$this->zea->addInput('sandi','password');
$this->zea->addInput('active','radio');
$this->zea->setRadio('active',['Tidak Aktif','Aktif']);
$this->zea->setRequired(['nama','username','email','phone','sandi']);
$this->zea->setUnique(['username']);
if(!empty($_GET['id']))
{
	$this->zea->setValue('sandi',$this->zea->getData()['sandi']);
}
$this->zea->form();
