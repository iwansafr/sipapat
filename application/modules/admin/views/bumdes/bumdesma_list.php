<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (is_desa())
{
	?>
	<div class="form-group">
		<div class="btn-group">
	    <a href="#" type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	      <i class="fa fa-plus"></i> tambah baru
	      <span class="caret"></span>
	      <span class="sr-only">Toggle Dropdown</span>
	    </a>
	    <ul class="dropdown-menu" role="menu">
	      <li><a href="<?php echo base_url('admin/bumdes/bumdesma_mandiri_sejahtera?sumber=dd') ?>">DD</a></li>
	      <li class="divider"></li>
	      <li><a href="<?php echo base_url('admin/bumdes/bumdesma_mandiri_sejahtera?sumber=other') ?>">Lainnya</a></li>
	    </ul>
	    <hr>
	  </div>
	</div>
	<?php
}
$form2 = new zea();
$form2->init('roll');
if(is_desa())
{
	$form2->setWhere('desa_id = '.@intval($pengguna['desa_id']));	
}
$form2->setHeading('<a class="btn btn-default btn-sm" href="'.base_url('admin/bumdes/bumdesma_mandiri_sejahtera').'"><i class="fa fa-refresh"></i> reload</a>');
$form2->setTable('bumdesma');
$form2->setNumbering(true);
$form2->search();
$form2->addInput('id','link');
$form2->setLabel('id','detail');
$form2->setLink('id',base_url('admin/bumdes/bumdesma_mandiri_sejahtera_detail'),'id');
$form2->setPlainText('id','detail');
$form2->addInput('modal','plaintext');
$form2->setType('modal','number');
$form2->setLabel('modal','Penyertaan Modal');

$form2->addInput('desa_id','dropdown');
$form2->tableOptions('desa_id','desa','id','nama');
$form2->setAttribute('desa_id','disabled');
$form2->setLabel('desa_id','desa');

$form2->addInput('sumber_dana', 'dropdown');
$form2->setOptions('sumber_dana',$sumber);
$form2->setLabel('sumber_dana','sumber dana');
$form2->setAttribute('sumber_dana', 'disabled');

$form2->addInput('th_anggaran','plaintext');
$form2->setLabel('th_anggaran','tahun anggaran');
$form2->setType('th_anggaran','number');

$form2->addInput('termin','dropdown');
$form2->setOptions('termin',$this->bumdes_model->termin());
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