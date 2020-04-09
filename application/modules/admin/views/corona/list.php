<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa() || is_root() || is_admin())
{
	$desa_id = 0;
	if(!empty($user['pengguna']['desa_id']))
	{
		$desa_id = $user['pengguna']['desa_id'];
	}else if(!empty($user['desa_id']))
	{
		$desa_id = $user['desa_id'];
	}

	$form = new zea();
	$form->init('roll');
	$form->setTable('corona');
	$form->search();

	if(!empty($desa_id))
	{
		$form->setWhere('desa_id = '.$desa_id);
	}

	?>
	<a href="<?php echo base_url('admin/corona/edit') ?>" class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i> tambah data</a>
	<a href="<?php echo base_url('admin/corona/rekap') ?>" class="btn btn-sm btn-default"><i class="fa fa-chart-bar"></i> rekap data total</a>
	<a href="<?php echo base_url('admin/corona/excel_list') ?>" class="btn btn-sm btn-default"><i class="fa fa-chart-bar"></i> rekap data odp</a>
	<?php
	$form->setNumbering(true);
	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id',[base_url('admin/corona/detail/{id}')=>'Detail']);
	$form->addInput('nama','plaintext');
	$form->addInput('umur','plaintext');

	$form->addInput('desa_id','dropdown');
	$form->setLabel('desa_id','desa');
	
	if(!empty($sipapat_config))
	{
		$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);
	}else{
		$form->tableOptions('desa_id','desa','id','nama');
	}
	$form->setAttribute('desa_id','disabled');

	$form->addInput('rt','plaintext');
	$form->addInput('rw','plaintext');
	$form->addInput('dari','plaintext');
	$form->addInput('tgl','plaintext');
	$form->addInput('hp','plaintext');

	// $form->addInput('status','dropdown');
	// $form->setOptions('status',['1'=>'ODP','2'=>'PDP','3'=>'Positive']);
	// $form->setAttribute('status','disabled');

	$form->setUrl('admin/corona/clear_list');

	$form->setEdit(true);
	$form->setDelete(true);
	$form->form();
}