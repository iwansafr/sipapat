<?php defined('BASEPATH') OR exit('No direct script access allowed');

$edit = new Zea();

$edit->init('edit');
$edit->setTable('absensi_libur');
$id = @intval($_GET['id']);
$edit->setId($id);

$edit->addInput('title','text');
$edit->setLabel('title','Judul Libur');
$edit->addInput('date','text');
$edit->setType('date','date');
$edit->addInput('status','dropdown');
$edit->setOptions('status',['1'=>'Libur Nasional','2'=>'Libur mandiri']);

$edit->setRequired('All');
$edit->setFormName('libur_edit');


$roll = new Zea();

$roll->init('roll');
$roll->setTable('absensi_libur');
$roll->search();

$roll->addInput('id','hidden');
$roll->setNumbering(true);
$roll->addInput('title','plaintext');
$roll->setLabel('title','Judul Libur');
$roll->addInput('date','plaintext');
$roll->addInput('status','dropdown');
$roll->setOptions('status',['1'=>'Libur Nasional','2'=>'Libur mandiri']);
$roll->setAttribute('status','disabled');
$roll->setEdit(true);
$roll->setDelete(true);

$roll->setFormName('libur_roll');
$roll->setUrl('admin/absensi/clear_libur');
$roll->setRequired('All');


?>
<div class="row">
	<div class="col-md-3">
		<?php $edit->form();?>
	</div>
	<div class="col-md-9">
		<?php $roll->form();?>
	</div>
</div>