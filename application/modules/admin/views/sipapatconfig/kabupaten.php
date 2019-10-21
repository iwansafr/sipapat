<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin())
{
	$base_url_config = $this->esg->get_config(base_url());
	$editable = true;
	if(!empty($base_url_config))
	{
		$editable = false;
		if(!empty(@$_GET['edit']))
		{
			$editable = true;
		}
	}else{
		$editable = true;
	}

	if($editable)
	{
		$form = new zea();
		$form->init('param');
		$form->setTable('config');
		$form->setParamName(base_url());
		$form->setHeading('<a href="'.base_url('admin/sipapatconfig/kabupaten').'" class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left"></i> kembali</a>');

		$form->addInput('province_id','dropdown');
		$form->setLabel('province_id','Provinsi');
		$form->setOptions('province_id',['none']);

		$form->addInput('regency_id','dropdown');
		$form->setLabel('regency_id','Kabupaten');
		$form->setOptions('regency_id',['none']);
		
		$form->addInput('image', 'upload');
		$form->setAccept('image', 'image/jpeg,image/png');

		$form->setDirImage('kabupaten_image_'.str_replace('/','_',base_url()));

		$form->setFormName(base_url());
		$form->form();
	}else{
		$this->load->model('indonesia_model');
		$indonesia['province'] = $this->indonesia_model->get_province_by_id($base_url_config['province_id']);
		$indonesia['regency'] = $this->indonesia_model->get_regency_by_id($base_url_config['regency_id']);
		?>
		<div class="panel card panel-default card-default">
			<div class="panel-heading card-header">
				Config Kabupaten <a href="<?php echo base_url('admin/sipapatconfig/kabupaten?edit=true') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-pencil-alt"></i> Edit</a>
			</div>
			<div class="panel-body card-body">
				<table class="table table-hover">
					<tr>
						<td>provinsi</td>
						<td>: <?php echo @$indonesia['province']['name'] ?></td>
					</tr>
					<tr>
						<td>kabupaten</td>
						<td>: <?php echo @str_replace('KABUPATEN', '', $indonesia['regency']['name']); ?></td>
					</tr>
					<tr>
						<td>images</td>
						<td>: <img src="<?php echo image_module('config', 'kabupaten_image_'.str_replace('/', '_', base_url()).'/'.$base_url_config['image']) ?>" class="img img-responsive img-fluid" style="margin-left: 2%;"></td>
					</tr>
				</table>
				
			</div>
			<div class="panel-footer card-footer">
				
			</div>
		</div>
		<?php
	}
}