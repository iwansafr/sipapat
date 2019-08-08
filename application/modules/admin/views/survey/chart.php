<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-laptop"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">PUNYA LAPTOP</span>
        <span class="info-box-number"><?php echo $data['laptop'] ?><small> DESA</small></span>
        <span class="info-box-text">BELUM PUNYA LAPTOP</span>
        <span class="info-box-number"><?php echo count($data['data_laptop']['belum']) ?><small> DESA</small></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-wifi"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">PUNYA WIFI</span>
        <span class="info-box-number"><?php echo $data['wifi'] ?><small> DESA</small></span>
        <span class="info-box-text">BELUM PUNYA WIFI</span>
        <span class="info-box-number"><?php echo count($data['data_wifi']['belum']) ?><small> DESA</small></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">WIFI DI RUMAH</span>
        <span class="info-box-number"><?php echo $data['data_wifi']['rumah_jml'] ?><small> DESA</small></span>
        <span class="info-box-text">WIFI DI KANTOR</span>
        <span class="info-box-number"><?php echo $data['data_wifi']['desa_jml'] ?><small> DESA</small></span>
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
        <span class="info-box-text">BELUM DAPAT HONOR</span>
        <span class="info-box-number"><?php echo count($data['data_honor']['belum']) ?><small> DESA</small></span>
      </div>
    </div>
  </div>
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-chart-bar"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">SUDAH ISI SURVEY</span>
        <span class="info-box-number"><?php echo $data['isi_survey']['desa_sudah'] ?><small> DESA</small></span>
        <span class="info-box-text">BELUM ISI SURVEY</span>
        <span class="info-box-number"><?php echo $data['isi_survey']['desa_belum'] ?><small> DESA</small></span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <?php 
  $survey_data = ['data_laptop','data_wifi','data_honor','isi_survey'];
  foreach ($survey_data as $sdkey => $sdvalue) 
  {
    $title = str_replace('data_', '', $sdvalue);
    $title = str_replace('isi_', '', $title);
    $survey_title = $title == 'survey' ? '' : 'survey';
    ?>
    <div class="col-md-12">
      <div class="card-group panel-group">
        <div class="panel panel-default card card-default">
          <div class="panel-heading card-header">
            <h6 class="card-title panel-title m-0 font-weight-bold text-primary">
              <a data-toggle="collapse" href="#<?php echo $sdvalue ?>" class="collapsed" aria-expanded="false">DATA <?php echo $survey_title ?> <?php echo $title ?></a>
            </h6>
          </div>
          <div id="<?php echo $sdvalue ?>" class="card-collapse panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="card-body panel-body">
              <div class="col-md-6">
                <div class="panel panel-success card card-success">
                  <div class="panel-heading card-header">
                    desa yg punya <?php echo $title ?>
                  </div>
                  <div class="panel-body card-body">
                    <?php foreach ($data[$sdvalue]['sudah'] as $key => $value): ?>
                      <?php 
                      if($sdvalue=='isi_survey'){
                        
                      }else{
                        $value = $value['desa'];
                      }
                      ?>
                      <small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $value ?></small>
                    <?php endforeach ?>
                  </div>
                  <div class="panel-footer card-footer">
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-danger card card-danger">
                  <div class="panel-heading card-header">
                    desa yg belum punya <?php echo $title ?>
                  </div>
                  <div class="panel-body card-body">
                    <?php foreach ($data[$sdvalue]['belum'] as $key => $value): ?>
                      <?php 
                      if($sdvalue=='isi_survey'){
                        
                      }else{
                        $value = $value['desa'];
                      }
                      ?>
                      <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $value ?></small>
                    <?php endforeach ?>
                  </div>
                  <div class="panel-footer card-footer">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer panel-footer">sipapat</div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }?>  
</div>