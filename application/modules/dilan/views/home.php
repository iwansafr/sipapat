<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);
$title = empty($dilan_config['title']) ? 'SELAMAT DATANG DI SISTEM TERINTEGRASI KABUPATEN PATI' : $dilan_config['title'];
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
	h1{
		text-shadow: 2px 2px blue;
	}
</style>
<div class="container-fluid">
	<audio id="audio" preload="auto" autoplay="autoplay" hidden="true">
	  <source src="<?php echo image_module('config',$paramname.'/'.$dilan_config['audio'])?>">
	</audio>
	<center>
		<?php if (empty($_GET['page'])): ?>
			<h1 id="welcome_text">MULAI LAYANAN DIGITAL</h1>
			<?php if (!empty($_GET['id'])): ?>
				<a href="?page=start&id=<?php echo @intval($_GET['id']);?>" class="btn btn-primary"><i class="fa fa-sign-in"></i> MULAI</a>
			<?php endif ?>
		<?php else: ?>
			<h1 id="welcome_text"></h1>
			<!-- <h1 id="start" class="mt-3"></h1> -->
			<!-- <a href="" class="btn btn-lg btn-warning"><i class="fa fa-refresh"></i> reload</a> -->
			<!-- <a href="<?php echo base_url('dilan/search') ?>" class="btn btn-lg btn-primary"><i class="fa fa-play"></i> Mulai</a> -->
		<?php endif ?>
	</center>
</div>
<?php if (!empty($_GET['page'])): ?>
	<script>
		var i = 0;
		var txt = '<?php echo $title;?>';
		var speed = 70;
		// var txts = 'MULAI LAYANAN DIGITAL';
		function typeWriter() {
		  if (i < txt.length) {
		    document.getElementById("welcome_text").innerHTML += txt.charAt(i);
		    i++;
		    setTimeout(typeWriter, speed);
		  }else{
				// document.getElementById("start").innerHTML = txts;	
				document.location = '<?php echo base_url('dilan/search/'.@intval($_GET['id']));?>';
		  }
		}

		typeWriter();
	</script>
<?php endif ?>