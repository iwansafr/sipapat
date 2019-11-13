<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kec_get = !empty($_GET['kec']) ? '?kec='.$_GET['kec'] : '';
?>
	<a href="<?php echo base_url('admin/survey/kecamatan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<a href="<?php echo base_url('admin/survey/chart').$kec_get; ?>" class="btn btn-sm btn-default"><i class="fa fa-chart-bar"></i> hasil</a>
<?php
if(!is_desa())
{
	$form = new zea();
	$opsi = ['belum','sudah'];
	$where = '';
	$form->init('roll');
	$form->setTable('survey_laptop');
	$form->setNumbering(TRUE);
	if(!empty(@$_GET['kec']))
	{
		$kecamatan = @$_GET['kec'];
		$where = " kecamatan = '{$kecamatan}'";
	}else if(is_kecamatan())
	{
		$kecamatan = str_replace('kec_','',$user['username']);
		$where = " kecamatan = '{$kecamatan}'";
	}
	$form->setWhere($where);
	$form->addInput('id','hidden');
	$form->search();
	// $form->setLabel('id','edit');
	// $form->setLink('id',base_url('admin/survey/detail'),'id');
	// $form->setPlainText('id','<i class="fa fa-eye"></i> detail');
	// $form->setAttribute('id',['class'=>'btn btn-default']);
	// $form->addInput('desa','plaintext');
	$form->addInput('desa','plaintext');
	$form->addInput('kecamatan','plaintext');
	$form->addInput('nama','plaintext');
	$form->addInput('op_sikeudes','plaintext');
	$form->setLabel('op_sikeudes','Operator Siskeudes');
	$form->addInput('jabatan','plaintext');
	$form->addInput('laptop','dropdown');
	$form->setAttribute('laptop','disabled');
	$form->setOptions('laptop',$opsi);
	$form->setLabel('laptop','punya laptop');
	$form->addInput('wifi','dropdown');
	$form->setAttribute('wifi','disabled');
	$form->setLabel('wifi','punya wifi');
	$form->setOptions('wifi',$opsi);
	$form->addInput('honor','dropdown');
	$form->setAttribute('honor','disabled');
	$form->setLabel('honor','dapat honor');
	$form->setOptions('honor',$opsi);
	$form->setDelete(TRUE);
	$form->setUrl('admin/survey/clear_list');
	$form->form();
}else{
	msg('anda tidak punya akses ke halaman ini','danger');
}