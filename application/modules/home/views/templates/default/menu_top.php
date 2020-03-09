<div class="container">
  <a class="navbar-brand" href="<?php echo base_url('home') ?>"><?php echo @$logo['title'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <?php 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    ?>
    <?php if (!empty($home['menu_top'])): ?>
      <ul class="navbar-nav ml-auto">
        <?php foreach ($home['menu_top'] as $key => $value): ?>
          <?php $link = menu_link($value['link']); ?>
          <li class="nav-item <?php echo $actual_link == $link  ? 'active' : '';?>">
            <a class="nav-link" href="<?php echo $link ?>"><?php echo $value['title'] ?>
              <?php echo $actual_link == $link  ? '<span class="sr-only">(current)</span>' : '';?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
  </div>
</div>