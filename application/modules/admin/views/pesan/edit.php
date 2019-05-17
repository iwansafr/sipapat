<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-md-3">
    <?php $this->load->view('pesan/folder') ?>
  </div>
  <div class="col-md-9">
		<?php
		$where = (!is_admin() || !is_root() || !is_kecamatan()) ? " AND (username LIKE 'kec_%' OR user_role_id =2)":'';
		$this->zea->init('edit');
		$this->zea->setTable('pesan');
		$this->zea->addInput('sender','static');
		$this->zea->setValue('sender',@intval($user['id']));
		$this->zea->addInput('recipient','dropdown');
		$this->zea->setLabel('recipient', 'Kirim Ke');
		$this->zea->tableOptions('recipient','user','id','username',' active = 1 AND user_role_id > 1 AND id != '.$user['id'].' '.$where);
		if(is_admin() || is_root() || is_kecamatan())
		{
			$this->zea->setFirstOption('recipient',['0'=>'Semua']);
		}else{
			// $this->zea->setFirstOption('recipient',['-'=>'Pilih Penerima']);
		}
		$this->zea->addInput('title','text');
		$this->zea->setLabel('title','Judul');
		$this->zea->addInput('file','file');
		$this->zea->setAccept('file', '.jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx');
		$this->zea->addInput('pesan','textarea');
		$this->zea->setAttribute('pesan',['id'=>'summernote']);
		$this->zea->setFormName('compose_message');
		$this->zea->form();
  	?>
  </div>
</div>