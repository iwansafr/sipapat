<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-md-3">
    <?php $this->load->view('pesan/folder') ?>
  </div>
  <div class="col-md-9">
		<?php
		if(!empty($recipient))
		{
			$this->zea->init('edit');
			$this->zea->setTable('pesan');
			$this->zea->addInput('sender','static');
			$this->zea->setValue('sender',@intval($user['id']));
			$this->zea->addInput('type','static');
			$this->zea->setValue('type',@intval($type));
			$this->zea->addInput('recipient','dropdown');
			$this->zea->setLabel('recipient', 'Kirim Ke');
			$this->zea->setOptions('recipient',$recipient);
			$this->zea->addInput('title','text');
			$this->zea->setLabel('title','Judul');
			$this->zea->addInput('file','file');
			$this->zea->setAccept('file', '.jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx');
			$this->zea->addInput('pesan','textarea');
			$this->zea->setAttribute('pesan',['id'=>'summernote']);
			$this->zea->setFormName('compose_message');
			$this->zea->form();
			$this->pesan_model->save();
		}else{
			msg('Mohon Maaf, Anda tidak mempunyai akses ke halaman ini','danger');
		}
  	?>
  </div>
</div>