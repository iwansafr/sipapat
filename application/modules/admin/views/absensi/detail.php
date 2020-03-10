<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($status)){
	msg($msg,$status);
}

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();
?>
<h5><?php echo $perangkat['nama'] ?></h5>
<?php
if(!empty($desa_id))
{
	$where = ' AND perangkat_desa_id = '.$id;
	$form->init('roll');
	$form->setTable('absensi');
	$form->setWhere('desa_id = '.$desa_id.' '.$where);

	$form->addInput('id','hidden');
	$form->addInput('foto','thumbnail');
	$form->setNumbering(true);
	$form->addInput('status','dropdown');
	$form->setOptions('status',['1'=>'Berangkat','2'=>'Pulang','3'=>'Izin']);
	$form->setAttribute('status','disabled');

	$form->addInput('created','plaintext');
	$form->setUrl('admin/absensi/clear_detail/'.$id);

	// $form->setEdit(true);
	$form->setDelete(true);
	$form->form();
}