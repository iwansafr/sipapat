<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('dilan_surat');
$where = !empty($group_id) ? ' AND dilan_surat_ket_id = '.$group_id : '';
if(is_desa())
{
	$form->setWhere(' dilan_surat.desa_id = '.$this->sipapat_model->get_desa_id().' '.$where);
	$form->join('penduduk','ON(dilan_surat.penduduk_id=penduduk.id)','dilan_surat.id,dilan_surat.keperluan,penduduk.nik,penduduk.nama,penduduk.nama_ibu');
}else{
	$desa_id = @intval($_GET['id']);
	if(!empty($desa_id))
	{
		$form->setWhere(' desa_id = '.$desa_id);
	}else{
		$kecamatan = @$_GET['kec'];
		if(!empty($kecamatan))
		{
			$form->join('desa','ON(dilan_surat.desa_id=desa.id)','dilan_surat.id,dilan_surat.keperluan,desa.kecamatan');
			$form->setWhere(" kecamatan = '{$kecamatan}'");
			$form->addInput('kecamatan','plaintext');
		}else{
			$form->setWhere(' dilan_surat_ket_id = '.$group_id);
		}
	}
}

if(!is_desa() && !is_kecamatan())
{
	?>
	<a href="<?php echo base_url('admin/dilan/kecamatan_surat_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
}
else{
	?>
	<a href="<?php echo base_url('admin/dilan/surat_group') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Kelompok Surat</a>
	<?php
}

$form->search();

$form->addInput('id','plaintext');
$form->setLabel('id','display');

// $form->setLink('id',base_url('admin/dilan/surat_pengantar/'),'id');
// $form->setClearGet('id');
$form->setPlainText('id','<a class="btn btn-default btn-sm" href="'.base_url('admin/dilan/surat_pengantar/').'{id}/surat_pengantar" target="_blank">lihat surat <i class="fa fa-search"></i></a>');

$form->setNumbering(true);
if(is_desa())
{
	$form->addInput('nama','plaintext');
	$form->addInput('nik','plaintext');
	$form->addInput('nama_ibu','plaintext');
}
$form->addInput('keperluan','plaintext');

// $form->setEdit(true);
$form->setDelete(true);
$form->setUrl('admin/dilan/clear_surat_list');

$form->form();
// pr($form->getData()['query']);