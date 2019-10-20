<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('provinces');
$form->setId(@intval($_GET['id']));
$form->init('edit');
$form->setHeading('Provinsi');
$form->addInput('name','text');

$form2 = new zea();

$form2->setTable('provinces');
$form2->search();
$form2->init('roll');
$form2->setHeading('Provinsi');
$form2->addInput('id','plaintext');
$form2->setLabel('id','action');
$form2->setPlainText('id','<a href="'.base_url('admin/regencies/list/').'{id}" class="btn btn-default btn-sm">Kabupaten</a>');
$form2->setNumbering(true);
$form2->addInput('name','plaintext');
$form2->setEditLink(base_url('admin/provinces?id='),'id');
$form2->setUrl('admin/provinces/clear_list');
$form2->setEdit(true);
$form2->setDelete(true);


?>
<div class="col-md-3">
	<a href="<?php echo base_url('admin/provinces') ?>" class="pull-right btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-9">
	<?php $form2->form();?>
</div>

