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
	<center>
		<div class="container">
			<form action="" method="get" style="background: white;">
				<?php if (!empty($surat_group)): ?>
					<?php foreach ($surat_group as $key => $value): ?>
						<?php pr($value) ?>
					<?php endforeach ?>
				<?php endif ?>
			</form>
		</div>
	</center>
</div>