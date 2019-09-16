<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('bumdes_product_cat');
$form->setId(@intval($_GET['id']));
$form->init('edit');
$form->setHeading('Kategori Produk Bumdes');
$form->addInput('title','text');
$form->addInput('description','textarea');

$form2 = new zea();

$form2->setTable('bumdes_product_cat');
$form2->init('roll');
$form2->setHeading('Kategori Produk Bumdes');
$form2->addInput('id','plaintext');
$form2->setLabel('id','action');
$form2->setPlainText('id','<a href="'.base_url('admin/bumdes/product_cat/').'{id}" class="btn btn-default btn-sm">go</a>');
$form2->setNumbering(true);
$form2->addInput('title','plaintext');
$form2->addInput('description','plaintext');
$form2->setEditLink(base_url('admin/bumdes/product_cat?id='),'id');
$form2->setUrl('admin/bumdes/clear_product_cat');
$form2->setEdit(true);
$form2->setDelete(true);


?>
<div class="col-md-3">
	<a href="<?php echo base_url('admin/bumdes/product_cat') ?>" class="pull-right btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-9">
	<?php $form2->form();?>
</div>

