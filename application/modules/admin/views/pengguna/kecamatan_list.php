<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin() || is_inspektorat())
{
  $form = new zea();
  $form->init('roll');
  $form->setTable('user_desa');
  $where = " user_role_id = 4";

  if(!empty($sipapat_config))
  {
    if(!empty($where)){
      $where .= ' AND user_desa.regency_id = '.$sipapat_config['regency_id'];
    }else{
      $where = ' user_desa.regency_id = '.$sipapat_config['regency_id'];
    }
    $form->join('districts',
    'ON(districts.id=user_desa.district_id)',
    '
    user_desa.id,
    user_desa.username,
    user_desa.user_role_id,
    user_desa.nama,
    user_desa.email,
    user_desa.sandi,
    user_desa.active,
    districts.name');
  }
  $form->setWhere($where);
  $form->search();
  $form->addInput('id','link');
  $form->setLabel('id','detail');
  $form->setPlaintext('id','detail');
  $form->setLink('id',base_url('admin/pengguna/detail'),'id');
  $form->setClearGet(['id']);
  $form->addInput('username','plaintext');
  $form->addInput('user_role_id','dropdown');
  $form->setAttribute('user_role_id','disabled');
  $form->setLabel('user_role_id','group');
  $form->tableOptions('user_role_id','user_role','id','title','level > 1');
  // $form->setLabel('nama','Nama Lengkap');
  $form->addInput('email','plaintext');
  $form->setAttribute('email',['type'=>'email']);
  if(is_root() || is_admin() || is_kecamatan())
  {
    $form->addInput('sandi','plaintext');
  }
  if(!empty($sipapat_config))
  {
    $form->addInput('name','plaintext');
    $form->setLabel('name','kecamatan');
  }

  $form->setUrl('admin/pengguna/clear_kec_list');
  $form->setFormName('pengguna_list_roll');
  if(is_admin() || is_root())
  {
    $form->addInput('active','checkbox');
    $form->setNumbering(TRUE);
    $form->setEdit(TRUE);
    $form->setDelete(TRUE);
  }
  $form->form();
  if(is_root())
  {
    pr($form->getData()['query']);
  }
}