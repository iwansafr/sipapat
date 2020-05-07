<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);

$color =
[
	'#f44336',
	'#e91e63',
	'#9c27b0',
	'#673ab7',
	'#3f51b5',
	'#2196f3',
	'#03a9f4',
	'#00bcd4',
	'#009688',
	'#4caf50',
	'#cddc39',
	'#ffeb3b',
	'#ffc107',
	'#ff9800'
];
$icon =
[
	'fa-map-marked',
	'fa-passport',
	'fa-address-card',
	'fa-briefcase',
	'fa-heart',
	'fa-money-bill-wave',
	'fa-pray',
	'fa-building',
	'fa-map-marked',
	'fa-map-marked',
	'fa-map-marked',
	'fa-map-marked',
];
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
<div class="container-fluid mt-5">
	<center>
		<form action="" method="get" style="background: white;">
			<?php if (!empty($surat_group)): ?>
				<?php 
				$surat_group = array_chunk($surat_group, 3);
				$i = 0;
				?>
				<?php foreach ($surat_group as $key => $value): ?>
					<div class="card-group">
						<?php foreach ($value as $vkey => $vvalue): ?>
						  <div class="card">
						    <div class="card-body" style="background: <?php echo $color[$i];?>;height: 200px;">
						      <h5 class="card-title"><i class="fa <?php echo $icon[$i];?>"></i></h5>
						      <p class="card-text"><?php echo $vvalue['title'] ?></p>
						    </div>
						    <a href="<?php echo base_url('dilan/surat') ?>" class="btn btn-light">
							    <div>
							    	<i class="fa fa-send"></i> Buat Surat
							    </div>
							  </a>
						  </div>
						  <?php $i++; ?>
						<?php endforeach ?>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</form>
	</center>
</div>