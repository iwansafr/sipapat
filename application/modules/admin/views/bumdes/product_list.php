<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('roll');
$form->setTable('bumdes_product');

$where = '';

if(is_desa())
{
	$where = ' desa_id = '.$desa_id;
}

if(!empty($cat_id))
{
	if(!empty($where))
	{
		$where .= " AND cat_ids LIKE %,{$cat_id},%";
	}else{
		$where = " cat_ids LIKE %,{$cat_id},%";
	}
}

$form->setWhere($where);

$form->search();

$form->setNumbering(true);

$form->addInput('id','plaintext');
$form->setHeading('<a href="'.base_url('admin/bumdes/product_edit').'" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></a>');

$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setAttribute('desa_id','disabled');
$form->setLabel('desa_id','desa');

$form->addInput('title','plaintext');
$form->setLabel('title','nama');

$form->setUrl('admin/bumdes/clear_product_list');
$form->setEditLink(base_url('admin/bumdes/product_edit?id='),'id');

$form->setEdit(true);
$form->setDelete(true);

$form->form();