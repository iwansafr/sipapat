<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();
$form->setTable('desa');
if(is_desa())
{
	// $form->setWhere(' id = '.$pengguna['desa_id']);
	$form->setId($pengguna['desa_id']);
	$form->init('edit');
	$form->setHeading
		(
			'<a href="'.base_url('admin/desa/edit?id='.$pengguna['desa_id']).'" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Ubah</a>'
		);
	$form->setEditStatus(FALSE);
	$form->addInput('kode','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('kabupaten','plaintext');
	$form->addInput('kode_pos','plaintext');
	$form->addInput('telepon','plaintext');
	$form->addInput('email','plaintext');
	$form->addInput('website','plaintext');
	$form->addInput('alamat','plaintext');
	$form->setSave(FALSE);
	$form->form();
}else{
	if(!is_kecamatan())
	{
		?>
		<a href="<?php echo base_url('admin/desa/kecamatan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
		<?php
	}
	$where = '';
	if(is_kecamatan())
	{
		$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
		$where = " kecamatan = '{$kecamatan}'";
	}	
	if(!empty(@$_GET['kec']))
	{
		$kecamatan = @$_GET['kec'];
		$where = " kecamatan = '{$kecamatan}'";
	}
	$form->init('roll');
	$form->search();
	$desa_id_get = !empty($_GET['desa_id']) ? '?desa_id='.@intval($_GET['desa_id']) : '';
	$desa_id_get = !empty($_GET['kec']) && empty(@intval($_GET['desa_id'])) ? '?kec='.$_GET['kec'] : $desa_id_get;
	$form->setHeading
		(
			'<a href="'.base_url('admin/desa/edit').'"><button class="btn btn-sm btn-default"><i class="fa fa-plus-circle"></i></button></a>'.
			'<a target="_blank" href="'.base_url('admin/desa/pdf').$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-pdf-o"></i>/<i class="fa fa-print"></i></a>'.
			'<a target="_blank" href="'.base_url('admin/desa/excel').$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>'
		);
	$form->setWhere($where);
	$form->setNumbering(TRUE);
	// $form->addInput('id','link');
	// $form->setLabel('id','detail');
	// $form->setPlainText('id','lihat detail');
	// $form->setLink('id',base_url('admin/desa/detail'),'id');
	// $form->setClearGet('id');

	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id','
		<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Action
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		  	<li><a href="'.base_url('admin/desa/detail/').'{id}"><i class="fa fa-search"></i>Detail</a></li>
		    <li><a href="'.base_url('admin/perangkat/?desa_id={id}').'"><i class="fa fa-search"></i>Perangkat Desa</a></li>
		    <li role="separator" class="divider"></li>
		    <li><a href="#{id}">dll</a></li>
		  </ul>
		</div>
		');
	$form->addInput('kode','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('kabupaten','plaintext');
	$form->addInput('kode_pos','plaintext');
	$form->addInput('telepon','plaintext');
	$form->addInput('email','plaintext');
	$form->addInput('website','plaintext');
	$form->addInput('alamat','plaintext');
	$form->setUrl('admin/desa/clear_list');
	if(!is_kecamatan())
	{
		$form->setEdit(TRUE);
		$form->setDelete(TRUE);
	}
	$form->form();
}
