<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<a href="<?php echo base_url('admin/pesan/edit') ?>" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-pencil-alt"></i> Buat Pesan</a>

<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Folders</h3>
    <div class="box-tools">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
      <li>
        <a href="<?php echo base_url('admin/pesan/masuk') ?>"><i class="fa fa-inbox"></i> Pesan Masuk
          <?php if (!empty($pesan)): ?>
            <span class="label label-primary pull-right"><?php echo $pesan['total'] ?></span>
          <?php endif ?>
        </a>
      </li>
      <li><a href="<?php echo base_url('admin/pesan/keluar') ?>"><i class="fa fa-envelope"></i> Pesan Terkirim</a></li>
    </ul>
  </div>
</div>