<!DOCTYPE html>
<html lang="id">
<head>
  <?php
  $user = $this->session->userdata(base_url().'_logged_in');
  $this->load->view('templates/'.$templates['admin_template'].'/meta');
  if ($this->router->fetch_class() != 'user' && $this->router->fetch_class() != 'pengguna') {
    ?>
    <style>
      div{
        text-transform: uppercase;
      }
    </style>
    <?php
  }
  ?>
</head>
<body class="hold-transition skin-black sidebar-mini">
<div id="loading" class="hidden">
  <img src="<?php echo base_url('images/ajax-loader.gif') ?>" style="position: fixed;">
</div>
<div class="wrapper">
  <?php $this->load->view('header', array('user'=>$user)); ?>
  <?php if (!is_bupati()): ?>
    <aside class="main-sidebar">
      <?php $this->load->view('sidebar', array('user'=>$user));?>
    </aside>
  <?php endif ?>
  <div class="content-wrapper">
    <section class="content-header">
      <?php $this->load->view('navigation') ?>
    </section>
    <section class="content">
      <?php
      $mod['name'] = $this->router->fetch_class();
      $mod['task'] = $this->router->fetch_method();
      $content  = $mod['name'].'/'.$mod['task'];
      $content = $content == 'admin/index' ? 'templates'.DIRECTORY_SEPARATOR.$templates['admin_template'].DIRECTORY_SEPARATOR.'home' :$content;
      $this->load->view($content);
      ?>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <!-- <div class="badge"><?php echo date('d/M/Y h:i A'); ?></div>  -->
      <b>Version</b> 5.0.8
    </div>
    <strong>Copyright &copy; 2019-<?php echo date('Y'); ?> <a href="https://www.mandesa.co.id">mandesa</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cogs"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <?php 
        // $this->load->view('config/subscriber') 
        ?>
      </div>
      <div class="tab-pane active" id="control-sidebar-settings-tab">
        <!-- <a href="<?php echo base_url() ?>" target="_blank" class="btn btn-default"><i class="fa fa-image"></i> preview website</a><hr>
        <form method="post">
          <?php 
          // $this->load->view('config/templates') 
          ?>
        </form> -->
      </div>
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>
<?php $this->load->view('js') ?>
<?php 
if (
  $content!='user/role' && 
  $content!='user/edit' && 
  $content!='pengguna/edit' && 
  $content!='survey/edit' && 
  $content!='menu/edit' && 
  $content!='admin_menu/edit' &&
  $content!='config/dashboard' &&
  $content!='config/custom_dashboard' &&
  $content!='dilan/surat_pengantar_form' &&
  $content!='sipapatconfig/api' && 
  $content!='sipapatconfig/custom_api' &&
  $content!='pengumuman/index'

): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('input[type="text"]').attr('onkeyup',"this.value = this.value.toUpperCase();");
      $('textarea').attr('onkeyup',"this.value = this.value.toUpperCase();");
    });
  </script>
<?php endif ?>
<?php if ($mod['name'].'/'.$mod['task'] == 'admin/index'): ?>
  <script src="<?php echo base_url('assets/absensi/kecamatan.js') ?>"></script>
<?php endif ?>
</body>
</html>
