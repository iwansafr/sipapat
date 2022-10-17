<?php

$pengguna = $this->pengguna_model->get_pengguna();

if(is_desa())
{
    $this->load->view('admin/statistik/menu');
    $desa = $this->sipapat_model->get_desa($pengguna['desa_id']);

    $statistik_data = $this->statistik_model->getIdStatistikDesa($desa['id']);

    $form = new Zea();
    $form->init('edit');

    if(!empty($statistik_data) && is_array($statistik_data)){
        $form->setId($statistik_data[0]['id']);
    }

    $form->setHeading('Data Statistik Jumlah Penduduk Desa <b>'.$desa['nama'].'</b>');
    $form->setEditStatus(false);
    $form->setTable('statistik_penduduk');

    $form->addInput('desa_id','static');
    $form->setValue('desa_id', $pengguna['desa_id']);

    $form->addInput('laki_laki','text');
    $form->setType('laki_laki','number');
    $form->setLabel('laki_laki','Jumlah Warga Laki-laki');

    $form->addInput('perempuan','text');
    $form->setType('perempuan','number');
    $form->setLabel('perempuan','Jumlah Warga Perempuan');

    $form->addInput('kepala_keluarga_laki_laki','text');
    $form->setType('kepala_keluarga_laki_laki','number');
    $form->setLabel('kepala_keluarga_laki_laki','Jumlah Kepala Keluarga Laki-laki');

    $form->addInput('kepala_keluarga_perempuan','text');
    $form->setType('kepala_keluarga_perempuan','number');
    $form->setLabel('kepala_keluarga_perempuan','Jumlah Kepala Keluarga Perempuan');

    $form->addInput('kepala_keluarga','text');
    $form->setType('kepala_keluarga','number');
    $form->setLabel('kepala_keluarga','Jumlah Total Kepala Keluarga');
    
    $form->form();

    ?>
    <script>
        const jmlkklk = document.querySelector('input[name="kepala_keluarga_laki_laki"]');
        const jmlkkpr = document.querySelector('input[name="kepala_keluarga_perempuan"]');
        const jmlkk = document.querySelector('input[name="kepala_keluarga"]');
        jmlkklk.addEventListener('keyup',function(){
            let value = 0;
            let prvalue = 0;
            if (this.value != null ) {
                value = this.value
            }
            if(jmlkkpr.value > 0 ){
                prvalue = jmlkkpr.value
            }
            total_kk(value, prvalue)
        })
        jmlkkpr.addEventListener('keyup',function(){
            let value = 0;
            let lkvalue = 0;
            if (this.value != null ) {
                value = this.value
            }
            if(jmlkklk.value > 0 ){
                lkvalue = jmlkklk.value
            }
            total_kk(lkvalue, value)
        })
        function total_kk(lkvalue = 0, prvalue = 0){
            let totalkk = parseInt(lkvalue)+parseInt(prvalue)
            jmlkk.value = totalkk
        }
    </script>
    <?php
}