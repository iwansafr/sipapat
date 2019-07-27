<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_kecamatan())
{
	$form = new zea();
	$form->setTable('posyantekdes');

	$form->init('edit');
	$form->addInput('nama','text');
	$form->setLabel('nama','nama posyantekdes');

	$id = @intval($_GET['id']);
	$form->setId($id);

	$form->addInput('user_id','static');
	$form->setValue('user_id',$user['id']);

	$desa_id = @intval($this->sipapat_model->get_desa_id());

	if(!empty($desa_id))
	{
		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$desa_id);
		$id = $this->posyantekdes_model->get_posyantekdes_id($desa_id);
		pr($id);
	}else{
		$form->addInput('desa_id','dropdown');
		$form->setOptions('desa_id',['0'=>'none']);
		$form->setLabel('desa_id','Desa');
		$posyantekdes = $this->posyantekdes_model->get_posyantekdes($id);
		if(!empty($posyantekdes))
		{
			?>
			<div class="hidden" id="current_desa_id" data-id="<?php echo $posyantekdes['desa_id'] ?>"></div>
			<?php
		}
	}

	$form->addInput('tgl_pendirian','text');
	$form->setLabel('tgl_pendirian','tgl pendirian');
	$form->setType('tgl_pendirian','date');
	$form->addInput('no_permakades','text');
	$form->setLabel('no_permakades','nomor permakades');
	$form->addInput('no_bdn_hkm','text');
	$form->setLabel('no_bdn_hkm','nomor badan hukum');
	$form->addInput('masa_berlaku','text');
	$form->setLabel('masa_berlaku','masa berlaku');
	$form->addInput('alamat','textarea');
	$form->setLabel('alamat','alamat');
	$form->addInput('pengurus','textarea');
	$form->setLabel('pengurus','pengurus');
	$form->addInput('jns_kegiatan','text');
	$form->setLabel('jns_kegiatan','jenis kegiatan');
	$form->addInput('TTG','text');
	$form->setLabel('TTG','TTG yg dihasilkan');

	$form->form();

}
