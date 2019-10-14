<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('penduduk');

$form->init('roll');

$form->search();

if(!is_desa())
{
	$desa_id = @intval($_GET['desa_id']);
	if(!empty($desa_id))
	{
		$form->setWhere("desa_id = ".$desa_id);
	}else{
		$kecamatan = @$_GET['kec'];
		if(!empty($kecamatan))
		{
			$form->join('desa','ON(penduduk.desa_id=desa.id)','penduduk.id,penduduk.no_kk,penduduk.nik,penduduk.nama,penduduk.alamat,penduduk.jk,penduduk.status,desa.kecamatan');
			$form->setWhere(" kecamatan = '{$kecamatan}'");
			$form->addInput('kecamatan','plaintext');
		}
	}
}else{
	$form->setWhere("desa_id = ".$this->sipapat_model->get_desa_id());
}

$form->order_by('id','DESC');

if(!is_desa() && !is_kecamatan())
{
	?>
	<a href="<?php echo base_url('admin/dilan/kecamatan_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
}

// $form->setHeading('<a target="_blank" href="'.base_url('admin/dilan/penduduk_excel/'.$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>');

$form->setNumbering(true);
$form->addInput('id','plaintext');
$form->setLink('id',base_url(),'id');
$form->setLabel('id','action');
$form->setPlaintext('id','
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Action
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	  	<li><a href="'.base_url('admin/dilan/detail/').'{id}"><i class="fa fa-search"></i>Detail</a></li>
	    <li><a href="'.base_url('admin/dilan/surat_pengantar_choose_form/').'{id}"><i class="fa fa-plus"></i>Surat Pengantar</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#{id}">dll</a></li>
	  </ul>
	</div>
');
$form->addInput('no_kk','plaintext');
$form->addInput('nik','plaintext');
$form->addInput('nama','plaintext');
$form->addInput('alamat','plaintext');
$form->setLabel('alamat','desa');
$form->addInput('jk','dropdown');
$form->setOptions('jk',['1'=>'Laki-laki','2'=>'perempuan']);
$form->setAttribute('jk','disabled');
$form->addInput('status','dropdown');
$form->setOptions('status',$this->dilan_model->status());
$form->setAttribute('status','disabled');

$form->setUrl('admin/dilan/clear_list');

$form->setDelete(true);
$form->setEdit(true);


$form->form();