<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_desa())
{
	?>
	<!-- <a class="btn btn-default btn-sm load_link" href="<?php echo base_url('admin/bumdes/clear_bumdesma_mandiri_sejahtera') ?>"><i class="fa fa-plus"></i> tambah baru</a> -->
	<div class="form-group" style="margin-bottom: 0!important;">
		<div class="btn-group">
	    <a href="#" type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	      <i class="fa fa-plus"></i> tambah baru
	      <span class="caret"></span>
	      <span class="sr-only">Toggle Dropdown</span>
	    </a>
	    <ul class="dropdown-menu" role="menu">
	      <li><a href="<?php echo base_url('admin/bumdes/bumdesma_mandiri_sejahtera?sumber=dd') ?>">DD</a></li>
	      <li class="divider"></li>
	      <li><a href="<?php echo base_url('admin/bumdes/bumdesma_mandiri_sejahtera?sumber=other') ?>">Lainnya</a></li>
	    </ul>
	    <hr>
	  </div>
	</div>
	<?php
	$id = @intval($_GET['id']);
	if(!empty($sumber_selected) || !empty($bumdesma))
	{
		if($sumber_selected=='dd' || @$bumdesma['sumber_dana'] == '1'){
			$sumber = ['1'=>'DD'];
		}else{
			unset($sumber['1']);
		}
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
		$form->setOptions('sumber_dana',$sumber);
		$form->setLabel('sumber_dana','sumber dana');

		$form->addInput('th_anggaran','text');
		$form->setLabel('th_anggaran','tahun anggaran');
		$form->setType('th_anggaran','number');

		if($sumber_selected=='dd')
		{
			$form->addInput('termin','dropdown');
			$form->setOptions('termin',['1'=>'termin 1','2'=>'termin 2','3'=>'termin 3']);
		}
		$form->setFormName('bumdesma_edit');

		$form->form();
	}

}