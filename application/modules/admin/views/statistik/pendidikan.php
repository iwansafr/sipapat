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

    $form->setHeading('Data Statistik Pendidikan Desa <b>'.$desa['nama'].'</b>');
    $form->setEditStatus(false);
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('tidak_belum_sekolah','text');
    $form->setType('tidak_belum_sekolah','number');
    $form->setLabel('tidak_belum_sekolah','Jumlah Warga Tidak / Belum Sekolah');

    $form->addInput('tidak_tamat_sd','text');
    $form->setType('tidak_tamat_sd','number');
    $form->setLabel('tidak_tamat_sd','Jumlah Warga Tidak Tamat SD');

    $form->addInput('tamat_sd','text');
    $form->setType('tamat_sd','number');
    $form->setLabel('tamat_sd','Jumlah Warga Tamat / Lulus SD');

    $form->addInput('sltp','text');
    $form->setType('sltp','number');
    $form->setLabel('sltp','Jumlah Warga Tamat / Lulus SLTP');

    $form->addInput('slta','text');
    $form->setType('slta','number');
    $form->setLabel('slta','Jumlah Warga Tamat / Lulus SLTA');

    $form->addInput('d1_d2','text');
    $form->setType('d1_d2','number');
    $form->setLabel('d1_d2','Jumlah Warga Tamat / Lulus D1 - D2');

    $form->addInput('d3','text');
    $form->setType('d3','number');
    $form->setLabel('d3','Jumlah Warga Tamat / Lulus D3 / Sarjana Muda');

    $form->addInput('s1','text');
    $form->setType('s1','number');
    $form->setLabel('s1','Jumlah Warga Sarjana');

    $form->addInput('s2','text');
    $form->setType('s2','number');
    $form->setLabel('s2','Jumlah Warga Pasca Sarjana');

    $form->addInput('s3','text');
    $form->setType('s3','number');
    $form->setLabel('s3','Jumlah Warga Dengan Gelar S3 / Doktor');

    $form->form();
}else if(is_admin() || is_root()){
    $this->load->view('admin/statistik/admin_pendidikan');
}