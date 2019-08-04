<?php defined('BASEPATH') OR exit('No direct script access allowed');

pr($dana_kat);
foreach($dana_kat AS $key => $value)
{
  $form_title = str_replace(' ','_',$key);
  ?>
  <div class="panel panel-default card card-default">
    <div class="panel-heading card-header">
      <?php echo $key?>
    </div>
    <div class="panel-body card-body">
      <?php
      foreach($value AS $vkey => $vvalue)
      {

        $cur_id = $this->db->query('SELECT id FROM bumdes_indikator_usaha WHERE bumdes_id = ? AND bumdes_dana_id = ?',[$bumdes_id,$vvalue['id']])->row_array();
        $cur_id = @intval($cur_id['id']);
        $title = str_replace(' ','_',$vvalue['value']);
        $form = new zea();

        $form->init('edit');
        $form->setTable('bumdes_indikator_usaha');
        $form->setHeading($vvalue['value']);
        $form->setEditStatus(false);
        $form->addInput('bumdes_id','static');
        $form->setValue('bumdes_id',$bumdes_id);
        $form->addInput('bumdes_dana_id','static');
        $form->setValue('bumdes_dana_id',$vvalue['id']);

        $form->addInput('user_id','static');
        $form->setValue('user_id',$user['id']);
        $form->addInput('desa_id','static');
        $form->setValue('desa_id',$desa_id);
        $form->addInput('value','text');
        $form->setFormName($form_title.'_form_'.$title);
        $form->form();
        
      }
      ?>
    </div>
  </div>
  <?php
}