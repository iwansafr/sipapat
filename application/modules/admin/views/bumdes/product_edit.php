<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<a href="<?php echo base_url('admin/bumdes/product_list/').@intval($cat_id) ?>" class="btn btn-sm btn-default pull-right"><i class='fa fa-list'></i></a>
<?php

$form = new zea();
$form->init('edit');

$form->setTable('bumdes_product');

$form->setHeading('produk bumdes');

if(!empty($desa_id))
{
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);
}else{
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
}
$form->setLabel('desa_id','desa');

$form->addInput('cat_ids','multiselect');
$form->setLabel('cat_ids','kategori');
$form->setMultiSelect('cat_ids','bumdes_product_cat','id,title');

$form->addInput('title','text');
$form->setLabel('title','nama produk');

$form->addInput('description','textarea');
$form->setLabel('description','deskripsi produk');

$form->addInput('price','text');
$form->setType('price','number');
$form->setLabel('price','harga');

$form->addInput('image','file');
$form->setLabel('image','foto produk');

$form->addInput('length','text');
$form->setType('length','number');
$form->setLabel('length','panjang');

$form->addInput('width','text');
$form->setType('width','number');
$form->setLabel('width','lebar');

$form->addInput('height','text');
$form->setType('height','number');
$form->setLabel('height','tinggi');

$form->startCollapse('length','volume');
$form->endCollapse('height');
$form->setCollapse('length',TRUE);

$form->addInput('weight','text');
$form->setType('weight','number');
$form->setLabel('weight','berat');

$form->addInput('license_number','text');
$form->setLabel('license_number','nomor surat izin yg dimiliki');

$form->addInput('hp','text');
$form->setLabel('hp','No Hp');

$form->addInput('period_start','text');
$form->setLabel('period_start','mulai tgl');
$form->setType('period_start','date');

$form->addInput('period_end','text');
$form->setLabel('period_end','sampai tgl');
$form->setType('period_end','date');

$form->startCollapse('period_start','periode produk bisa dibeli');
$form->endCollapse('period_end');
$form->setCollapse('period_start',true);
$form->form();