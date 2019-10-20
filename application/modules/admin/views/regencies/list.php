<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('regencies');
$form->setId(@intval($_GET['id']));
$form->init('edit');
$form->setHeading('Kabupaten');
$form->addInput('name','text');

$form2 = new zea();

$form2->setTable('regencies');
$form2->init('roll');
if(!empty($prov_id))
{
	$form2->setWhere('province_id = '.$prov_id);	
}
$form2->search();
$form2->setHeading('Kabupaten');
$form2->addInput('id','plaintext');
$form2->setLabel('id','action');
$form2->setPlainText('id','<a href="'.base_url('admin/districts/list/').'{id}" class="btn btn-default btn-sm">kecamatan</a>');
$form2->setNumbering(true);
$form2->addInput('name','plaintext');
$form2->setEditLink(base_url('admin/regencies?id='),'id');
$form2->setUrl('admin/regencies/clear_list/'.@$prov_id);
$form2->setEdit(true);
$form2->setDelete(true);


?>
<div class="col-md-3">
	<a href="<?php echo base_url('admin/regencies') ?>" class="pull-right btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-9">
	<?php $form2->form();?>
</div>

