<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_desa())
{
  ?>
  <div class="form-group">
  	<div class="btn-group">
      <a href="#" type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-building"></i> Laporan Fisik
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url('admin/pembangunan/edit/fisik?bankeu_prov=true')  ?>">Bankeu Prov</a></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/fisik?bankeu_kab=true')  ?>">Bankeu Kab</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/fisik?dd=true') ?>">DD</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/fisik') ?>">Lainnya</a></li>
      </ul>
      <hr>
    </div>
    <div class="btn-group">
      <a href="#" type="button" class="btn btn-lg btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-chalkboard-teacher"></i> Laporan non Fisik
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url('admin/pembangunan/edit/non-fisik?bankeu_prov=true')  ?>">Bankeu Prov</a></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/non-fisik?bankeu_kab=true')  ?>">Bankeu Kab</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/non-fisik?dd=true') ?>">DD</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url('admin/pembangunan/edit/non-fisik') ?>">Lainnya</a></li>
      </ul>
      <hr>
    </div>
  </div>
  <?php
}else{
  msg('Hanya Akun Desa yg bisa mengakses halaman ini','danger');
}