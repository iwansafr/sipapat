<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_GET['id']))
{
	?>
	<a class="btn btn-warning btn-sm" href="<?php echo base_url('admin/pembangunan/buat');?>"><i class="fa fa-arrow-left"></i>Kembali</a>
	<?php
}
if(!empty($view) || is_desa() || is_root())
{
	$id   = @intval($_GET['id']);
	$form = new zea();
	$form->setTable('pembangunan');
	$form->init('edit');
	$form->setId($id);

	$data = array();
	if(!empty($id))
	{
		$data = $form->getData();
	}
	$form->addInput('item','text');
	
	if(!empty($_GET['bankeu_prov'])){
		$sumber = ['4'=>$sumber['4']];
	}else if(!empty($_GET['bankeu_kab'])){
		$sumber = ['5'=>$sumber['5']];
	}else{
		unset($sumber['4']);
		unset($sumber['5']);
	}

	$form->addInput('sumber_dana','dropdown');
	$form->setOptions('sumber_dana', $sumber);
	$form->setLabel('sumber_dana', 'Sumber Dana');

	$form->addInput('bidang','dropdown');
	$form->setOptions('bidang', $bidang);

	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);

	$form->addInput('user_id','static');
	$form->setValue('user_id',@intval($user['id']));

	$form->addInput('anggaran','text');
	$form->setType('anggaran','number');

	$form->addInput('lokasi','text');

	if($view == 'fisik' || @$data['jenis'] == 1)
	{
		$form->addInput('vol','textarea');
		$form->setLabel('vol','Volume');
		$form->setAttribute('vol',['placeholder'=>"Panjang : ...m\nLebar : ...m\nTinggi : ...m"]);
		if(!empty($_GET['bankeu_prov']) || !empty($_GET['bankeu_kab'])){
			$form->addInput('doc_0','file');
			$form->setLabel('doc_0','Dokumantasi 0 %');
			$form->addInput('doc_50','file');
			$form->setLabel('doc_50','Dokumantasi 50 %');
			$form->addInput('doc_100','file');
			$form->setLabel('doc_100','Dokumantasi 100 %');
		}else{
			$form->addInput('doc_0','file');
			$form->setLabel('doc_0','Dokumantasi 0 %');
			$form->addInput('doc_40','file');
			$form->setLabel('doc_40','Dokumantasi 40 %');
			$form->addInput('doc_80','file');
			$form->setLabel('doc_80','Dokumantasi 80 %');
			$form->addInput('doc_100','file');
			$form->setLabel('doc_100','Dokumantasi 100 %');
		}
	}else{
		$form->addInput('peserta','text');
		$form->addInput('jenis','static');
		$form->setValue('jenis',0);
		$form->addInput('doc','file');
		$form->setLabel('doc','Foto Kegiatan');
		$form->addInput('tahap','dropdown');
		$form->setOptions('tahap', ['-1'=>'1 X tahapan','1'=>'Kegiatan Tahap 1','2'=>'Kegiatan Tahap 2','3'=>'Kegiatan Tahap 3']);
	}

	$form->addInput('th_anggaran','text');
	$form->setLabel('th_anggaran','Tahun Anggaran');
	$form->setType('th_anggaran','number');


	$form->form();
}else{
	msg('Maaf URL yg anda tuju tidak valid', 'danger');
}