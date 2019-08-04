<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_admin() || is_root())
{
  $form = new zea();

  $form->init('edit');
  $id = @intval($_GET['id']);
  $form->setId($id);
  $form->setTable('bumdes_dana_kat');

  $form->addInput('title','text');
  $form->setFormName('form_dana_kat');

  $list = new zea();

  $list->init('roll');
  $list->addInput('id','hidden');
  $list->search();
  $list->setNumbering(true);
  $list->setTable('bumdes_dana_kat');

  $list->addInput('title','plaintext');
  $list->setFormName('list_dana_kat');
  $list->setDelete(true);
  $list->setEdit(true);
  $list->setEditLink(base_url('admin/bumdes/dana_kat?id='));
  $list->setUrl('admin/bumdes/clear_dana_kat');

  ?>
  <div class="row">
    <div class="col-md-4">
      <?php echo $form->form()?>
    </div>
    <div class="col-md-8">
      <?php echo $list->form()?>
    </div>
  </div>
  <?php
}