<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($posy_id) && $status)
{
	$form = new zea();

	$form->init('edit');
	$form->setId($id);
	$form->setTable('posyantekdes_pengurus');
	$form->setHeading('pengurus');

	$this_data = $form->getData();
	if(($posyantekdes['id'] == $this_data['posyantekdes_id']) || empty($id)){
		$form->addInput('posyantekdes_id','static');
		$form->setValue('posyantekdes_id',$posy_id);
		$form->addInput('nama','text');
		$form->addInput('jabatan','dropdown');
		$form->setOptions('jabatan',$jabatan);
		$form->addInput('hp','text');
		$form->addInput('domisili','text');
		$form->addInput('sk','text');
		$form->setFormName('pengurus_edit');


		$form2 = new zea();

		$form2->init('roll');

		$form2->setTable('posyantekdes_pengurus');

		$form2->setHeading('pengurus');
		$form2->addInput('id','hidden');
		$form2->setNumbering(true);
		$form2->addInput('nama','plaintext');
		$form2->addInput('jabatan','dropdown');
		$form2->setOptions('jabatan',$jabatan);
		$form2->setAttribute('jabatan','disabled');
		$form2->addInput('hp','plaintext');
		$form2->addInput('domisili','plaintext');
		$form2->addInput('sk','plaintext');
		$form2->setDelete(true);
		$form2->setEdit(true);
		$form2->setEditLink(base_url('admin/posyantekdes/pengurus/'.$posy_id.'/?id='));
		$form2->setFormName('pengurus_roll');

		?>
		<div class="row">
			<div class="col-md-3">
				<?php $form->form(); ?>
			</div>
			<div class="col-md-9">
				<?php $form2->form() ;?>
			</div>
		</div>
		<?php
	}else{
		msg('anda tidak punya akses ke halaman ini','danger');
	}
}else{
	msg('anda tidak punya akses ke halaman ini','danger');
}