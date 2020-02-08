<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_desa())
{
	$excel_get = make_get($_GET);
	$district_id = @intval($_GET['district_id']);
	?>
	<a href="<?php echo base_url('admin/desa/rekening_kecamatan_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<a target="_blank" href="<?php echo base_url('admin/desa/download_rekening_excel/'.$excel_get) ?>" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i> Excel</a>
	<a target="_blank" href="<?php echo base_url('admin/desa/rekening_pdf/'.$excel_get) ?>" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i> PDF</a>
	<a href="<?php echo base_url('admin/desa/rekening_rekap/') ?>" class="btn btn-sm btn-default"><i class="fa fa-chart-bar"></i> Rekap Data</a>
	<?php
	$form = new zea();
	$form->init('roll');

	if(!empty($district_id))
	{
		$form->join('desa','ON(desa.id = desa_rekening.desa_id)','desa_rekening.id,desa_rekening.nama,desa_rekening.desa_id,desa_rekening.alamat,desa_rekening.no_rek,desa_rekening.bank,desa_rekening.no_npwp,desa.district_id');
		$form->setWhere(' district_id = '.$district_id);
	}
	$form->search();
	$form->setTable('desa_rekening');
	$form->setHeading('Rekening Desa');
	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id',[base_url('admin/desa/rekening/?desa_id={desa_id}')=>'Detail']);
	$form->setNumbering(true);
	$form->addInput('nama','plaintext');
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','desa');
	$form->addInput('alamat','plaintext');
	$form->addInput('no_rek','plaintext');
	$form->setLabel('no_rek','Nomor Rekening');
	$form->addInput('bank','plaintext');
	$form->setLabel('bank','Nama Bank');
	$form->addInput('no_npwp','plaintext');
	$form->setLabel('no_npwp','Nomor NPWP');
	if(is_root())
	{
		$form->setEdit(true);
		$form->setDelete(true);
	}
	$form->setUrl('admin/desa/rekening_list_clear');
	$form->setEditLink(base_url('admin/desa/rekening_edit?id='),'id');
	$form->form();
}else{
	msg('anda tidak punya hak akses ke halaman ini','danger');
}