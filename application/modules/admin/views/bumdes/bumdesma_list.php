<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="form-group">
	<div class="btn-group">
		<a class="btn btn-default btn-sm" href="<?php echo base_url('admin/bumdes/bumdesma_mandiri_sejahtera') ?>"><i class="fa fa-refresh"></i> reload</a>
	</div>
</div>
<?php
$form2 = new zea();
$form2->init('roll');
if(is_desa())
{
	$form2->setWhere('desa_id = '.@intval($pengguna['desa_id']));	
}
$form2->setTable('bumdesma');
$form2->setNumbering(true);
$form2->search();
$form2->addInput('id','hidden');
$form2->addInput('modal','plaintext');
$form2->setType('modal','number');
$form2->setLabel('modal','Penyertaan Modal');

$form2->addInput('sumber_dana', 'dropdown');
$form2->setOptions('sumber_dana',$sumber);
$form2->setLabel('sumber_dana','sumber dana');
$form2->setAttribute('sumber_dana', 'disabled');

$form2->addInput('th_anggaran','plaintext');
$form2->setLabel('th_anggaran','tahun anggaran');
$form2->setType('th_anggaran','number');

$form2->addInput('termin','dropdown');
$form2->setOptions('termin',['0'=>'None','1'=>'termin 1','2'=>'termin 2','3'=>'termin 3']);
$form2->setAttribute('termin', 'disabled');

if(is_desa())
{
	$form2->setEdit(true);
	$form2->setDelete(true);
	$form2->setEditLink(base_url('admin/bumdes/bumdesma_mandiri_sejahtera?id='));
}
$form2->setUrl('admin/bumdes/clear_bumdesma_mandiri_sejahtera');
$form2->setFormName('bumdesma_list');

$form2->form();