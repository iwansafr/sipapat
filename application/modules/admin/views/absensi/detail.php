<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($status)){
	msg($msg,$status);
}

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();
?>
<?php if (!empty($perangkat)): ?>
	<h1><?php echo $perangkat['nama'].' | '.$jabatan[$perangkat['jabatan']] ?></h1>
<?php endif ?>
<div class="btn-group">
  <a href="#" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-file"></i> Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <li><a href="<?php echo base_url('admin/absensi/tambah_izin/'.$id) ?>?t=3"><i class="fa fa-file"></i> Buat Izin Kantor</a></li>
    <li><a href="<?php echo base_url('admin/absensi/tambah_izin/'.$id) ?>?t=5"><i class="fa fa-file"></i> Buat Dinas Kantor</a></li>
    <li class="divider"></li>
    <li><a href="<?php echo base_url('admin/absensi/rekap/'.$id.'/'.date('m').'/'.date('Y')) ?>"><i class="fa fa-chart-bar"></i> Lihat Rekap</a></li>
  </ul>
  <hr>
</div>
<div class="btn-group">
</div>
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

	if(is_admin() || is_root() || is_kecamatan())
	{
		$form->addInput('valid','checkbox');
		// $form->setEdit(true);
		$form->setDelete(true);
	}
	$form->form();
}