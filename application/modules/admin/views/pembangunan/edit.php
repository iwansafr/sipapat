<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_GET['id']))
{
	?>
	<a class="btn btn-warning btn-sm" href="<?php echo base_url('admin/pembangunan/buat');?>"><i class="fa fa-arrow-left"></i>Kembali</a>
	<?php
}else{
	?>
	<a class="btn btn-warning btn-sm" href="<?php echo base_url('admin/pembangunan/edit_gambar?id='.@intval($_GET['id']));?>"><i class="fa fa-pencil-alt"></i>Perbarui Gambar</a>
	<?php
}
if(!empty($view) || is_desa() || is_root())
{
	$id   = @intval($_GET['id']);
	$form = new zea();
	$form->setTable('pembangunan');
	$form->init('edit');
	$form->setId($id);
	if(!empty($id))
	{
		$data = $form->getData();
	}

	$data = array();
	if(!empty($id))
	{
		$data = $form->getData();
	}
	$form->addInput('item','text');
	if((!empty($_GET['bankeu_prov']) || (@$data['sumber_dana']=='4') && @$data['jenis']==1)){
		$sumber = ['4'=>$sumber['4']];
	}else if(!empty($_GET['bankeu_kab']) || (@$data['sumber_dana']=='5')){
		$sumber = ['5'=>$sumber['5']];
	}else if(!empty($_GET['dd']) || (@$data['sumber_dana']=='1')){
		$sumber = ['1'=>$sumber['1']];
	}else{
		// if($view == 'fisik' || @$data['jenis']==1)
		// {
		// 	unset($sumber['4']);
		// }
		unset($sumber['4']);
		unset($sumber['5']);
		unset($sumber['1']);
		pr($sumber);
	}

	$form->addInput('sumber_dana','dropdown');
	$form->setOptions('sumber_dana', $sumber);
	$form->setLabel('sumber_dana', 'Sumber Dana');

	if((!empty($_GET['dd']) || (@$data['sumber_dana']=='1')))
	{
		$form->addInput('tahap','dropdown');
		$form->setOptions('tahap', ['1'=>'Tahap I','2'=>'Tahap II','3'=>'Tahap III']);
	}

	if(count($sumber) > 1)
	{
		$sumber_alt = array();
		$sumber_alt[0] = 'TIDAK ADA';
		$sumber_alt = array_merge($sumber_alt,$sumber);
		$form->addInput('sumber_dana_alt','dropdown');
		$form->setOptions('sumber_dana_alt', $sumber_alt);
		$form->setLabel('sumber_dana_alt', 'Sumber Dana Kedua');
	}

	$form->addInput('bidang','dropdown');
	$form->setOptions('bidang', $bidang);

	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa_id);

	$form->addInput('user_id','static');
	$form->setValue('user_id',@intval($user['id']));

	$form->addInput('anggaran','text');
	$form->setType('anggaran','number');
	$form->setAttribute('anggaran',['oninvalid'=>"this.setCustomValidity('Anggaran tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);

	$form->addInput('realisasi','text');
	$form->setType('realisasi','number');
	$form->setAttribute('realisasi',['oninvalid'=>"this.setCustomValidity('Realisasi tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);

	$form->addInput('lokasi','textarea');
	$form->setAttribute('lokasi',['placeholder'=>"Dukuh : ...\nRT : ...\nRW : ..."]);
	if(empty($id))
	{
		$form->setValue('lokasi',strtoupper("Dukuh : ...\nRT : ...\nRW : ..."));
	}

	$file_type = empty($id) ? 'file' : 'thumbnail';

	if($view == 'fisik' || @$data['jenis'] == 1)
	{
		$form->addInput('vol','textarea');
		$form->setLabel('vol','Volume');
		$form->setAttribute('vol',['placeholder'=>"Panjang : ...m\nLebar : ...m\nTinggi : ...m\nTebal : ...m"]);
		if(empty($id))
		{
			$form->setValue('vol', strtoupper("Panjang : ...m\nLebar : ...m\nTinggi : ...m\nTebal : ...m"));
		}

		$form->addInput('from_date','text');
		$form->setLabel('from_date','dari tgl');
		$form->setType('from_date','date');
		$form->addInput('to_date','text');
		$form->setLabel('to_date','sampai tgl');
		$form->setType('to_date','date');
		$this->esg->add_js(base_url('assets/pembangunan/script.js'));
		if((!empty($_GET['bankeu_prov']) || !empty($_GET['bankeu_kab'])) || (@$data['sumber_dana'] == 4 || @$data['sumber_dana'] == 5) ){
			$form->addInput('doc_0',$file_type);
			$form->setLabel('doc_0','Dokumantasi 0 %');
			$form->addInput('doc_50',$file_type);
			$form->setLabel('doc_50','Dokumantasi 50 %');
			$form->addInput('doc_100',$file_type);
			$form->setLabel('doc_100','Dokumantasi 100 %');
			if(empty($id))
			{
				$form->setAttribute('doc_0',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				$form->setAttribute('doc_50',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				$form->setAttribute('doc_100',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				// $form->setRequired(['doc_0','doc_50','doc_100','anggaran']);
			}
		}else{
			$form->addInput('doc_0',$file_type);
			$form->setLabel('doc_0','Dokumantasi 0 %');
			$form->addInput('doc_40',$file_type);
			$form->setLabel('doc_40','Dokumantasi 40 %');
			$form->addInput('doc_80',$file_type);
			$form->setLabel('doc_80','Dokumantasi 80 %');
			$form->addInput('doc_100',$file_type);
			$form->setLabel('doc_100','Dokumantasi 100 %');
			if(empty($id))
			{
				$form->setAttribute('doc_0',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				$form->setAttribute('doc_40',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				$form->setAttribute('doc_80',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				$form->setAttribute('doc_100',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
				// $form->setRequired(['doc_0','doc_40','doc_80','doc_100','anggaran']);
			}
		}
	}else{
		$form->addInput('date','text');
		$form->setType('date','date');
		$form->setLabel('date','tgl Pelaksanaan');
		$form->addInput('peserta','multiselect');
		$form->setHelp('peserta','CTRL+click untuk memilih lebih dari 1 peserta');
		$form->setMultiSelect('peserta',$peserta, 'id,par_id,title');
		$form->addInput('jml_peserta','text');
		$form->setType('jml_peserta','number');
		$form->setLabel('jml_peserta','Jumlah Peserta');
		$form->addInput('jenis','static');
		$form->setValue('jenis',0);
		$form->addInput('doc',$file_type);
		$form->setLabel('doc','Foto Kegiatan');
		$form->setAttribute('doc',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
		$form->setRequired(['doc','anggaran','peserta']);
		$form->addInput('tahap','dropdown');
		$form->setOptions('tahap', ['-1'=>'1 X tahapan','1'=>'Kegiatan Tahap 1','2'=>'Kegiatan Tahap 2','3'=>'Kegiatan Tahap 3']);
	}

	$form->addInput('th_anggaran','text');
	$form->setLabel('th_anggaran','Tahun Anggaran');
	$form->setType('th_anggaran','number');

	$form->addInput('koordinat','hidden');
	if(empty($id))
	{
		$form->setRequired('All');
	}

	$form->form();
}else{
	msg('Maaf URL yg anda tuju tidak valid', 'danger');
}