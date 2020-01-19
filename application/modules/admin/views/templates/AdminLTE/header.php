<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('pesan_model');
$message = $this->esg->get_esg('pesan');
if(is_sipapat())
{
  $site_title = 'site';
  $logo_title = 'logo';
}else{
  $site_title = 'sispudes_site';
  $logo_title = 'sispudes_logo';
}
?>
<?php if (is_bupati()): ?>
  <style>
    .main-header .navbar {
      -webkit-transition: margin-left .3s ease-in-out;
      -o-transition: margin-left .3s ease-in-out;
      transition: margin-left .3s ease-in-out;
      margin-bottom: 0;
      margin-left: 0px;
      border: none;
      min-height: 50px;
      border-radius: 0;
    }
    .content-wrapper, .main-footer {
      transition: transform .3s ease-in-out,margin .3s ease-in-out;
      margin-left: 0px;
      z-index: 820;
    }
  </style>
<?php endif ?>
<header class="main-header">
  <?php if (!is_bupati()): ?>
    <a href="<?php echo base_url('admin') ?>" class="logo">
      <span class="logo-mini"><img src="<?php echo image_module('config', $site_title.'/'.@$this->esg->get_esg('site')['site']['image']); ?>" height="50"></span>
      <?php if (@$site['logo']['display'] == 'image'): ?>
        <span class="logo-lg"><img src="<?php echo image_module('config', $logo_title.'/'.@$this->esg->get_esg('site')['logo']['image']); ?>" height="40"></span>
      <?php else: ?>
        <span class="logo-lg"><?php echo @$site['logo']['title'] ?></span>
      <?php endif ?>
    </a>
  <?php endif ?>
  <nav class="navbar navbar-static-top">
    <?php if (!is_bupati()): ?>
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    <?php endif ?>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope"></i>
            <span class="label label-success"><?php echo !empty(@intval($message['total'])) ? $message['total'] : '';?></span>
          </a>
          <ul class="dropdown-menu">
            <?php if (@intval($message['total']) > 0): ?>
              <li class="header">Anda Memiliki <?php echo $message['total'] ?> Pesan</li>
              <li>
            <?php else: ?>
              <li class="header">tidak ada pesan baru</li>
            <?php endif ?>
            <?php if (!empty($message['list'])): ?>
              <ul class="menu">
                <?php foreach ($message['list'] as $l_key => $l_value): ?>
                  <li>
                    <a href="<?php echo base_url('admin/pesan/detail/'.$l_value['id']) ?>">
                      <div class="pull-left">
                        <img src="<?php echo $meta['icon'] ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $l_value['name'] ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo $l_value['created'] ?></small>
                      </h4>
                      <p><?php echo $l_value['subject'] ?></p>
                    </a>
                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>
            </li>
            <li class="footer"><a href="<?php echo base_url('admin/pesan/edit/single') ?>"><i class="fa fa-pencil-alt"></i> Buat Pesan Baru</a><a href="<?php echo base_url('admin/pesan') ?>"><i class="fa fa-list"></i>Lihat Semua Pesan</a></li>
          </ul>
        </li>
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="label label-success"><?php echo !empty(@intval($notification['total'])) ? $notification['total'] : '';?></span>
          </a>
          <ul class="dropdown-menu">
            <?php if (@intval($notification['total']) > 0): ?>
              <li class="header">Anda Memiliki <?php echo $notification['total'] ?> Pemberitahuan</li>
              <li>
            <?php else: ?>
              <li class="header">tidak ada pemberitahuan baru</li>
            <?php endif ?>
            </li>
            <?php if (!empty($notification['list'])): ?>
              <li>
                <ul class="menu">
                  <?php foreach ($notification['list'] as $l_key => $l_value): ?>
                    <li>
                      <a href="<?php echo base_url('admin/notification/detail/'.$l_value['id']) ?>">
                        <i class="fa fa-bell"></i> <?php echo $l_value['title'] ?>
                      </a>
                    </li>
                  <?php endforeach ?>
                </ul>
              </li>
            <?php endif ?>
            <li class="footer"><a href="#">Lihat semua pemberitahuan</a></li>
          </ul>
        </li>
        <li class="dropdown tasks-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="header">tidak ada tugas baru</li>
            <li>
            </li>
            <li class="footer">
              <a href="#">Lihat semua tugas</a>
            </li>
          </ul>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo image_module('user', $user['id'].'/'.$user['image']) ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $user['username'] ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo image_module('user', $user['id'].'/'.$user['image']) ?>" class="img-circle" alt="User Image">
              <p>
                <?php echo $user['username'] ?> - <?php echo $user['role'] ?>
                <small>Member since <?php echo content_date($user['created']) ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo base_url('admin/user/edit/?id='.$user['id']) ?>" class="btn btn-default btn-flat"><i class="fa fa-portrait"></i> Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url('admin/logout') ?>" no_load="no_load" onclick="if(confirm('apakah anda yakin ingin logout ?')){$('#loading').removeClass('hidden');}else{return false;};" class="btn btn-default btn-flat"><i class="fa fa-sign-out-alt"></i> Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>