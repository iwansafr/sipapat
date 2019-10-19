<?php defined('BASEPATH') OR exit('No direct script access allowed');


$form = new zea();
$form->search();
if(is_desa() || is_bumdes())
{
	$form->setWhere('desa_id = '.$this->sipapat_model->get_desa_id());
}else if(is_kecamatan())
{
	$kecamatan = str_replace('kec_', '', $user['username']);
	$form->setWhere("desa.kecamatan = '{$kecamatan}'");
}else{
	?>
	<a href="<?php echo base_url('admin/bumdes/kecamatan_kebutuhan_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
	$desa_id = @intval($_GET['desa_id']);
	if(!empty($desa_id))
	{
		$form->setWhere('desa_id = '.$desa_id);
	}else if(!empty($_GET['kec']))
	{
		$kecamatan = @$_GET['kec'];
		$form->setWhere("desa.kecamatan = '{$kecamatan}'");
	}
}

$form->join('desa','ON(desa.id=bumdes_kebutuhan.desa_id)','desa.nama AS nama_desa,desa.kecamatan, bumdes_kebutuhan.id,bumdes_kebutuhan.item,bumdes_kebutuhan.period_start,bumdes_kebutuhan.period_end,bumdes_kebutuhan.contact,bumdes_kebutuhan.status');

$form->init('roll');
$form->setTable('bumdes_kebutuhan');

$form->setNumbering(true);

$form->addInput('id','hidden');
$form->addInput('item','plaintext');
$form->addInput('nama_desa','plaintext');
$form->addInput('kecamatan','plaintext');
$form->addInput('period_start','plaintext');
$form->addInput('period_end','plaintext');
$form->addInput('status','dropdown');
$form->setOptions('status',['1'=>'Sekali','2'=>'Langganan']);
$form->setAttribute('status','disabled');


$form->setFormName('kebutuhan_list_roll');
$form->setUrl('admin/bumdes/clear_kebutuhan_list');


$form->setEdit(true);
$form->setEditLink(base_url('admin/bumdes/kebutuhan_edit?id='),'id');
$form->setDelete(true);
$form->form();