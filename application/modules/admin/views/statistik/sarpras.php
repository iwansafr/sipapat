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

    $form->setHeading('Data Statistik Sarana Prasarana Desa <b>'.$desa['nama'].'</b>');
    $form->setEditStatus(false);
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('faspen_tk','text');
    $form->setType('faspen_tk','number');
    $form->setLabel('faspen_tk','Jumlah TK/PAUD/RA');

    $form->addInput('faspen_sd','text');
    $form->setType('faspen_sd','number');
    $form->setLabel('faspen_sd','Jumlah SD/MI');

    $form->addInput('faspen_sltp','text');
    $form->setType('faspen_sltp','number');
    $form->setLabel('faspen_sltp','Jumlah SLTP');

    $form->addInput('faspen_slta','text');
    $form->setType('faspen_slta','number');
    $form->setLabel('faspen_slta','Jumlah SLTA');

    $form->addInput('faspen_pesantren','text');
    $form->setType('faspen_pesantren','number');
    $form->setLabel('faspen_pesantren','Jumlah Pondok Pesantren');

    $form->addInput('faspen_perguruan_tinggi','text');
    $form->setType('faspen_perguruan_tinggi','number');
    $form->setLabel('faspen_perguruan_tinggi','Jumlah Perguruan Tinggi');

    $form->startCollapse('faspen_tk','Fasilitas Pendidikan');
    $form->endCollapse('faspen_perguruan_tinggi');
    // $form->setCollapse('faspen_tk',true);

    



    $form->form();
}