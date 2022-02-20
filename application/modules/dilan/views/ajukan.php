<?php defined('BASEPATH') or exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url() . '_dilan_config');
$dilan_config = $this->esg->get_config($paramname);
?>
<style>
	body {
		background-image: url(<?php echo image_module('config', $paramname . '/' . $dilan_config['image_light']) ?>);
		background-size: cover;
	}
</style>
<?php
$form = new zea();

if (!empty($desa_id)) {
	$form->init('edit');
	$form->setTable('penduduk');
	$form->setHeading('Ajukan Data Penduduk');
	$form->setEditStatus(FALSE);

	$form->addInput('desa_id', 'static');
	$form->setValue('desa_id', $desa_id['id']);

	$form->addInput('no_kk', 'text');
	$form->setLabel('no_kk', 'Nomor KK');
	$form->addInput('nik', 'text');
	$form->setLabel('nik', 'NIK');
	$form->setUnique(array('nik'), '{value} sudah terdaftar sbg {table}');
	$form->addInput('no_paspor', 'text');
	$form->setLabel('no_paspor', 'Nomor Passpor');
	$form->addInput('nama', 'text');
	$form->setLabel('nama', 'Nama Lengkap');
	$form->addInput('jk', 'dropdown');
	$form->setLabel('jk', 'Jenis Kelamin');
	$form->setOptions('jk', ['1' => 'LAKI-LAKI', '2' => 'PEREMPUAN']);
	$form->addInput('tmpt_lhr', 'text');
	$form->setLabel('tmpt_lhr', 'Tempat Lahir');
	$form->addInput('tgl_lhr', 'text');
	$form->setLabel('tgl_lhr', 'Tgl lahir');
	$form->setType('tgl_lhr', 'date');
	$form->addInput('gdr', 'dropdown');
	$form->setLabel('gdr', 'Golongan Darah');
	$form->setLabel('gdr', 'golongan darah');;
	$form->setOptions('gdr', $this->dilan_model->golongan_darah());
	$form->addInput('agama', 'dropdown');
	$form->setLabel('agama', 'Agama');
	$form->setOptions('agama', $this->dilan_model->agama());

	$form->addInput('agama_lainnya', 'text');
	$form->setLabel('agama_lainnya', 'Agama Lainnya');
	$form->setLabel('agama_lainnya', 'sebutkan (jika anda memilih penghayat kepercayaan atau lainnya)*');;

	$form->startCollapse('agama', 'agama');
	$form->endCollapse('agama_lainnya');
	$form->setCollapse('agama', TRUE);

	$form->addInput('status', 'dropdown');
	$form->setLabel('status', 'Status');
	$form->setOptions('status', $this->dilan_model->status());
	$form->addInput('no_akta_kwn', 'text');
	$form->setLabel('no_akta_kwn', 'Nomor Akta Buku Nikah');
	$form->addInput('no_akta_crai', 'text');
	$form->setLabel('no_akta_crai', 'Nomor Akta Cerai');
	$form->addInput('shdk', 'dropdown');
	$form->setLabel('shdk', 'Status Hubungan Dalam Keluarga');
	$form->setOptions('shdk', $this->dilan_model->shdk());
	// $form->addInput('shdrt','dropdown');
	// $form->setOptions('shdrt',$this->dilan_model->shdrt());
	// $form->setLabel('shdrt','');
	$form->addInput('pnydng_cct', 'dropdown');
	$form->setLabel('pnydng_cct', 'Penyandang Cacat');
	$form->setOptions('pnydng_cct', $this->dilan_model->cacat());
	$form->addInput('pddk_akhir', 'dropdown');
	$form->setLabel('pddk_akhir', 'Pendidikan Terakhir');
	$form->setOptions('pddk_akhir', $this->dilan_model->pendidikan());
	$form->addInput('pekerjaan', 'dropdown');
	$form->setLabel('pekerjaan', 'Pekerjaan');
	$form->setOptions('pekerjaan', $this->dilan_model->pekerjaan());
	$form->addInput('nama_ibu', 'text');
	$form->setLabel('nama_ibu', 'Nama Ibu');
	$form->addInput('nama_ayah', 'text');
	$form->setLabel('nama_ayah', 'Nama Ayah');
	$form->addInput('nama_kep_kel', 'text');
	$form->setLabel('nama_kep_kel', 'Nama Kepala Keluarga');
	$form->addInput('alamat', 'text');
	$form->setLabel('alamat', 'Alamat');
	$form->addInput('no_rt', 'text');
	$form->setLabel('no_rt', 'Nomor RT');
	$form->addInput('no_rw', 'text');
	$form->setLabel('no_rw', 'Nomor RW');
	$form->addInput('aktif', 'static');
	$form->setValue('aktif', '2');
	$form->setRequired('All');
	// $form->setDarkMode(true);

?>
	<div class="container mt-2">
		<a class="btn btn-secondary" href="<?php echo base_url('dilan/search/' . @intval($desa_id['id'])); ?>">Cari Nik</a>
		<?php $form->form(); ?>
	</div>
<?php
} else {
?>
	<div class="container mt-2">
		<?php msg('Terjadi Keasalahan, Silahkan Hubungi Petugas', 'danger'); ?>
	</div>
<?php
}
