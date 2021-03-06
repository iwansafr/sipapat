<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($bumdes_id)  && is_desa()){
	msg('anda belum memiliki bumdes, silahkan mengisi data bumdes terlebih dahulu <a class="btn btn-sm btn-primary" href="'.base_url('admin/bumdes/edit').'">di sini</a>','danger');
	die();
}
$form = new zea();

$form->init('roll');

$form->search();
$form->addInput('id','hidden');

$form->setNumbering(TRUE);


if(is_desa())
{
	$form->setWhere('bumdes_id = '.@intval($bumdes_id));
	$form->setHeading('<a href="'.base_url('admin/bumdes/lembaga_edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');
}else{
	?>
		<a href="<?php echo base_url('admin/bumdes/kecamatan_lembaga/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
	$kecamatan = @$_GET['kec'];
	if(!empty($kecamatan))
	{
		$where = " kecamatan = '{$kecamatan}'";
		$form->join('bumdes','ON(bumdes.id=bumdes_kelembagaan.bumdes_id)','bumdes_kelembagaan.*,bumdes.nama,desa.kecamatan,desa.nama AS nama_desa','desa','ON(desa.id=bumdes.desa_id)');
		$form->setWhere($where);
		$form->addInput('kecamatan','plaintext');
		$form->addInput('nama_desa','plaintext');
	}
}


$form->setTable('bumdes_kelembagaan');
$form->addInput('no','plaintext');
$form->setLabel('no','nomor lembaga');

$form->addInput('bumdes_id','dropdown');
$form->tableOptions('bumdes_id','bumdes','id','nama');
$form->setAttribute('bumdes_id','disabled');
$form->setLabel('bumdes_id','nama bumdes');

$form->addInput('investor_lk','plaintext');
$form->setType('investor_lk','number');
$form->setlabel('investor_lk','Investor Laki-laki');

$form->addInput('investor_pr','plaintext');
$form->setType('investor_pr','number');
$form->setlabel('investor_pr','Investor Perempuan');

$form->addInput('jml_investor','plaintext');
$form->setType('jml_investor','number');
$form->setlabel('jml_investor','Jumlah Investor');

$form->addInput('manajer_lk','plaintext');
$form->setType('manajer_lk','number');
$form->setlabel('manajer_lk','manajer Laki-laki');

$form->addInput('manajer_pr','plaintext');
$form->setType('manajer_pr','number');
$form->setlabel('manajer_pr','manajer Perempuan');

$form->addInput('jml_manajer','plaintext');
$form->setType('jml_manajer','number');
$form->setlabel('jml_manajer','Jumlah manajer');

$form->addInput('karyawan_lk','plaintext');
$form->setType('karyawan_lk','number');
$form->setlabel('karyawan_lk','karyawan Laki-laki');

$form->addInput('karyawan_pr','plaintext');
$form->setType('karyawan_pr','number');
$form->setlabel('karyawan_pr','karyawan Perempuan');

$form->addInput('jml_karyawan','plaintext');
$form->setType('jml_karyawan','number');
$form->setlabel('jml_karyawan','Jumlah karyawan');


$form->addInput('lpj_terakhir','plaintext');
$form->setType('lpj_terakhir','date');
$form->setLabel('lpj_terakhir','lpj terakhir');

$form->setUrl('admin/bumdes/lembaga_list');

if(is_root() || is_desa() || is_bumdes())
{
	$form->setDelete(true);
	$form->setEdit(true);
}

$form->setEditLink(base_url('admin/bumdes/lembaga_edit?id='));

$form->form();