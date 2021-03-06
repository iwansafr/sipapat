<?php defined('BASEPATH') or exit('No direct script access allowed');
$id = @intval($_GET['id']);
if (is_root() || is_admin() || (@$pengguna['desa_id'] == $id && !empty($id))) {
	$form = new zea();
	$form->setId($id);
	$form->init('edit');
	$form->setTable('desa');
	$form->setHeading('Data Desa');

	if (is_desa()) {
		msg('merubah kode desa dapat mengakibatkan data-data yang sudah diinput hilang, seperti data perangkat dll, mohon lapor pada admin untuk merubah kode desa', 'warning');
		$form->addInput('provinsi', 'text');
		$form->setAttribute('provinsi', 'onkeyup="this.value = this.value.toUpperCase();"');

		$form->addInput('regency_id', 'static');

		$form->addInput('kabupaten', 'text');
		$form->setAttribute('kabupaten', 'onkeyup="this.value = this.value.toUpperCase();"');

		$form->addInput('district_id', 'static');

		$form->addInput('kecamatan', 'text');
		$form->setAttribute('kecamatan', 'onkeyup="this.value = this.value.toUpperCase();"');

		$form->addInput('village_id', 'static');

		if (!empty($id)) {
			$data = $form->getData();
			if (!empty($data)) {
				$form->setValue('province_id', $data['province_id']);
				$form->setValue('regency_id', $data['regency_id']);
				$form->setValue('district_id', $data['district_id']);
				$form->setValue('village_id', $data['village_id']);
			}
		}
	} else {
		$form->addInput('province_id', 'dropdown');
		$form->setLabel('province_id', 'Provinsi');
		$form->setOptions('province_id', ['none']);

		$form->addInput('provinsi', 'text');
		$form->setAttribute('provinsi', 'onkeyup="this.value = this.value.toUpperCase();"');

		$form->addInput('regency_id', 'dropdown');
		$form->setLabel('regency_id', 'Kabupaten');
		$form->setOptions('regency_id', ['none']);

		$form->addInput('kabupaten', 'text');
		$form->setAttribute('kabupaten', 'onkeyup="this.value = this.value.toUpperCase();"');


		$form->addInput('district_id', 'dropdown');
		$form->setLabel('district_id', 'Kecamatan');
		$form->setOptions('district_id', ['none']);

		$form->addInput('kecamatan', 'text');
		$form->setAttribute('kecamatan', 'onkeyup="this.value = this.value.toUpperCase();"');

		$form->addInput('village_id', 'dropdown');
		$form->setLabel('village_id', 'Desa');
		$form->setOptions('village_id', ['none']);
	}

	$form->addInput('kode', 'text');
	if (!is_desa()) {
		$form->setAttribute('kode', ['readonly' => 'readonly']);
	}
	$form->setLabel('kode', 'Kode Desa');
	if (!empty($sipapat_config)) {
		$form->tableOptions('province_id', 'provinces', 'id', 'name', ' id = ' . $sipapat_config['province_id']);
		$form->tableOptions('regency_id', 'regencies', 'id', 'name', ' id = ' . $sipapat_config['regency_id']);
		$form->setSelected('province_id', $sipapat_config['province_id']);
		$form->setSelected('regency_id', $sipapat_config['regency_id']);
		$form->tableOptions('district_id', 'districts', 'id', 'name', ' regency_id = ' . $sipapat_config['regency_id']);
	}
	$form->addInput('nama', 'text');
	$form->setLabel('nama', 'Nama Desa');
	$form->setAttribute('nama', 'onkeyup="this.value = this.value.toUpperCase();"');

	$form->addInput('kode_pos', 'text');
	$form->setLabel('kode_pos', 'Kode Pos');
	$form->setAttribute('kode_pos', ['type' => 'number']);
	$form->addInput('telepon', 'text');
	$form->setLabel('telepon', 'Nomor Telepon');
	$form->setAttribute('telepon', ['type' => 'number']);
	$form->addInput('email', 'text');
	$form->setAttribute('email', ['type' => 'email', 'placeholder' => 'nama@gmail.com']);
	$form->addInput('website', 'text');
	$form->setAttribute('website', ['type' => 'url', 'placeholder' => 'http://website.com']);
	$form->addInput('alamat', 'textarea');
	$form->setLabel('alamat', 'Alamat Balai Desa');
	$form->addInput('ttd_img', 'file');
	$form->setLabel('ttd_img', 'gambar ttd dan stempel');
	$form->setAccept('ttd_img', '.png');
	$form->setRequired(['nama', 'kecamatan', 'kabupaten']);
	$form->form();
} else {
	msg('maaf anda tidak diperkenankan mengakses halaman ini', 'danger');
}
