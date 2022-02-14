<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);
?>
<style>
	body{
		background-image: url(<?php echo image_module('config',$paramname.'/'.$dilan_config['image'])?>);
		background-size: cover;
		color: white;
	}
	#welcome_text{
		margin-top: 20%;
	}
	h1,h5{
		text-shadow: 2px 2px blue;
	}

</style>
<div class="container-fluid">
	<?php if (empty($_GET['nik'])): ?>
		<audio id="audio" preload="auto" autoplay="autoplay" hidden="true">
		  <source src="<?php echo image_module('config',$paramname.'/'.$dilan_config['audio_nik'])?>">
		</audio>
	<?php endif ?>
	<center>
		<h1 id="welcome_text"></h1>
		<h1 id="start" class="mt-3"></h1>
		<div class="container">
			<form action="" method="get">
				<div class="row">
					<div class="col-1">
						<a href="<?php echo base_url('dilan/search') ?>" class="btn btn-warning" style="position: absolute;right: 0;"><i class="fa fa-refresh"></i></a>
					</div>
					<div class="col">
						<div class="form-group">
							<input type="number" required class="form-control" name="nik" placeholder="NIK" style="text-align: center;" oninvalid="this.setCustomValidity('NIK tidak boleh kosong')"oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="col-1">
						<button class="btn btn-light" style="position: absolute;left: 0;font-size: 16px;"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
			<?php if (!empty($_GET['nik'])): ?>
				<?php if (!empty($penduduk)): ?>
					<h5>APAKAH BENAR NAMA ANDA <?php echo $penduduk['nama']?> ?</h5>
					<a href="<?php echo base_url('dilan/suket/'.$penduduk['nik']) ?>" class="btn btn-success">YA</a>
					<a href="<?php echo base_url('dilan/search') ?>" class="btn btn-danger">TIDAK</a>
				<?php else: ?>
					<?php msg('Maaf Data Anda Tidak Ditemukan','danger') ?>
					<a href="<?php echo base_url('dilan/ajukan/'.$desa_id);?>" class="btn btn-primary"><i class="fa fa-send"></i> Ajukan Data Baru</a>
				<?php endif ?>
			<?php endif ?>
		</div>
	</center>
</div>
<?php if (empty($_GET['nik'])): ?>
	<script>
		var i = 0;
		var txt = 'SILAHKAN MASUKKAN NOMOR IDENTITAS KTP ANDA';
		var speed = 2000;
		var txts = '';
		function typeWriter() {
		  if (i < txt.length) {
		    document.getElementById("welcome_text").innerHTML += txt.charAt(i);
		    i++;
		    setTimeout(typeWriter, speed);
		  }else{
				document.getElementById("start").innerHTML = txts;	
		  }
		}

		typeWriter();
	</script>
<?php endif ?>