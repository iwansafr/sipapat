<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$base_url_config = $this->esg->get_config(base_url());
	if(!empty($base_url_config))
	{
		$this->load->model('indonesia_model');
		$indonesia['province'] = $this->indonesia_model->get_province_by_id($base_url_config['province_id']);
		$indonesia['regency'] = $this->indonesia_model->get_regency_by_id($base_url_config['regency_id']);
		?>
		<div class="panel card panel-default card-default">
			<div class="panel-heading card-header">
				Config Kabupaten
			</div>
			<div class="panel-body card-body">
				<table class="table table-hover">
					<tr>
						<td>provinsi</td>
						<td>: <?php echo @$indonesia['province']['name'] ?></td>
					</tr>
					<tr>
						<td>provinsi</td>
						<td>: <?php echo @$indonesia['regency']['name'] ?></td>
					</tr>
					<tr>
						<td>images</td>
						<td>: <?php echo image_module('config', 'kabupaten_image') ?></td>
					</tr>
				</table>
				
			</div>
			<div class="panel-footer card-footer">
				
			</div>
		</div>
		<?php
	}else{
		$form = new zea();
		$form->init('param');
		$form->setTable('config');
		$form->setParamName(base_url());

		$form->addInput('province_id','dropdown');
		$form->setLabel('province_id','Provinsi');
		$form->setOptions('province_id',['none']);

		$form->addInput('regency_id','dropdown');
		$form->setLabel('regency_id','Kabupaten');
		$form->setOptions('regency_id',['none']);
		
		$form->addInput('image', 'upload');
		$form->setAccept('image', 'image/jpeg,image/png');

		$form->setDirImage('kabupaten_image');

		$form->setFormName(base_url());
		$form->form();
	}
}