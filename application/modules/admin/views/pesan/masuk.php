<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-md-3">
    <?php $this->load->view('pesan/folder') ?>
  </div>
  <div class="col-md-9">
		<?php
		if(!empty($id))
		{
			if(!empty($detail_pesan))
			{
				$this->load->view('pesan/read');
			}
		}else{
			$form = new zea();
			$form->setTable('pesan_status');
			$form->init('roll');
			$form->join('pesan','ON(pesan.id=pesan_status.pesan_id)','pesan.title,pesan_status.id,pesan_status.pesan_id,pesan_status.sender,pesan_status.status,pesan.created,pesan.updated');
			$form->setWhere(' pesan_status.recipient = 0 OR pesan_status.recipient = '.@intval($user['id']));
			$form->search();
			$form->setNumbering(TRUE);
			$form->addInput('id','hidden');
			$form->addInput('status','dropdown');
			$form->setOptions('status',['<i class="fa fa-envelope"></i> belum dibaca','<i class="fa fa-envelope-open"></i> sudah dibaca']);
			$form->setAttribute('status','disabled');
			$form->addInput('updated','link');
			$form->setLink('updated',base_url('admin/pesan/detail/'),'id');
			$form->setLabel('updated','detail');
			$form->setPlaintext('updated','detail');
			$form->setClearGet('updated');
			$form->addInput('title','plaintext');
			$form->addInput('sender','dropdown');
			$form->tableOptions('sender','user','id','username');
			$form->setFirstOption('sender',['0'=>'Semua User']);
			$form->setAttribute('sender','disabled');
			$form->addInput('created','plaintext');
			$form->setFormName('pesan_masuk_form_roll');
			$form->form();
		}?>
  </div>
</div>