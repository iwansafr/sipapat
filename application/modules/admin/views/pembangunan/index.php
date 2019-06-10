<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!is_desa())
{
	?>
	<a href="<?php echo base_url('admin/pembangunan/clear_desa/'.$view) ?>" class="load_link btn btn-sm btn-default"><i class="fa fa-sort"></i> data perdesa</a>
	<?php
}
if($view =='fisik' || $view == 'non-fisik')
{
	$where = 'jenis = 0';
	if($view == 'fisik')
	{
		$where = 'jenis = 1';
	}
	if(!empty($desa_id))
	{
		$where .= ' AND desa_id = '.$desa_id;
	}
	$form = new zea();
	$form->setTable('pembangunan');
	$form->init('roll');
	$form->setWhere($where);
	$form->search();
	if(is_desa())
	{
		$form->setHeading('<a href="'.base_url('admin/pembangunan/edit/'.$view).'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');
	}
	$form->addInput('id','link');
	$form->setLink('id',base_url('admin/pembangunan/detail/'),'id');
	$form->setClearGet('id');
	$form->setPlainText('id','Detail');
	$form->setLabel('id','Detail');
	$form->setNumbering(TRUE);
	$form->addInput('item','plaintext');
	$form->addInput('sumber_dana','dropdown');
	$form->setAttribute('sumber_dana','disabled');
	$form->setOptions('sumber_dana', $sumber);
	$form->setLabel('sumber_dana', 'Sumber Dana');

	$form->addInput('bidang','dropdown');
	$form->setAttribute('bidang','disabled');
	$form->setOptions('bidang', $bidang);

	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setLabel('desa_id','Desa');
	$form->setAttribute('desa_id','disabled');

	$form->addInput('anggaran','plaintext');
	$form->setType('anggaran','number');
	$form->setMoney('anggaran');

	if($view=='non-fisik')
	{
		$form->addInput('peserta','plaintext');
		$form->addInput('tahap','dropdown');
		$form->setAttribute('tahap','disabled');
		$form->setOptions('tahap', ['-1'=>'1 X tahapan','1'=>'Kegiatan Tahap 1','2'=>'Kegiatan Tahap 2','3'=>'Kegiatan Tahap 3']);
	}
	$form->addInput('th_anggaran','plaintext');
	$form->setLabel('th_anggaran','Tahun Anggaran');
	$form->setUrl('admin/pembangunan/clear_list/'.$view);
	if(is_desa())
	{
		$form->setDelete(TRUE);
		$form->setEdit(TRUE);
		$form->setEditLink(base_url('admin/pembangunan/edit/'.$view.'?id='));
	}
	$form->form();
}else{
	msg('Maaf URL yg anda tuju tidak valid', 'danger');
}