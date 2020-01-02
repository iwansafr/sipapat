<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('param');
$form->setTable('config');
$form->setParamName('api');
$form->addInput('url','text');
$form->form();