<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_admin())
{
	$kelompok = empty($kelompok) ? 1: $kelompok;
	$module = ['1'=>'','2'=>'bpd','3'=>'lpmp','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw'];
	$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmp','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw'];
	$form = new zea();
	$form->init('edit');
	$form->setId(@intval($_GET['id']));
	$form->setTable('perangkat_desa');
	$form->addInput('desa_id','static');
	$form->setValue('desa_id', @$pengguna['desa_id']);
	$form->setHeading($module_title[$kelompok].' Desa '.@$pengguna['username']);
	$form->addInput('kelompok','static');
	$form->setValue('kelompok',$kelompok);
	$form->addInput('nama','text');
	$form->addInput('foto','upload');
	$form->setAccept('foto', '.jpg,.jpeg,.png');
	$form->addInput('tempat_lahir','text');
	$form->setLabel('tempat_lahir','Tempat Lahir');
	$form->addInput('tgl_lahir','text');
	$form->setLabel('tgl_lahir','Tanggal Lahir');
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

	$form->addInput('no_sk','text');
	$form->setType('no_sk','number');
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
	$form->addInput('bengkok','text');
	$form->setType('bengkok','number');
	$form->setLabel('bengkok','Luas Bengkok');
	$form->addInput('penghasilan','text');
	$form->setType('penghasilan','number');
	$form->setLabel('penghasilan','Penghasilan Tetap');

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
	$form->form();
}