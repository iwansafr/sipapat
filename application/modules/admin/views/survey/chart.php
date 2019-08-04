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
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary card card-primary">
      <div class="panel-heading card-header">
        DATA SURVEY LAPTOP
      </div>
      <div class="panel-body card-body">
        <div class="col-md-6">
          <div class="panel panel-primary card card-primary">
            <div class="panel-heading card-header">
              desa yg punya laptop
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_laptop']['sudah'] as $key => $value): ?>
                <small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-primary card card-primary">
            <div class="panel-heading card-header">
              desa yg belum punya laptop
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_laptop']['belum'] as $key => $value): ?>
                <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer card-footer">
        
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="panel panel-warning card card-warning">
      <div class="panel-heading card-header">
        DATA SURVEY WIFI
      </div>
      <div class="panel-body card-body">
        <div class="col-md-6">
          <div class="panel panel-warning card card-warning">
            <div class="panel-heading card-header">
              desa yg punya wifi
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_wifi']['sudah'] as $key => $value): ?>
                <small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-warning card card-warning">
            <div class="panel-heading card-header">
              desa yg belum punya wifi
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_wifi']['belum'] as $key => $value): ?>
                <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer card-footer">
        
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="panel panel-success card card-success">
      <div class="panel-heading card-header">
        DATA SURVEY HONOR
      </div>
      <div class="panel-body card-body">
        <div class="col-md-6">
          <div class="panel panel-success card card-success">
            <div class="panel-heading card-header">
              desa yg punya honor
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_laptop']['sudah'] as $key => $value): ?>
                <small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-success card card-success">
            <div class="panel-heading card-header">
              desa yg belum punya honor
            </div>
            <div class="panel-body card-body">
              <?php foreach ($data['data_laptop']['belum'] as $key => $value): ?>
                <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $value['desa'] ?></small>
              <?php endforeach ?>
            </div>
            <div class="panel-footer card-footer">
              
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer card-footer">
        
      </div>
    </div>
  </div>
</div>