<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-md-3">
    <?php $this->load->view('pesan/folder') ?>
  </div>
  <div class="col-md-9">
		<?php
		$this->zea->init('edit');
		$this->zea->setTable('pesan');
		$this->zea->addInput('sender','static');
		$this->zea->setValue('sender',@intval($user['id']));
		$this->zea->addInput('recipient','dropdown');
		$this->zea->setLabel('recipient', 'Kirim Ke');
		$this->zea->setOptions('recipient',$recipient);
		if(is_kecamatan())
		{
			$this->zea->setFirstOption('recipient',['0'=>'Semua Desa di kecamatan '.str_replace('kec_','',$user['username'])]);
		}else if(is_admin()){
			$this->zea->setFirstOption('recipient',$kecamatan_user);
		}
		$this->zea->addInput('title','text');
		$this->zea->setLabel('title','Judul');
		$this->zea->addInput('file','file');
		$this->zea->setAccept('file', '.jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx');
		$this->zea->addInput('pesan','textarea');
		$this->zea->setAttribute('pesan',['id'=>'summernote']);
		$this->zea->setFormName('compose_message');
		$this->zea->form();
		$this->pesan_model->save();
  	?>
  </div>
</div>