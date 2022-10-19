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
    $form->setLabel('faspen_sltp','Jumlah SLTP/SMP/MTS');

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

    $form->addInput('faspem_kantor_desa','text');
    $form->setType('faspem_kantor_desa','number');
    $form->setLabel('faspem_kantor_desa','Jumlah Kantor Desa');

    $form->addInput('faspem_balai_desa','text');
    $form->setType('faspem_balai_desa','number');
    $form->setLabel('faspem_balai_desa','Jumlah Balai Desa');

    $form->addInput('faspem_perpus_desa','text');
    $form->setType('faspem_perpus_desa','number');
    $form->setLabel('faspem_perpus_desa','Jumlah Perpustakaan Desa');

    $form->startCollapse('faspem_kantor_desa','Fasilitas Pemerintahan');
    $form->endCollapse('faspem_perpus_desa');

    $form->addInput('fasib_masjid','text');
    $form->setType('fasib_masjid','number');
    $form->setLabel('fasib_masjid','Jumlah Masjid');

    $form->addInput('fasib_mushola','text');
    $form->setType('fasib_mushola','number');
    $form->setLabel('fasib_mushola','Jumlah Mushola');

    $form->addInput('fasib_gereja','text');
    $form->setType('fasib_gereja','number');
    $form->setLabel('fasib_gereja','Jumlah Gereja');

    $form->addInput('fasib_wihara','text');
    $form->setType('fasib_wihara','number');
    $form->setLabel('fasib_wihara','Jumlah Wihara');

    $form->addInput('fasib_klenteng','text');
    $form->setType('fasib_klenteng','number');
    $form->setLabel('fasib_klenteng','Jumlah Klenteng');

    $form->startCollapse('fasib_masjid','Fasilitas Ibadah');
    $form->endCollapse('fasib_klenteng');

    $form->addInput('fasek_pasar_desa','text');
    $form->setType('fasek_pasar_desa','number');
    $form->setLabel('fasek_pasar_desa','Jumlah Pasar Desa');

    $form->addInput('fasek_toko','text');
    $form->setType('fasek_toko','number');
    $form->setLabel('fasek_toko','Jumlah Toko');

    $form->addInput('fasek_swalayan','text');
    $form->setType('fasek_swalayan','number');
    $form->setLabel('fasek_swalayan','Jumlah Swalayan');

    $form->addInput('fasek_restoran','text');
    $form->setType('fasek_restoran','number');
    $form->setLabel('fasek_restoran','Jumlah Restoran');

    $form->addInput('fasek_rumah_makan','text');
    $form->setType('fasek_rumah_makan','number');
    $form->setLabel('fasek_rumah_makan','Jumlah Rumah Makan');

    $form->addInput('fasek_warung_makan','text');
    $form->setType('fasek_warung_makan','number');
    $form->setLabel('fasek_warung_makan','Jumlah Warung Makan');

    $form->startCollapse('fasek_pasar_desa','Fasilitas Ekonomi');
    $form->endCollapse('fasek_warung_makan');

    $form->addInput('faskes_pkd','text');
    $form->setType('faskes_pkd','number');
    $form->setLabel('faskes_pkd','Jumlah Pos Kesehatan Desa');

    $form->addInput('faskes_puskesmas','text');
    $form->setType('faskes_puskesmas','number');
    $form->setLabel('faskes_puskesmas','Jumlah Puskesmas');

    $form->addInput('faskes_klinik','text');
    $form->setType('faskes_klinik','number');
    $form->setLabel('faskes_klinik','Jumlah Klinik');

    $form->addInput('faskes_dokter_praktik','text');
    $form->setType('faskes_dokter_praktik','number');
    $form->setLabel('faskes_dokter_praktik','Jumlah Dokter Praktik');

    $form->startCollapse('faskes_pkd','Fasilitas Kesehatan');
    $form->endCollapse('faskes_dokter_praktik');

    $form->addInput('fasling_tpa','text');
    $form->setType('fasling_tpa','number');
    $form->setLabel('fasling_tpa','Jumlah BANK SAMPAH/TPA');

    $form->addInput('fasling_makam','text');
    $form->setType('fasling_makam','number');
    $form->setLabel('fasling_makam','Jumlah Makam');

    $form->addInput('fasling_lap_or','text');
    $form->setType('fasling_lap_or','number');
    $form->setLabel('fasling_lap_or','Jumlah Lapangan Olah Raga');

    $form->addInput('fasling_pamsimas','text');
    $form->setType('fasling_pamsimas','number');
    $form->setLabel('fasling_pamsimas','Jumlah Pamsimas');

    $form->startCollapse('fasling_tpa','Fasilitas Lingkungan/Umum');
    $form->endCollapse('fasling_pamsimas');

    $form->form();
}