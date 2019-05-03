<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->zea->init('edit');
$this->zea->setTable('user_desa');
$this->zea->setId(@intval($_GET['id']));
$this->zea->setHeading('Pengguna');
if(!empty($_GET['id']))
{
	$data_pengguna = $this->zea->getData();
	$this->zea->addInput('user_id','hidden');
	if($data_pengguna['user_id'] == 0)
	{
		$user_id = $this->db->query('SELECT id FROM user WHERE username = ?',$data_pengguna['username'])->row_array();
		if(!empty($user_id['id']))
		{
			$user_id = $user_id['id'];
			$this->zea->setValue('user_id',$user_id);
		}
	}
}
$this->zea->addInput('nama','text');
$this->zea->addInput('username','text');
$this->zea->addInput('user_role_id','dropdown');
$this->zea->setLabel('user_role_id','group');
$this->zea->tableOptions('user_role_id','user_role','id','title','level > 1');
$this->zea->setFirstOption('user_role_id',['0'=>'Pilih Group']);
$this->zea->setAttribute('user_role_id',['placeholder'=>'pilih group']);
$this->zea->setLabel('nama','Nama Lengkap');
$this->zea->addInput('email','text');
$this->zea->setAttribute('email',['type'=>'email']);
$this->zea->addInput('phone','text');
$this->zea->setAttribute('phone',['type'=>'number']);
$this->zea->addInput('desa_id','dropdown');
$this->zea->tableOptions('desa_id','desa','id','nama');
$this->zea->setLabel('desa_id','nama desa');
$this->zea->setFirstOption('desa_id',['0'=>'Pilih Desa']);
$this->zea->addInput('sandi','password');
$this->zea->addInput('active','radio');
$this->zea->setRadio('active',['Tidak Aktif','Aktif']);
$this->zea->setRequired(['nama','username','email','phone','sandi']);
$this->zea->setUnique(['username']);
if(!empty($_GET['id']))
{
	$this->zea->setValue('sandi',$this->zea->getData()['sandi']);
}
$this->zea->setFormName('pengguna_edit_form');
$this->zea->form();
