<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
	<?php
	if(!empty($user))
	{
		$this->zea->init('param');
		$this->zea->setTable('config');
		$this->zea->setHeading('Konfigurasi Dilan');
		$paramname = str_replace('/', '_', base_url().'_dilan_config');
		$this->zea->setParamName($paramname);
		$this->zea->addInput('title','text');
		$this->zea->addInput('image','upload');
		$this->zea->setAccept('image', 'image/jpeg,image/png');

		$this->zea->addInput('image_light','upload');
		$this->zea->setAccept('image_light', 'image/jpeg,image/png');


		$this->zea->addInput('audio','upload');
		$this->zea->setAccept('audio', '.mp3');
		$this->zea->setFile('audio','audio');

		$this->zea->addInput('audio_nik','upload');
		$this->zea->setAccept('audio_nik', '.mp3');
		$this->zea->setFile('audio_nik','audio');

		$this->zea->form();
	}else{
		msg('mohon maaf anda tidak memiliki akses ke halaman ini','danger');
	}?>
</div>