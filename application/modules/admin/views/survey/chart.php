<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-laptop"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">PUNYA LAPTOP</span>
        <span class="info-box-number"><?php echo $data['laptop'] ?><small> DESA</small></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-wifi"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">PUNYA WIFI</span>
        <span class="info-box-number"><?php echo $data['wifi'] ?><small> DESA</small></span>
      </div>
    </div>
  </div>
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">DAPAT HONOR</span>
        <span class="info-box-number"><?php echo $data['honor'] ?><small> DESA</small></span>
      </div>
    </div>
  </div>
</div>