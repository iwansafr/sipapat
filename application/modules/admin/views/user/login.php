<!DOCTYPE html>
<html>
<head>
  <?php 
  $base_url_name = str_replace('/','_', base_url());
  $site_title = $base_url_name.'_site';
  $logo_title = $base_url_name.'_logo';
  $site['site'] = $this->esg->get_config($site_title);
  $site['logo'] = $this->esg->get_config($logo_title);

  if(empty($site['logo'])){
    $site = $this->esg->get_esg('site');
    $site_title = 'site';
    $logo_title = 'logo';
  }

  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo @$site['site']['title'] ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <meta name="google-signin-client_id" content="13443026150-r3cqu2omsod90qusglsu684dpqg4bsao.apps.googleusercontent.com">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('templates/AdminLTE/assets/')?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('templates/AdminLTE/assets/')?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('templates/AdminLTE/assets/')?>Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('templates/AdminLTE/assets/') ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('templates/AdminLTE/assets/') ?>iCheck/square/blue.css">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo image_module('config',$site_title.'/'.@$site['site']['image']); ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .c_pass{
      cursor: pointer;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background: #d2d6de;">
	<?php
  $msg  = $this->esg->get_esg('msg');
  $data = $this->input->post();
  if(!empty($this->input->get('username') && !empty($this->input->get('password'))))
  {
    $data['username'] = $this->input->get('username');
    $data['password'] = $this->input->get('password');
  }
  ?>
<div class="login-box">
  <div class="login-logo">
    <?php 
    if(@$site['logo']['display'] == 'title')
    {
      echo '<h1>'.@$site['logo']['title'].'</h1>';
    }else{
      ?>
      <img src="<?php echo image_module('config',$logo_title.'/'.@$site['logo']['image']) ?>" height="<?php echo @intval($site['logo']['height']) ?>">
      <?php
    }
    ?>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background: #929090; color: white;">
    <p class="login-box-msg">pastikan username dan sandi benar</p>
    <?php
    if(!empty($msg))
    {
      echo '<p class="login-box-msg">'.msg($msg['msg'],$msg['status']).'</p>';
    }
    ?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input id="username" type="text" name="username" class="form-control" placeholder="Username" value="<?php echo @$data['username'] ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo @$data['password'] ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="fa fa-eye c_pass" title="Tampilkan Sandi" style="color: black;"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me"> ingat saya
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <!-- <p>- OR -</p> -->
      <!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a> -->
        <!-- <div class="g-signin2" data-onsuccess="onSignIn">
          
        </div> -->
    </div>
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('templates/AdminLTE/assets/')?>jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('templates/AdminLTE/assets/')?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('templates/AdminLTE/assets/') ?>iCheck/icheck.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $('.c_pass').on('click',function(){
      var is_cek = $(this).attr('is_cek');
      if(is_cek){
        $('input[name="password"]').attr('type','password');
        $(this).removeAttr('is_cek');
        $(this).attr('title','Tampilkan Sandi');
        $(this).addClass('fa-eye');
        $(this).removeClass('fa-eye-slash');
      }else{
        $('input[name="password"]').attr('type','text');
        $(this).attr('is_cek','is_cek');
        $(this).attr('title','Sembunyikan Sandi');
        $(this).removeClass('fa-eye');
        $(this).addClass('fa-eye-slash');
      }

    });
  });
  window.onload = function() {
    var input = document.getElementById("username").focus();
  };
</script>
</body>
</html>
