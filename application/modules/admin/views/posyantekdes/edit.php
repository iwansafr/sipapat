<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_kecamatan())
{
	if(!empty($id)){
		echo '<a href="'.base_url('admin/posyantekdes/pengurus/').$id.'" class="btn btn-warning"><i class="fa fa-pencil-alt"></i> Pengurus</a>';		
	}
	echo ' | <a class="btn btn-warning" href="'.base_url('admin/posyantekdes').'"><i class="fa fa-backward"></i> kembali</a>';
	$form = new zea();
	$form->setTable('posyantekdes');

	$form->init('edit');
	$form->addInput('nama','text');
	$form->setLabel('nama','nama posyantekdes');

	$form->setId($id);

	$form->addInput('user_id','static');
	$form->setValue('user_id',$user['id']);

	if(!empty($pengguna['desa_id']))
	{
		$form->addInput('desa_id','static');
		$form->setValue('desa_id',$pengguna['desa_id']);
	}else{
		$form->addInput('desa_id','dropdown');
		$form->setOptions('desa_id',['0'=>'none']);
		$form->setLabel('desa_id','Desa');
		if(!empty($id))
		{
			$posyantekdes = $form->getData();
			if(is_desa())
			{
				if($pengguna['desa_id'] != $posyantekdes['desa_id']){
					msg('anda tidak punya akses ke halaman ini','danger');
					die();
				}
			}
			if(!empty($posyantekdes))
			{
				?>
				<div class="hidden" id="current_desa_id" data-id="<?php echo $posyantekdes['desa_id'] ?>"></div>
				<?php
			}
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
	// $form->addInput('pengurus','textarea');
	// $form->setLabel('pengurus','pengurus');

	// $form->setHelp('pengurus','nyalakan capslock saat mengetik');
	// if(empty($id))
	// {
	// 	$form->setValue('pengurus', 
	// 		"KETUA : -\nNO HP KETUA : -\nDOMISILI KETUA: -\nSK KETUA : -\nSEKRETARIS : -\nNO HP SEKRETARIS : -\nDOMISILI SEKRETARIS: -\nSK SEKRETARIS : -\nSEKSI PELAYANAN & USAHA TTG : -\nNO HP SEKSI PELAYANAN & USAHA TTG : -\nDOMISILI SEKSI PELAYANAN & USAHA TTG: -\nSK SEKSI PELAYANAN & USAHA TTG : -\nSEKSI KEMITRAAN : -\nNO HP SEKSI KEMITRAAN : -\nDOMISILI SEKSI KEMITRAAN: -\nSK SEKSI KEMITRAAN : -\nSEKSI PENGEMBANGAN TTG : -\nNO HP SEKSI PENGEMBANGAN TTG : -\nDOMISILI SEKSI PENGEMBANGAN TTG: -\nSK SEKSI PENGEMBANGAN TTG : -\n");
	// }
	$form->addInput('jns_kegiatan','text');
	$form->setLabel('jns_kegiatan','jenis kegiatan');
	$form->addInput('TTG','text');
	$form->setLabel('TTG','TTG yg dihasilkan');

	$form->form();

}
