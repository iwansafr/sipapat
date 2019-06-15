<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!is_desa())
{
	?>
	<a href="<?php echo base_url('admin/potensi/desa') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> data perdesa</a>
	<?php
}
$form = new zea();

$form->init('roll');
$form->setTable('potensi_desa');

$form->search();

if(!is_desa())
{
	$desa_id = @intval($_GET['desa_id']);
	if(!empty($desa_id))
	{
		$form->setWhere(' desa_id = '.$desa_id);
	}
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','desa');
	$form->addInput('user_id','dropdown');
	$form->tableOptions('user_id','user','id','username');
	$form->setAttribute('user_id','disabled');
	$form->setLabel('user_id','pengguna');
}else{
	$form->setHeading('<a href="'.base_url('admin/potensi/edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');
	$form->setWhere(' desa_id = '.$desa_id);
}

$form->setNumbering(TRUE);
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detail');
$form->setLink('id',base_url('admin/potensi/detail/'),'id');

$form->addInput('item','plaintext');
$form->addInput('kategori','dropdown');
$form->setOptions('kategori',$kategori);
$form->setAttribute('kategori','disabled');

$form->addInput('produk_desa','dropdown');
$form->setOptions('produk_desa',['Tidak Ada','Ada']);
$form->setLabel('produk_desa','Produk Desa');
$form->setAttribute('produk_desa','disabled');

$form->addInput('satuan','dropdown');
$form->setOptions('satuan',$satuan);
$form->setAttribute('satuan','disabled');

$form->addInput('volume','plaintext');
$form->setType('volume','number');

$form->addInput('waktu','dropdown');
$form->setOptions('waktu',$waktu);
$form->setAttribute('waktu','disabled');
$form->setUrl('admin/potensi/clear_list');

if(is_desa())
{
	$form->setDelete(TRUE);
	$form->setEdit(TRUE);
}

$form->setFormName('potensi_form');
$form->form();