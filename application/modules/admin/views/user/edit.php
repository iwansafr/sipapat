<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(($user['id'] == @intval($_GET['id'])) || is_admin() || is_root())
{
	$id = @intval($_GET['id']);
	if(!empty($id))
	{
		$this->zea->setId($id);
	}
	$where = ' level > 1';

	if(is_root())
	{
		$where = '';
	}
	$this->zea->init('edit');
	$this->zea->setTable('user');
	if(is_desa())
	{
		$this->zea->addInput('username','static');
		$this->zea->setValue('username',$user['username']);
	}else{
		$this->zea->addInput('username','text');
	}
	$this->zea->addInput('password','password');
	$this->zea->addInput('email','text');
	$this->zea->setType('emial','email');
	$this->zea->addInput('image','upload');
	$this->zea->setAccept('image', '.jpg,.jpeg,.png');
	if($user['level'] > 2)
	{
		$this->zea->addInput('user_role_id','static');
		$this->zea->setValue('user_role_id',$user['user_role_id']);
	}else{
		$this->zea->addInput('user_role_id','dropdown');
		$this->zea->setLabel('user_role_id','Role');
		$this->zea->tableOptions('user_role_id','user_role','id','title', $where);
	}
	$this->zea->addInput('active','radio');
	$this->zea->setRadio('active',array('Not Active','Active'));
	$this->zea->setRequired(array('user_role_id'));
	$this->zea->setUnique(array('username','email'));
	$this->zea->setEncrypt(array('password'));
	$this->zea->form();

	if(!empty($_POST['password']))
	{
		$this->db->update('user_desa',['sandi'=>@$_POST['password']], ' user_id= '.$user['id']);
	}
	if(!empty($_POST['username']))
	{
		$this->db->update('user_desa',['username'=>@$_POST['username']], ' user_id= '.$user['id']);
	}
	if(!empty($_POST['email']))
	{
		$this->db->update('user_desa',['email'=>@$_POST['email']], ' user_id= '.$user['id']);
	}
}else{
	echo msg('Forbiden and dangerous menu', 'danger');
}
