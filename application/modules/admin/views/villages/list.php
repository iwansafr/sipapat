<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('villages');
$form->setId(@intval($_GET['id']));
$form->init('edit');
$form->setHeading('Desa');
$form->addInput('name','text');

$form2 = new zea();

$form2->setTable('villages');
$form2->init('roll');
if(!empty($district_id))
{
	$form2->setWhere('district_id = '.$district_id);	
}
$form2->search();
$form2->setHeading('Desa');
$form2->addInput('id','hidden');
// $form2->setLabel('id','action');
// $form2->setPlainText('id','plaintext');
$form2->setNumbering(true);
$form2->addInput('name','plaintext');
$form2->setEditLink(base_url('admin/villages?id='),'id');
$form2->setUrl('admin/villages/clear_list/'.@$district_id);
$form2->setEdit(true);
$form2->setDelete(true);


?>
<div class="col-md-3">
	<a href="<?php echo base_url('admin/villages') ?>" class="pull-right btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-9">
	<?php $form2->form();?>
</div>

