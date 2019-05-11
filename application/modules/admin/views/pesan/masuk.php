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
			$form->setTable('pesan');
			$form->init('roll');
			$form->setWhere(' recipient = 0 OR recipient = '.@intval($user['id']));
			$form->search();
			// $form->
			$form->addInput('id','plaintext');
			$form->addInput('title','plaintext');
			$form->addInput('sender','dropdown');
			$form->tableOptions('sender','user','id','username');
			$form->setFirstOption('sender',['0'=>'Semua User']);
			$form->setAttribute('sender','disabled');
			$form->addInput('created','plaintext');
			$form->form();
		}?>
  </div>
</div>
