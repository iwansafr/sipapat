<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kec_get = !empty($_GET['kec']) ? '?kec='.$_GET['kec'] : '';
if(is_root() || is_admin() || is_inspektorat())
{
	?>
		<a href="<?php echo base_url('admin/perdes/kecamatan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
}

$form = new zea();
$form->setTable('perdes');
$form->search();
$where = '';
if(!empty(@$_GET['kec']))
{
	$kecamatan = @$_GET['kec'];
	$where = " kecamatan = '{$kecamatan}'";

	if(!empty($item)){
		$where .= ' AND item = '.$item.' ';
	}
	
	$form->join('desa','ON(perdes.desa_id=desa.id)','perdes.*,desa.kecamatan');
}else if(is_kecamatan())
{
	$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
	$where = " kecamatan = '{$kecamatan}'";
	if(!empty($item)){
		$where .= ' AND item = '.$item.' ';
	}
	$form->join('desa','ON(perdes.desa_id=desa.id)','perdes.id,perdes.desa_id,perdes.item,perdes.no,perdes.tgl_penetapan,perdes.tgl_pelaksanaan,perdes.progress,desa.kecamatan');
}else if(is_desa()){
	$where = ' desa_id = '.$desa_id;
	if(!empty($item)){
		$where .= ' AND item = '.$item.' ';
	}
}else{
	if(!empty($item)){
		$where = ' item = '.$item.' ';
	}
}
$form->setHeading
	(
		// '<a target="_blank" href="'.base_url('admin/pembangunan/pdf/'.@$view).$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-pdf-o"></i>/<i class="fa fa-print"></i></a>'.
		'<a target="_blank" href="'.base_url('admin/perdes/excel/').@$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>'
	);
$form->setWhere($where);
$form->init('roll');
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detail');
$form->setLink('id',base_url('admin/perdes/detail/'),'id');
if(!is_desa())
{
	$form->addInput('desa_id', 'dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','desa');
}
$form->setNumbering(TRUE);
$form->addInput('item','dropdown');
$form->setOptions('item',$perdes_options);
$form->setAttribute('item','disabled');
$form->addInput('no','plaintext');
$form->setLabel('no','Nomor');
$form->addInput('tgl_penetapan','plaintext');
$form->addInput('tgl_pelaksanaan','plaintext');
$form->addInput('progress','dropdown');
$form->setOptions('progress',$perdes_progress);
$form->setAttribute('progress','disabled');

if(is_root() || is_desa())
{
	$form->setDelete(TRUE);
	$form->setEdit(TRUE);
}

$form->setEditLink(base_url('admin/perdes/edit?id='));

$form->setUrl('admin/perdes/clear_list/'.@$item);
$form->form();