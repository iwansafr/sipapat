<?php
$this->load->view('admin/statistik/menu');

$pengguna = $this->pengguna_model->get_pengguna();

if(is_desa())
{
    $desa = $this->sipapat_model->get_desa($pengguna['desa_id']);

    $statistik_data = $this->statistik_model->getIdStatistikDesa($desa['id']);

    $form = new Zea();
    $form->init('edit');

    if(!empty($statistik_data) && is_array($statistik_data)){
        $form->setId($statistik_data[0]['id']);
    }

    $form->setHeading('Data Statistik Pekerjaan Desa <b>'.$desa['nama'].'</b>');
    $form->setEditStatus(false);
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('asn','text');
    $form->setType('asn','number');
    $form->setLabel('asn','Jumlah ASN');

    $form->addInput('pelajar','text');
    $form->setType('pelajar','number');
    $form->setLabel('pelajar','Jumlah PELAJAR / MAHASISWA');

    $form->addInput('perangkat_desa','text');
    $form->setType('perangkat_desa','number');
    $form->setLabel('perangkat_desa','Jumlah PERANGKAT DESA');

    $form->addInput('tni','text');
    $form->setType('tni','number');
    $form->setLabel('tni','Jumlah TNI');

    $form->addInput('polri','text');
    $form->setType('polri','number');
    $form->setLabel('polri','Jumlah POLRI');

    $form->addInput('karyawan_swasta','text');
    $form->setType('karyawan_swasta','number');
    $form->setLabel('karyawan_swasta','Jumlah Karyawan Swasta');

    $form->addInput('karyawan_bumn','text');
    $form->setType('karyawan_bumn','number');
    $form->setLabel('karyawan_bumn','Jumlah Karyawan BUMN/BUMD');

    $form->addInput('petani','text');
    $form->setType('petani','number');
    $form->setLabel('petani','Jumlah Petani');

    $form->addInput('buruh_tani','text');
    $form->setType('buruh_tani','number');
    $form->setLabel('buruh_tani','Jumlah Buruh Tani');

    $form->addInput('nelayan','text');
    $form->setType('nelayan','number');
    $form->setLabel('nelayan','Jumlah Nelayan');

    $form->addInput('wiraswasta','text');
    $form->setType('wiraswasta','number');
    $form->setLabel('wiraswasta','Jumlah Wiraswasta');

    $form->addInput('pedagang','text');
    $form->setType('pedagang','number');
    $form->setLabel('pedagang','Jumlah Pedagang');

    $form->addInput('guru','text');
    $form->setType('guru','number');
    $form->setLabel('guru','Jumlah Guru');

    $form->addInput('ibu_rumah_tangga','text');
    $form->setType('ibu_rumah_tangga','number');
    $form->setLabel('ibu_rumah_tangga','Jumlah Ibu Rumah Tangga');

    $form->addInput('belum_bekerja','text');
    $form->setType('belum_bekerja','number');
    $form->setLabel('belum_bekerja','Jumlah Belum Bekerja');

    $form->addInput('pekerjaan_lainnya','text');
    $form->setType('pekerjaan_lainnya','number');
    $form->setLabel('pekerjaan_lainnya','Jumlah Pekerja Lainnya');

    $form->form();
}else if(is_admin() || is_root()){
    $this->load->view('admin/statistik/admin_pekerjaan');
}