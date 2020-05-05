<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
	<?php
	if(!empty($user))
	{
		$form = new zea();
		$form->setHeading('Konfigurasi Dilan');
		$form->init('param');
		$form->setTable('config');
		$paramname = str_replace('/', '_', base_url().'_dilan_config');
		$form->setParamName($paramname);
		$form->addInput('background','upload');
		$form->setAccept('background', 'image/jpeg,image/png');

		$form->form();
		pr($form->getData());
	}else{
		msg('mohon maaf anda tidak memiliki akses ke halaman ini','danger');
	}?>
</div>