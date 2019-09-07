<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->setTable('penduduk');

$form->init('roll');

$form->search();

if(!is_desa())
{

}


$form->setNumbering(true);
$form->addInput('id','plaintext');
$form->setLink('id',base_url(),'id');
$form->setLabel('id','action');
$form->setPlaintext('id','
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Action
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	  	<li><a href="'.base_url('admin/dilan/detail/').'{id}"><i class="fa fa-search"></i>Detail</a></li>
	    <li><a href="'.base_url('admin/dilan/surat_pengantar_form/').'{id}"><i class="fa fa-plus"></i>Surat Pengantar</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#{id}">dll</a></li>
	  </ul>
	</div>
');
$form->addInput('no_kk','plaintext');
$form->addInput('nik','plaintext');
$form->addInput('nama','plaintext');
$form->addInput('jk','plaintext');

$form->setUrl('admin/dilan/clear_list');


$form->form();