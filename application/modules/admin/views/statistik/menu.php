<style>
  .w-100{
    width:100%;
  }
  .text-white{
    color:white!important;
  }
  .text-white:hover{
    color: grey!important;
  }
</style>
<div class="box box-default">
    <div class="box-header with-border">
      <h5 class="box-title">Navigasi</h5>
    </div>
    <div class="box-body">
      <table class="table table-borderless">
        <tr>
          <td>
            <a href="<?php echo base_url('admin/statistik/penduduk');?>" class="w-100 btn btn-info">Penduduk</a>
          </td>
          <td><a href="<?php echo base_url('admin/statistik/agama');?>" class="w-100 btn btn-danger">Agama</a></td>
          <td><a href="<?php echo base_url('admin/statistik/pendidikan');?>" class="w-100 btn btn-primary">Pendidikan</a></td>
          <td>
            <?php if(is_root()):?>
              <div class="input-group-btn">
                <button type="button" class="w-100 btn btn-warning dropdown-toggle" data-toggle="dropdown">Sarana Prasarana
                  <span class="fa fa-caret-down"></span></button>
                <ul class="dropdown-menu w-100">
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_pendidikan');?>">Fasilitas Pendidikan</a></li>
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_pemerintahan');?>">Fasilitas Pemerintahan</a></li>
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_ibadah');?>">Fasilitas Ibadah</a></li>
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_ekonomi');?>">Fasilitas Ekonomi</a></li>
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_kesehatan');?>">Fasilitas Kesehatan</a></li>
                  <li><a class="btn btn-warning w-100 text-white" href="<?php echo base_url('admin/statistik/sarpras_fasilitas_lingkungan');?>">Fasilitas Lingkungan / Umum</a></li>
                </ul>
              </div>
            <?php else:?>
              <a href="<?php echo base_url('admin/statistik/sarpras');?>" class="w-100 btn btn-success">Pekerjaan</a>
            <?php endif;?>
          </td>
          <td>
            <a href="<?php echo base_url('admin/statistik/pekerjaan');?>" class="w-100 btn btn-success">Pekerjaan</a>
          </td>
        </tr>
      </table>
    </div>
</div>
<!-- <div class="clearfix" style="border-bottom: 2px grey solid; margin-top: 10px; margin-bottom: 10px;"></div> -->