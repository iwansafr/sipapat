<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);
?>
<style>
	body{
		background-image: url(<?php echo image_module('config',$paramname.'/'.$dilan_config['image_light'])?>);
		background-size: cover;
	}

</style>
<?php

$sipapat_config = $this->esg->get_config(base_url());
$form = new zea();
$form->addInput('district_id','dropdown');
$form->tableOptions('district_id','districts','id','name',' regency_id = '.$sipapat_config['regency_id']);
$kecamatan = [];
if(!empty($form->options['district_id']))
{
	$kecamatan = $form->options['district_id'];
	unset($kecamatan[0]);
}
?>
<div class="container mt-5">
	<form action="" method="post">
		<div class="card">
			<div class="card-header">
				Setting Up
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="kecamatan">KECAMATAN</label>
					<select class="form-control select2" name="district_id">
						<?php foreach ($kecamatan as $key => $value): ?>
							<option value="<?php echo $key ?>"><?php echo $value ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="desa">DESA</label>
					<select class="form-control select2" name="village_id">
						
					</select>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
			</div>
		</div>
	</form>
</div>