<?php defined('BASEPATH') OR exit('No direct script access allowed');

// pr($desa_id,$user['id']);

if(is_desa() || is_root())
{
	$form = new zea();
	$id = @intval($_GET['id']);
	$form->init('edit');
	$form->setTable('potensi_desa');
	$form->setId($id);

	if(is_desa())
	{
		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$desa_id);
		$form->addInput('user_id','static');
		$form->setValue('user_id',$user['id']);
	}else{
		if(!empty($sipapat_config) && is_root())
		{
			$form->addInput('desa_id','dropdown');
			$form->setLabel('desa_id','desa');
			$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);
		}
	}

	$form->addInput('item','text');
	$form->addInput('kategori','dropdown');
	$form->setOptions('kategori',$kategori);

	$form->addInput('produk_desa','dropdown');
	$form->setOptions('produk_desa',['Tidak Ada','Ada']);
	$form->setLabel('produk_desa','Produk Desa');

	$form->addInput('doc','file');
	$form->setLabel('doc','Dokumentasi');
	$form->setAccept('doc','.png,.jpg,.gif,.jpeg,.bmp');

	$form->addInput('satuan','dropdown');
	$form->setOptions('satuan',$satuan);

	$form->addInput('volume','text');
	$form->setType('volume','number');

	$form->addInput('waktu','dropdown');
	$form->setOptions('waktu',$waktu);

	$form->addInput('from_month','dropdown');
	$form->setLabel('from_month','dari');
	$form->setOptions('from_month',$bulan);

	$form->addInput('to_month','dropdown');
	$form->setLabel('to_month','sampai');
	$form->setOptions('to_month',$bulan);

	$form->setFormName('potensi_form');
	if(empty($id))
	{
		$form->setRequired('All');
	}
	$form->form();
}else{
	msg('Maaf Hanya desa yg bisa mengakses halaman ini','danger');
}