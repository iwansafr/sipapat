<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('districts');
$form->setId(@intval($_GET['id']));
$form->init('edit');
$form->setHeading('Kecamatan');
$form->addInput('name','text');

$form2 = new zea();

$form2->setTable('districts');
$form2->init('roll');
if(!empty($reg_id))
{
	$form2->setWhere('regency_id = '.$reg_id);	
}
$form2->search();
$form2->setHeading('Kecamatan');
$form2->addInput('id','plaintext');
$form2->setLabel('id','action');
$form2->setPlainText('id','<a href="'.base_url('admin/villages/list/').'{id}" class="btn btn-default btn-sm">Desa</a>');
$form2->setNumbering(true);
$form2->addInput('name','plaintext');
$form2->setEditLink(base_url('admin/districts?id='),'id');
$form2->setUrl('admin/districts/clear_list/'.@$reg_id);
$form2->setEdit(true);
$form2->setDelete(true);


?>
<div class="col-md-3">
	<a href="<?php echo base_url('admin/districts') ?>" class="pull-right btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-9">
	<?php $form2->form();?>
</div>

