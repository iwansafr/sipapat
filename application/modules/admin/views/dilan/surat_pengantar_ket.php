<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');
$form->setId(@intval($_GET['id']));

$form->setTable('dilan_surat_ket');

$form->setHeading('keterangan surat pengantar');

$form->addInput('title','text');
$form->addInput('keperluan','text');
$form->addInput('keterangan','textarea');
$form->setFormName('surat_pengantar_ket_edit');




$form_list = new zea();

$form_list->init('roll');

$form_list->setTable('dilan_surat_ket');

$form_list->setHeading('keterangan surat pengantar');

$form_list->search();
$form_list->setNumbering(true);
$form_list->addInput('id','hidden');
$form_list->addInput('title','plaintext');
$form_list->addInput('keperluan','plaintext');
$form_list->addInput('keterangan','plaintext');
$form_list->setDelete(true);
$form_list->setEdit(true);
$form_list->setEditLink(base_url('admin/dilan/surat_pengantar_ket?id='),'id');

$form_list->setUrl('admin/dilan/clear_surat_pengantar_ket');

$form_list->setFormName('surat_pengantar_ket_list');

?>

<div class="col-md-4">
	<a href="<?php echo base_url('admin/dilan/surat_pengantar_ket') ?>" class="btn btn-warning btn-sm pull-right" title="refresh" data-toggle="tooltip" data-placement="top"><i class="fa fa-sync"></i></a>
	<?php $form->form();?>
</div>
<div class="col-md-8">
	<?php $form_list->form();?>
</div>