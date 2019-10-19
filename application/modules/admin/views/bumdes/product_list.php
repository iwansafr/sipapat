<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('bumdes_product');

$where = '';

if(is_desa() || is_bumdes())
{
	$where = ' desa_id = '.$desa_id;
}else{
	?>
	<a href="<?php echo base_url('admin/bumdes/kecamatan_product_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
	$desa_id = @intval($_GET['desa_id']);
	if(!empty($desa_id))
	{
		$where = 'desa_id = '.$desa_id;
	}else if(!empty($_GET['kec']))
	{
		$kecamatan = @$_GET['kec'];
		$where = "desa.kecamatan = '{$kecamatan}'";
	}
}

$form->join('desa','ON(desa.id=bumdes_product.desa_id)','desa.nama AS nama_desa,desa.kecamatan, bumdes_product.cat_id,bumdes_product.id,bumdes_product.title');

if(!empty($cat_id))
{
	if(!empty($where))
	{
		$where .= " AND cat_id = $cat_id";
	}else{
		$where = " cat_id = $cat_id";
	}
}

$form->setWhere($where);

$form->search();

$form->setNumbering(true);

$form->addInput('id','plaintext');
$form->setHeading('<a href="'.base_url('admin/bumdes/product_edit').'" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></a>');

$form->addInput('nama_desa','plaintext');
$form->setLabel('nama_desa','Desa');

$form->addInput('kecamatan','plaintext');

$form->addInput('title','plaintext');
$form->setLabel('title','nama');

$form->setUrl('admin/bumdes/clear_product_list');
$form->setEditLink(base_url('admin/bumdes/product_edit?id='),'id');

$form->setEdit(true);
$form->setDelete(true);

$form->form();
pr($form->getData()['query']);