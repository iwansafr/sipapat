<?php if(!empty($penduduk)):?>
  <div class="container">
    <h5>Update Data Pekerjaan</h5>
    <table class="table">
      <tr>
        <td>Nama</td>
        <td>: <?php echo $penduduk['nama'] ?></td>
      </tr>
    </table>
    <?php 
    $form = new Zea();
    $form->init('edit');
    $form->setTable('penduduk');
    $form->setId($penduduk['id']);
    $form->addInput('pekerjaan','dropdown');
    $form->setOptions('pekerjaan',$this->dilan_model->pekerjaan());
    $form->form();
    ?>
  </div>
<?php else:?>
  <hr>
  <div class="container">
    <?php echo msg('Data Penduduk Tidak ditemukan','danger') ?>
  </div>
<?php endif?>
<div class="container">
  <hr>
  <a class="btn btn-primary" href="<?php echo base_url('dilan/?id='.$penduduk['desa_id']) ?>">Kembali Ajukan Surat ?</a>
</div>