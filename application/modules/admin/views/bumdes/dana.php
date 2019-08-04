<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_admin() || is_root())
{
  $form = new zea();

  $form->init('edit');
  $id = @intval($_GET['id']);
  $form->setId($id);
  $form->setTable('bumdes_dana');

  $form->addInput('bumdes_dana_kat_id','dropdown');

  $form->tableOptions('bumdes_dana_kat_id','bumdes_dana_kat','id','title');
  $form->setLabel('bumdes_dana_kat_id','kategori');

  $form->addInput('value','text');

  $form->setFormName('form_dana_kat');

  $list = new zea();

  $list->init('roll');
  $list->addInput('id','hidden');
  $list->search();
  $list->setNumbering(true);
  $list->setTable('bumdes_dana');

  $list->addInput('bumdes_dana_kat_id','dropdown');

  $list->tableOptions('bumdes_dana_kat_id','bumdes_dana_kat','id','title');
  $list->setLabel('bumdes_dana_kat_id','kategori');
  $list->setAttribute('bumdes_dana_kat_id','disabled');
  $list->addInput('value','plaintext');
  $list->setFormName('list_dana_kat');
  $list->setDelete(true);
  $list->setEdit(true);
  $list->setEditLink(base_url('admin/bumdes/dana?id='));
  $list->setUrl('admin/bumdes/clear_dana');

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