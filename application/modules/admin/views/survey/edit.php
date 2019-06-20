<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<textarea class="form-control" rows="15" readonly="">
CONTOH
[
	{
		'field':'nama',
		'type':'text',
		'placeholder':'nama anda'
	},
	{
		'field':'gender',
		'type':'dropdwon',
		'options':['perempuan','laki-laki']
	}
]
</textarea>
<?php

$form = new zea();
$form->init('param');

$form->setTable('config');
$name = !empty($_GET['name']) ? $_GET['name'] : 'survey_'.time();
$form->setParamName($name);

$form->addInput('field','textarea');
$form->setAttribute
(
'field',
[
'placeholder'=>"[
	{
		'field':'nama',
		'type':'text',
		'placeholder':'nama anda'
	},
	{
		'field':'gender',
		'type':'dropdwon',
		'options':['perempuan','laki-laki']
	}
]
",
'rows'=>'20'
]
);

$form->form();