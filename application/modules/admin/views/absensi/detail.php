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
<a href="<?php echo base_url('admin/absensi/tambah_izin/'.$id) ?>" class="btn btn-warning"><i class="fa fa-file"></i> Buat Izin</a>
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
	$form->setOptions('status',['1'=>'<span class="btn-sm btn-success">Berangkat</span>','2'=>'<span class="btn-sm btn-success">Pulang</span>','3'=>'<span class="btn-sm btn-warning">Izin</span>','4'=>'<span class="btn-sm btn-danger">Terlambat</span>']);
	$form->setAttribute('status','disabled');

	$form->addInput('created','plaintext');
	$form->setLabel('created','waktu');
	$form->setUrl('admin/absensi/clear_detail/'.$id);

	$form->addInput('valid','checkbox');
	// $form->setEdit(true);
	$form->setDelete(true);
	$form->form();
}