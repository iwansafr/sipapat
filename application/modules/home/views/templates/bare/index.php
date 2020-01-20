<!DOCTYPE html>
<html lang="id">
<head>
  <?php $this->load->view('meta') ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <?php $this->load->view('menu_top') ?>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php if ($mod['content']=='home/index'): ?>

        <?php else: ?>
          <?php $this->load->view(@$mod['content']) ?>
        <?php endif ?>
      </div>
    </div>
  </div>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright © <a href="https://mandesa.co.id" class="text-white">Mandala Group 2019</a></p>
    </div>
    <a href="https://esoftgreat.com" style="opacity: 0%;">esoftgreat</a>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <?php $this->load->view('js') ?>
</body>

</html>
