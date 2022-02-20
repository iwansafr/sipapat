<?php defined('BASEPATH') OR exit('No direct script access allowed');

$desa_id   = $this->sipapat_model->get_desa_id();
$user_id   = $user['id'];
$paramname = $desa_id.'_'.$user_id;

$form = new zea();

$form->setTable('dilan_config');

$form->setHeading('konfigurasi Dilan');

$form->init('param');
$form->setParamName($paramname);

$form->addInput('show_camat','radio');
$form->setLabel('show_camat','ttd camat');
$form->setRadio('show_camat',['Sembunyikan','Tampilkan']);

$form->addInput('show_nip','radio');
$form->setLabel('show_nip','NIP kepala desa');
$form->setRadio('show_nip',['Sembunyikan','Tampilkan']);

$form->addInput('show_ttd','radio');
$form->setLabel('show_ttd','TTD/Stempel kepala desa');
$form->setRadio('show_ttd',['Sembunyikan','Tampilkan']);

$form->addInput('show_kades','radio');
$form->setLabel('show_kades','Nama kepala desa');
$form->setRadio('show_kades',['Sembunyikan','Tampilkan']);

$form->addInput('is_petinggi','radio');
$form->setLabel('is_petinggi','Ganti Kepala Desa jadi Petinggi');
$form->setRadio('is_petinggi',['Tidak','Iya']);

$form->addInput('is_dilan','radio');
$form->setLabel('is_dilan','Gunakan Kode DLN pada nomor surat ?');
$form->setRadio('is_dilan',['Tidak','Iya']);

$form->setFormName('dilan_config');

$form->form();

if(!empty($_POST))
{
  if($form->success)
  {
    $this->db->update('dilan_config',['user_id'=>$user_id,'desa_id'=>$desa_id], ['name'=>$paramname]);
  }
}