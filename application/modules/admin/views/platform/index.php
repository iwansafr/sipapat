<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('platform/meta') ?>
</head>
<body class="sidebar-mini wysihtml5-supported skin-red-light">
<div class="wrapper">
  <header class="main-header">
    <?php $this->load->view('platform/header') ?>
  </header>
  <aside class="main-sidebar">
    <?php $this->load->view('platform/sidebar') ?>
  </aside>
  <div class="content-wrapper">
    <?php //$this->load->view('platform/breadcrumb') ?>
    <section class="content">
      
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="https://esoftgreat.com">esoftgreat</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('templates/AdminLTE');?>/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url('templates/AdminLTE');?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('templates/AdminLTE');?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('templates/AdminLTE');?>/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('templates/AdminLTE');?>/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('templates/AdminLTE');?>/dist/js/demo.js"></script>
</body>
</html>
