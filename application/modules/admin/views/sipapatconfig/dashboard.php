<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root())
{
	$form = new zea();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName(base_url().'_dashboard_config');
	$form->addInput('dashboard','radio');
	$form->setRadio('dashboard',['hide','Show']);
	$form->addInput('custom_dashboard','radio');
	$form->setRadio('custom_dashboard',['hide','Show']);
	$form->addInput('absensi','radio');
	$form->setRadio('absensi',['hide','Show']);
	$form->addInput('pengumuman','radio');
	$form->setRadio('pengumuman',['hide','Show']);
	$form->addInput('amj','radio');
	$form->setLabel('amj','AMJ(Akhir Masa Jabatan)');
	$form->setRadio('amj',['hide','Show']);

	$form->form();
}