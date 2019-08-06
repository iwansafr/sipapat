<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_desa())
{
	?>
	<a class="btn btn-warning load_link" href="<?php echo base_url('admin/bumdes/clear_bumdesma_mandiri_sejahtera') ?>"><i class="fa fa-plus"></i> tambah baru</a>
	<?php
	$id = @intval($_GET['id']);
	$form = new zea();
	$form->init('edit');
	$form->setId($id);
	$form->setTable('bumdesma');
	$form->addInput('modal','text');
	$form->setType('modal','number');
	$form->setLabel('modal','Penyertaan Modal');

	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$pengguna['desa_id']);

	$form->addInput('user_id','static');
	$form->setValue('user_id',$pengguna['user_id']);

	$form->addInput('sumber_dana', 'dropdown');
	$form->setOptions('sumber_dana',['dd','add']);
	$form->setLabel('sumber_dana','sumber dana');

	$form->addInput('th_anggaran','text');
	$form->setLabel('th_anggaran','tahun anggaran');
	$form->setType('th_anggaran','number');

	$form->addInput('termin','dropdown');
	$form->setOptions('termin',['1'=>'termin 1','2'=>'termin 2','3'=>'termin 3']);
	$form->setFormName('bumdesma_edit');

	$form->form();

}