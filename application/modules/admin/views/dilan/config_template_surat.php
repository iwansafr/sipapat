<?php
if(is_desa()){
  $desa_id = $this->sipapat_model->get_desa_id();
  $form = new Zea();
  $form->init('edit');
  $form->setId(@intval($_GET['id']));
  $form->setTable('template_surat');
  $form->addInput('desa_id','static');
  $form->setValue('desa_id',$desa_id);

  $form->addInput('dilan_surat_ket_id','dropdown');
  $form->setLabel('dilan_surat_ket_id','Pilih Surat Group');
  $form->tableOptions('dilan_surat_ket_id','dilan_surat_ket','id','title');

  $form->addInput('tpl','file');
  $form->setLabel('tpl','Upload Template');
  $form->setAccept('tpl','.rtf');
  // $form->setFile('tpl','document');
  $form->set_max_size(8000);

  $form->form();


  $roll = new Zea();
  $roll->init('roll');
  $roll->addInput('id','plaintext');
  $roll->setDelete(true);
  $roll->setEdit(true);
  $roll->setTable('template_surat');
  $roll->setWhere('desa_id = '.$desa_id);

  $roll->addInput('dilan_surat_ket_id','dropdown');
  $roll->setLabel('dilan_surat_ket_id','Surat Group');
  $roll->setAttribute('dilan_surat_ket_id','disabled');
  $roll->tableOptions('dilan_surat_ket_id','dilan_surat_ket','id','title');

  $roll->addInput('tpl','plaintext');
  // $roll->setLink('tpl',base_url('images/modules/template_surat'),'id');
  $roll->setPlaintext('tpl',[
    base_url('images/modules/template_surat/{id}/{tpl}') => 'download'
  ]);
  $roll->setLabel('tpl','Template');
  $roll->setEditLink(base_url('admin/dilan/config_template_surat?id='));

  $roll->form();
}else{
  msg('maaf hanya akun desa yang bisa mengakses halaman ini','danger');
}