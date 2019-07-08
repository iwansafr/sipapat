<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kec_get = !empty($_GET['kec']) ? '?kec='.$_GET['kec'] : '';
if(!is_desa())
{
	?>
		<a href="<?php echo base_url('admin/perdes/kecamatan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
	<?php
}
$form = new zea();
$form->setTable('perdes');
$form->search();
$where = '';
if(!empty(@$_GET['kec']))
{
	$kecamatan = @$_GET['kec'];
	$where = " kecamatan = '{$kecamatan}'";
	
	$form->join('desa','ON(perdes.desa_id=desa.id)','perdes.*,desa.kecamatan');
}else if(is_kecamatan())
{
	$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
	$where = " kecamatan = '{$kecamatan}'";
	$form->join('desa','ON(perdes.desa_id=desa.id)','perdes.*,desa.kecamatan');
}
$form->setWhere($where);
$form->init('roll');
$form->addInput('id','hidden');
$form->setNumbering(TRUE);
$form->addInput('item','dropdown');
$form->setOptions('item',$perdes_options);
$form->setAttribute('item','disabled');
$form->addInput('no','plaintext');
$form->setLabel('no','Nomor');
$form->addInput('tgl_penetapan','plaintext');
$form->addInput('tgl_pelaksanaan','plaintext');
$form->addInput('progress','dropdown');
$form->setOptions('progress',$perdes_progress);
$form->setAttribute('progress','disabled');

if(!is_desa())
{
	$form->setDelete(TRUE);
	$form->setEdit(TRUE);
	$form->setEditLink(base_url('admin/perdes/edit?id='));
}

$form->setUrl('admin/perdes/clear_list');
$form->form();