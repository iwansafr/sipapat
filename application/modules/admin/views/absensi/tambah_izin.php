<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($status)){
	msg($msg,$status);
}

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();
?>
<?php if (!empty($perangkat)): ?>
	<h1><?php echo $perangkat['nama'] ?></h1>
<?php endif ?>
<?php
if(!empty($desa_id))
{
	if(empty($exist)){
		$form = new zea();
		$form->init('edit');
		$form->setTable('absensi');
		
		$form->addInput('perangkat_desa_id','static');
		$form->setValue('perangkat_desa_id',$id);

		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$desa_id);

		$form->addInput('status','static');
		$form->setValue('status',3);

		$form->addInput('created','text');
		$form->setType('created','date');
		$form->setLabel('created','tanggal');

		$form->addInput('foto','file');
		$form->setAccept('foto','.jpg,.jpeg,.png,.gif');
		$form->setLabel('foto','foto surat izin');

		$form->setRequired('All');

		$form->form();
	}
}