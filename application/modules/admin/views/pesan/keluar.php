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
			$form->setWhere(' sender = '.@intval($this->session->userdata(base_url().'_logged_in')['id']).$search_user_id);
			$form->search();
			// $form->
			$form->setNumbering(TRUE);
			$form->addInput('id','hidden');
			$form->addInput('updated','link');
			$form->setLink('updated',base_url('admin/pesan/keluar/'),'id');
			$form->setLabel('updated','detail');
			$form->setPlaintext('updated','detail');
			$form->setClearGet('updated');
			$form->addInput('title','plaintext');
			// $form->addInput('recipient','dropdown');
			// $form->tableOptions('recipient','user','id','username');
			// $form->setFirstOption('recipient',['0'=>'Semua User']);
			// $form->setAttribute('recipient','disabled');
			$form->addInput('created','plaintext');
			$form->setDelete(TRUE);
			$form->setUrl('admin/pesan/clear_list/keluar');
			$form->setFormName('pesan_keluar_roll');
			$form->form();

		}?>
  </div>
</div>
