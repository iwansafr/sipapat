<hr>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($desa))
{
	$form = new zea();
	$form->init('edit');
	$form->setTable('corona');
	$form->setHeading('Data Orang Dalam Pengawasan');

	$form->addInput('nama','text');
	$form->addInput('rt','text');
	$form->setType('rt','number');
	$form->setlabel('rt','RT');
	$form->addInput('rw','text');
	$form->setType('rw','number');
	$form->setlabel('rw','RW');
	$form->addInput('umur','text');
	$form->setType('umur','number');
	$form->addInput('jk','dropdown');
	$form->setLabel('jk','Jenis Kelamin');
	$form->setOptions('jk',['1'=>'Laki-laki','2'=>'Perempuan']);
	$form->addInput('hp','text');
	$form->setLabel('hp','No Handphone');
	$form->setType('hp','number');
	
	$form->addInput('desa_id','static');
	$form->setValue('desa_id',$desa['id']);

	$form->addInput('dari','text');
	$form->setLabel('dari','Dari Negara / Daerah');
	$form->addInput('tgl','text');
	$form->setLabel('tgl','Tgl Kedatangan');
	$form->setType('tgl','date');
	$form->startCollapse('dari','riwayat perjalanan');
	$form->endCollapse('tgl');
	$form->setCollapse('dari');


	$form->addInput('demam','dropdown');
	$form->setOptions('demam',['Tidak','Iya']);
	$form->setLabel('demam','Apakah mengalami demam ?');

	$form->addInput('bpst','dropdown');
	$form->setOptions('bpst',['Tidak','Iya']);
	$form->setLabel('bpst','Apakah Batuk,Pilek, Sakit Tenggorokan ?');

	$form->addInput('sesak_nafas','dropdown');
	$form->setOptions('sesak_nafas',['Tidak','Iya']);
	$form->setLabel('sesak_nafas','Apakah mengalami sesak nafas ?');

	$form->addInput('no_keluhan','dropdown');
	$form->setOptions('no_keluhan',['1'=>'Iya','0'=>'Tidak']);
	$form->setLabel('no_keluhan','tidak ada keluhan');

	$form->addInput('pkdpc','dropdown');
	$form->setOptions('pkdpc',['Tidak','Iya']);
	$form->setLabel('pkdpc','Pernah Kontak dg Penderita Covid19 ?');

	$form->startCollapse('demam','Kondisi Saat Ini');
	$form->endCollapse('pkdpc');
	$form->setCollapse('demam');

	$form->addInput('tatalaksana','textarea');
	$form->setLabel('tatalaksana','Tatalaksana yg dilakukan');

	$form->addInput('keterangan','textarea');
	$form->setLabel('keterangan','keterangan (alasan penyebab mudik / pulang)');

	$form->addInput('status','static');
	$form->setValue('status',1);
	$form->setRequired('All');

	$form->form();
	if(!empty($this->input->post()))
	{
		$last_id = $form->get_insert_id();
		if(!empty($last_id))
		{
			header('Location: '.base_url('covid19/detail/'.$last_id));
		}
	}
}else{
	msg('Mohon Maaf Desa Tidak diketahui','danger');
}