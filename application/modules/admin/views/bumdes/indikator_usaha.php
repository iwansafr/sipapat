<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
  $form = new zea();

  $form->init('param');
  $form->setTable('bumdes_indikator_usaha');
  $paramname = $bumdes_id.'_'.$user_id.'_'.$desa_id;
  $form->setParamName($paramname);
  $form->addInput('unit_usaha','textarea');
  foreach($dana_kat AS $key => $value)
  {
    $form_title = str_replace(' ','_',$key);
    $first_index = '';
    $last_index = '';
    $i = 0;
    foreach($value AS $vkey => $vvalue)
    {
      $title = str_replace(' ','_',$vvalue['value']);
      if($i==0){
        $first_index = $title;
      }
      $last_index = $title;

      $form->addInput($title,'text');
      $form->setLabel($title, $vvalue['value']);
      $i++;
    }
    if(!empty($last_index))
    {
      $form->startCollapse($first_index, $form_title);
      $form->endCollapse($last_index);
      $form->setCollapse($first_index,TRUE);

    }

  }
  $form->form();
  if(!empty($_POST))
  {
    if($form->success)
    {
      $this->bumdes_model->update_indikator_usaha(['bumdes_id'=>$bumdes_id,'desa_id'=>$desa_id,'user_id'=>$user_id], $paramname);
    }
  }
}