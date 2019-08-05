<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('param');
$form->setTable('bumdes_simpan_pinjam');
$form->setHeading('Kolektabilitas (piutang)');
$form->setEditStatus(false);
$paramname = $bumdes_id.'_'.$user_id.'_'.$desa_id;
$form->setParamName($paramname);

$form->addInput('lancar','text');
$form->setLabel('lancar', 'Lancar');

$form->addInput('kurang_lancar','text');
$form->setLabel('kurang_lancar', 'Kurang Lancar');

$form->addInput('diragukan','text');
$form->setLabel('diragukan', 'diragukan');

$form->addInput('macet','text');
$form->setLabel('macet', 'macet');



$form->addInput('nama','text');
$form->addInput('jabatan','text');

$form->startCollapse('nama','Data ini di isi dg sebenar-benarnya oleh');
$form->endCollapse('jabatan');
$form->setCollapse('nama');
$form->form();
if(!empty($_POST))
{
  if($form->success)
  {
    $this->bumdes_model->update_simpan_pinjam(['bumdes_id'=>$bumdes_id,'desa_id'=>$desa_id,'user_id'=>$user_id], $paramname);
  }
}