<?php defined('BASEPATH') OR exit('No direct script access allowed');

$is_kecamatan = is_kecamatan();
$is_admin     = is_admin();
$is_root      = is_root();
$is_desa      = is_desa();

if($is_admin || $is_root || $is_kecamatan || $is_desa)
{
	$form = new zea();
	$form->init('roll');
	$form->setTable('corona_posko');
	$form->search();

	if($is_kecamatan)
	{
		if(!empty($user['pengguna']['district_id']))
		{
			$form->join('desa','ON(desa.id = corona_posko.desa_id)','desa.district_id,corona_posko.id,corona_posko.desa_id,corona_posko.alamat,corona_posko.pj,corona_posko.hp');
			$form->setWhere('desa.district_id = '.$user['pengguna']['district_id']);
		}
	}
	if($is_desa)
	{
		$form->setWhere('desa_id = '.$user['pengguna']['desa_id']);
	}
	$form->setNumbering(true);
	$form->addInput('id','plaintext');
	$form->setLabel('id','detail');
	$form->setPlainText('id',[base_url('admin/corona/posko_detail/{desa_id}')=>'Detail']);
	if(!empty($sipapat_config))
	{
		$form->addInput('desa_id','dropdown');
		$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id'],'kecamatan');
		$form->setAttribute('desa_id','disabled');
		$form->setLabel('desa_id','desa');
	}
	$form->addInput('alamat','plaintext');
	$form->addInput('pj','plaintext');
	$form->setLabel('pj','penanggung jawab');

	$form->addInput('hp','plaintext');
	$form->setLabel('hp','Nomor Hp');

	$form->addInput('peralatan','plaintext');

	$form->addInput('kegiatan','plaintext');

	$form->setDataTable(true);
	if(is_root())
	{
		$form->setDelete(true);
	}
	$form->form();
	?>
	<div class="hidden">
		<?php pr($form->getData()) ?>
	</div>
	<?php

}