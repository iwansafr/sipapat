<?php defined('BASEPATH') OR exit('No direct script access allowed');

$kelompok = empty($kelompok) ? 1: $kelompok;
$module = ['1'=>'','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
if(!is_admin() && !is_kecamatan())
{
	$form = new zea();
	$form->init('edit');
	$form->setId(@intval($_GET['id']));
	$form->setTable('perangkat_desa');
	if(is_desa())
	{
		$form->setWhere(' AND desa_id = '.@intval($pengguna['desa_id']));
		$form->addInput('desa_id','static');
		$form->setValue('desa_id', @$pengguna['desa_id']);
	}else{
		$form->addInput('desa_id','dropdown');
		$form->tableOptions('desa_id','desa','id','nama');
		$form->setLabel('desa_id','nama desa');
	}
	$form->setHeading($module_title[$kelompok].' Desa '.@$pengguna['username']);
	$form->addInput('kelompok','static');
	$form->setValue('kelompok',$kelompok);
	$form->addInput('nik','text');
	$form->setType('nik','number');
	$form->setLabel('nik','NIK');
	$form->addInput('nama','text');
	$form->addInput('foto','upload');
	$form->setAccept('foto', '.jpg,.jpeg,.png');
	$form->addInput('tempat_lahir','text');
	$form->setLabel('tempat_lahir','Tempat Lahir');
	$form->addInput('tgl_lahir','text');
	$form->setLabel('tgl_lahir','Tanggal Lahir');
	// $form->setAttribute('tgl_lahir',['class'=>'form-control','data-date'=>"", 'data-date-format'=>"DD MMMM YYYY"]);
	$form->setType('tgl_lahir','date');
	$form->addInput('kelamin','radio');
	$form->setLabel('kelamin','Jenis Kelamin');
	$form->setRadio('kelamin',['Perempuan','Laki-laki']);

	$form->addInput('alamat','textarea');
	$form->addInput('telepon','text');
	$form->setType('telepon','number');

	$form->addInput('agama','dropdown');
	$form->setOptions('agama',
		[
			'1'=>'Islam',
			'2'=>'Kristen',
			'3'=>'Katholik',
			'4'=>'Hindu',
			'5'=>'Budha',
			'6'=>'Khonghucu',
			'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
		]
	);
	$form->addInput('status_perkawinan','radio');
	$form->setLabel('status_perkawinan','Status Perkawinan');
	$form->setRadio('status_perkawinan',['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin']);

	$form->addInput('pendidikan_terakhir','dropdown');
	$form->setLabel('pendidikan_terakhir','Pendidikan Terakhir');
	$form->setOptions('pendidikan_terakhir',
		[
			'1'=>strtoupper('akademi/diploma iii/s.muda'),
			'2'=>strtoupper('belum tamat sd/sederajat'),
			'3'=>strtoupper('diploma i/ii'),
			'4'=>strtoupper('diploma iv/strata i'),
			'5'=>strtoupper('slta/sederajat'),
			'6'=>strtoupper('sltp/sederajat'),
			'7'=>strtoupper('strata ii'),
			'8'=>strtoupper('strata iii'),
			'9'=>strtoupper('tamat sd/sederajat'),
			'10'=>strtoupper('tidak/belum sekolah')
		]
	);
	if(!empty($jabatan[$kelompok]))
	{
		$form->addInput('jamkes','text');
		$form->setLabel('jamkes','Jaminan Kesehatan');
		$form->addInput('jabatan', 'dropdown');
		$form->setOptions('jabatan', $jabatan[$kelompok]);
	}
	$penghasilan_title = 'Insentif Pertahun';
	if($module_title[$kelompok] == 'rt' || $module_title[$kelompok] == 'rw')
	{
		$form->addInput('rw','text');
		$form->setType('rw','number');
		$form->setLabel('rw','Ketua RW');
		if($module_title[$kelompok] == 'rt')
		{
			$form->addInput('rt','text');
			$form->setType('rt','number');
			$form->setLabel('rt','Ketua RT');
			$form->setLabel('rw','Wilayah RW');
		}
	}else if($kelompok == 1){
		$penghasilan_title = 'Gaji';
		$form->setType('bengkok','number');
		$form->setLabel('bengkok','Luas Bengkok');
		$form->setAttribute('bengkok',['placeholder'=>'Meter']);
		$form->addInput('bengkok','text');
	}

	$form->addInput('no_sk','text');
	// $form->setType('no_sk','number');
	$form->setLabel('no_sk','Nomor SK');
	$form->addInput('sk_penetapan_kembali','text');
	$form->setLabel('sk_penetapan_kembali','SK Penetapan Kembali');

	$form->addInput('tgl_pelantikan','text');
	$form->setLabel('tgl_pelantikan','Tanggal Pelantikan');
	$form->setType('tgl_pelantikan','date');
	$form->addInput('akhir_masa_jabatan','text');
	$form->setLabel('akhir_masa_jabatan','Akhir Masa Jabatan');
	$form->setType('akhir_masa_jabatan','date');

	$form->addInput('pelantik','text');
	$form->setLabel('pelantik','Pejabat Pelantik');
	$form->addInput('penghasilan','text');
	$form->setType('penghasilan','number');
	$form->setLabel('penghasilan',$penghasilan_title);

	$form->addInput('riwayat_pendidikan','textarea');
	$form->setLabel('riwayat_pendidikan','Riwayat Pendidikan');
	$form->addInput('riwayat_diklat','textarea');
	$form->setLabel('riwayat_diklat','Riwayat Diklat');

	$form->setFormName('perangkat_desa_form');
	if(!empty(@$user['id']))
	{
		$form->addInput('user_id','static');
		$form->setValue('user_id',$user['id']);
	}
	$data = $form->getData();
	if(empty($data) && !empty($_GET['id']))
	{
		msg('Anda tidak punya Akses ke halaman ini', 'danger');
		exit();
	}
	$form->form();
}else{
	msg('hanya petugas desa yang bisa menambah '.$module_title[$kelompok],'danger');
}