<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root())
{
	$form = new zea();

	$form->init('edit');
	$form->setTable('absensi_dashboard');

	$form->addInput('district_id','dropdown');
	$form->tableOptions('district_id','districts','id','name','regency_id = '.$sipapat_config['regency_id']);
	$form->setLabel('district_id','kecamatan');
	$form->setFormName('absensi_form_edit');

	$roll = new zea();

	$roll->init('roll');
	$roll->setNumbering(true);
	$roll->setTable('absensi_dashboard');
	$roll->addInput('id','plaintext');
	$roll->addInput('district_id','dropdown');
	$roll->tableOptions('district_id','districts','id','name','regency_id = '.$sipapat_config['regency_id']);
	$roll->setLabel('district_id','kecamatan');
	$roll->setAttribute('district_id','disabled');
	$roll->setUnique(['district_id']);
	$roll->setDelete(true);
	$roll->setEdit(true);
	$roll->setFormName('absensi_form_roll');
	?>
	<div class="row">
		<div class="col-md-3">
			<?php $form->form();?>
		</div>
		<div class="col-md-9">
			<?php $roll->form();?>
		</div>
	</div>
	<?php
}