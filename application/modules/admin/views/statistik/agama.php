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

    $form->setHeading('Data Statistik Agama Desa <b>'.$desa['nama'].'</b>');
    $form->setEditStatus(false);
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('islam','text');
    $form->setType('islam','number');
    $form->setLabel('islam','Jumlah Warga Beragama Islam');

    $form->addInput('kristen','text');
    $form->setType('kristen','number');
    $form->setLabel('kristen','Jumlah Warga Beragama Kristen');

    $form->addInput('katholik','text');
    $form->setType('katholik','number');
    $form->setLabel('katholik','Jumlah Warga Beragama Katholik');

    $form->addInput('hindu','text');
    $form->setType('hindu','number');
    $form->setLabel('hindu','Jumlah Warga Beragama Hindu');

    $form->addInput('budha','text');
    $form->setType('budha','number');
    $form->setLabel('budha','Jumlah Warga Beragama Budha');

    $form->addInput('khonghucu','text');
    $form->setType('khonghucu','number');
    $form->setLabel('khonghucu','Jumlah Warga Beragama Khong Hucu');

    $form->addInput('penghayat_kepercayaan','text');
    $form->setType('penghayat_kepercayaan','number');
    $form->setLabel('penghayat_kepercayaan','Jumlah Warga Penghayat Kepercayaan');
    
    $form->form();
}