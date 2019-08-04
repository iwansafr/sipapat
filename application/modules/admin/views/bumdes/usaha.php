<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
  $form = new zea();

  $form->init('edit');

  $form->setTable('bumdes_usaha');

  if(!empty($usaha))
  {
    $form->setId($usaha['id']);
    ?>
    <a class="btn btn-warning" href="<?php echo base_url('admin/bumdes/indikator_usaha')?>">indikator usaha</a>
    <?php
  }

  $form->addInput('bumdes_id', 'static');
  $form->setValue('bumdes_id', $bumdes_id);

  $form->addInput('user_id', 'static');
  $form->setValue('user_id', $user['id']);

  $form->addInput('desa_id', 'static');
  $form->setValue('desa_id', $pengguna['desa_id']);

  $form->addInput('unit_usaha','textarea');

  $form->form();
}