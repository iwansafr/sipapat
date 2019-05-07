<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kelompok = empty($kelompok) ? 1: $kelompok;
$module = ['1'=>'','2'=>'bpd','3'=>'lpmp','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw'];
$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmp','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw'];
if(!empty($task) && in_array($task, $module))
{
	$kelompok = array_keys($module,$task);
	$kelompok = $kelompok[0];
}
if(is_admin() || is_root())
{
	?>
	<a href="<?php echo base_url('admin/perangkat/desa/'.$module[$kelompok]) ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> data perdesa</a>
	<?php
}
$form = new zea();
$form->init('roll');
// $form->setId(@intval($_GET['id']));
$ext = (!is_root() && !is_admin()) ? ' AND desa_id = '.$pengguna['desa_id'] : '';
if(!empty($_GET['desa_id']) && (is_root() || is_admin()))
{
	$ext = ' AND desa_id = '.@intval($_GET['desa_id']);
}
$form->search();
$form->setTable('perangkat_desa');
$form->setNumbering(TRUE);
$form->setWhere(' kelompok = '.$kelompok.' '.$ext);
$form->setHeading('<a href="'.base_url('admin/perangkat/'.$module[$kelompok].'/edit').'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
if(!is_root())
{
	$form->setAttribute('desa_id','disabled');
}
$form->setLabel('desa_id','Nama Desa');
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detail');
$form->setLink('id',base_url('admin/perangkat/'.$module[$kelompok].'/detail'),'id');
$form->setClearGet('id');
$form->addInput('nama','plaintext');
$form->addInput('foto','thumbnail');
$form->addInput('tempat_lahir','plaintext');
$form->setLabel('tempat_lahir','Tempat Lahir');
$form->addInput('tgl_lahir','plaintext');
$form->setLabel('tgl_lahir','Tanggal Lahir');
$form->setType('tgl_lahir','date');
$form->addInput('kelamin','dropdown');
$form->setLabel('kelamin','Jenis Kelamin');
$form->setOptions('kelamin',['Perempuan','Laki-laki']);
$form->setAttribute('kelamin','disabled');
$form->addInput('agama','dropdown');
$form->setOptions('agama',
	[
		'1'=>'Islam',
		'2'=>'Kristen',
		'3'=>'Katholik',
		'4'=>'Hindu',
		'5'=>'Budha',
		'6'=>'Khonghucu',
		'7'=>'Kepercayaan Terhadap Tuhan YME/Lainnya'
	]
);
$form->setAttribute('agama','disabled');

$form->addInput('status_perkawinan','dropdown');
$form->setLabel('status_perkawinan','Status Perkawinan');
$form->setOptions('status_perkawinan',['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin']);
$form->setAttribute('status_perkawinan','disabled');

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
$form->setAttribute('pendidikan_terakhir','disabled');

// $form->addInput('jamkes','plaintext');
// $form->setLabel('jamkes','Jaminan Kesehatan');
// $form->addInput('jabatan', 'dropdown');
// $form->setOptions('jabatan', $jabatan[1]);
// $form->setAttribute('jabatan','disabled');

$form->addInput('no_sk','plaintext');
// $form->setType('no_sk','number');
$form->setLabel('no_sk','Nomor SK');
$form->addInput('sk_penetapan_kembali','plaintext');
$form->setLabel('sk_penetapan_kembali','SK Penetapan Kembali');

$form->addInput('tgl_pelantikan','plaintext');
$form->setLabel('tgl_pelantikan','Tanggal Pelantikan');
$form->setType('tgl_pelantikan','date');
$form->addInput('akhir_masa_jabatan','plaintext');
$form->setLabel('akhir_masa_jabatan','Akhir Masa Jabatan');
$form->setType('akhir_masa_jabatan','date');
if(is_admin() || is_root())
{
	$form->addInput('user_id','dropdown');
	$form->tableOptions('user_id','user','id','username');
	$form->setAttribute('user_id','disabled');
	$form->setLabel('user_id','penginput');
}

// $form->addInput('pelantik','plaintext');
// $form->setLabel('pelantik','Pejabat Pelantik');
// $form->addInput('bengkok','plaintext');
// $form->setType('bengkok','number');
// $form->setLabel('bengkok','Luas Bengkok');
// $form->addInput('penghasilan','plaintext');
// $form->setType('penghasilan','number');
// $form->setLabel('penghasilan','Penghasilan Tetap');

// $form->addInput('riwayat_pendidikan','plaintext');
// $form->setLabel('riwayat_pendidikan','Riwayat Pendidikan');
// $form->addInput('riwayat_diklat','plaintext');
// $form->setLabel('riwayat_diklat','Riwayat Diklat');

$form->setFormName($module[$kelompok].'_desa_form');

$form->setUrl('admin/perangkat/clear_list/'.$module[$kelompok]);
$form->setEdit(TRUE);
$form->setDelete(TRUE);
$form->form();