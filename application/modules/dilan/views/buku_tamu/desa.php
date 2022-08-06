<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buku Tamu</title>
  <meta content="buku-tamu" name="description">
  <meta content="buku-tamu" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url();?>/templates/Arsha/" rel="icon">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/templates/Arsha/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url();?>/templates/Arsha/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.8.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="#">Buku Tamu</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="#" class="logo me-auto"><img src="<?php echo base_url();?>/templates/Arsha/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#startForm">Buku Tamu</a></li>
          <li><a class="getstarted scrollto" href="#startForm">Mulai</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Selamat Datang di Layanan</h1>
          <h2>Buku Tamu Desa <?php echo $data['nama'];?></h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#startForm" class="btn-get-started scrollto">Isi Buku Tamu</a>
            <?php if(!empty($data['youtube_video'])):?>
              <a href="<?php echo $data['youtube_video'];?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Tonton Video</span></a>
            <?php endif?>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="<?php echo base_url();?>/templates/Arsha/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Contact Section ======= -->
    <section class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Buku Tamu</h2>
          <p><?php echo $data['alamat'];?></p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat :</h4>
                <p><?php echo $data['alamat'];?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $data['email'];?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p><?php echo $data['telepon'];?></p>
              </div>
              <?php if(!empty($data['gmap_link'])):?>
                <iframe src="<?php echo $data['gmap_link'];?>" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
              <?php endif?>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="#" method="post" role="form" class="info" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nama</label>
                  <input type="text" name="nama" value="<?php echo $this->input->post('nama');?>" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="hp">Nomor Hp</label>
                  <input type="number" class="form-control" name="hp" id="hp" value="<?php echo $this->input->post('hp');?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" class="form-control" id="jk" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="1" <?php echo $this->input->post('jk') == 1 ? 'selected' : '';?>>Laki-laki</option>
                    <option value="2" <?php echo $this->input->post('jk') == 2 ? 'selected' : '';?>>Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="asal_instansi">Asal Instansi</label>
                <input type="text" class="form-control" value="<?php echo $this->input->post('asal_instansi');?>" name="asal_instansi" id="asal_instansi" required>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" required><?php echo $this->input->post('alamat');?></textarea>
              </div>
              <div class="form-group">
                <label for="perangkat_desa_id">Bertemu dengan</label>
                <select name="perangkat_desa_id" class="form-control" id="perangkat_desa_id" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach($data['perangkat_desa'] AS $key => $value):?>
                        <option <?php echo $this->input->post('perangkat_desa_id') == $value['id'] ? 'selected' : '';?> value="<?php echo $value['id'];?>"><?php echo $value['nama'].' - '. $jabatan[$value['jabatan']];?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="keperluan">Keperluan</label>
                <select name="keperluan" class="form-control" id="keperluan" required>
                    <option value="">-- Pilih Keperluan --</option>
                    <?php foreach($keperluan AS $key => $value):?>
                        <option <?php echo $this->input->post('keperluan') == $key ? 'selected' : '';?> value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <div class="my-3">
                <?php if(!empty($msg)):?>
                    <div class="alert alert-<?php echo $msg['alert']?>"><?php echo $msg['msg'];?></div>
                <?php endif;?>
              </div>
              <div class="text-center"><button class="btn btn-primary" type="submit">Kirim</button></div>
            </form>
          </div>
        </div>
      </div>
      <div id="startForm"></div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Terima Kasih</h4>
            <p>Sudah Menggunakan Layanan Buku Tamu</p>
            <!-- <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form> -->
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Dilan</h3>
            <p>
              <?php echo $data['nama'];?> <br>
              <?php echo $data['alamat'];?><br>
              <?php echo $data['kabupaten'];?> <br><br>
              <strong>Telepon:</strong> <?php echo $data['telepon'];?><br>
              <strong>Email:</strong> <?php echo $data['email'];?><br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contact">Buku Tamu</a></li>
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Layanan Kami</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Sosial Media Kami</h4>
            <p>saling terhubung dengan cinta</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div> -->

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Dilan</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Supported by <a href="https://esoftgreat.com/">esoftgreat</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/aos/aos.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?php echo base_url();?>/templates/Arsha/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url();?>/templates/Arsha/assets/js/main.js"></script>

</body>

</html>