<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$form->init('edit');

$form->setTable('bumdes_kelembagaan');
$form->addInput('no','text');

$form->addInput('bumdes_id','static');
$form->setValue('bumdes_id', @intval($bumdes_id));

$form->addInput('investor_lk','text');
$form->setType('investor_lk','number');
$form->setlabel('investor_lk','Investor Laki-laki');

$form->addInput('investor_pr','text');
$form->setType('investor_pr','number');
$form->setlabel('investor_pr','Investor Perempuan');

$form->addInput('jml_investor','text');
$form->setType('jml_investor','number');
$form->setlabel('jml_investor','Jumlah Investor');

$form->addInput('manajer_lk','text');
$form->setType('manajer_lk','number');
$form->setlabel('manajer_lk','manajer Laki-laki');

$form->addInput('manajer_pr','text');
$form->setType('manajer_pr','number');
$form->setlabel('manajer_pr','manajer Perempuan');

$form->addInput('jml_manajer','text');
$form->setType('jml_manajer','number');
$form->setlabel('jml_manajer','Jumlah manajer');

$form->addInput('karyawan_lk','text');
$form->setType('karyawan_lk','number');
$form->setlabel('karyawan_lk','karyawan Laki-laki');

$form->addInput('karyawan_pr','text');
$form->setType('karyawan_pr','number');
$form->setlabel('karyawan_pr','karyawan Perempuan');

$form->addInput('jml_karyawan','text');
$form->setType('jml_karyawan','number');
$form->setlabel('jml_karyawan','Jumlah karyawan');


$form->addInput('lpj_terakhir','text');
$form->setType('lpj_terakhir','date');
$form->setLabel('lpj_terakhir','lpj terakhir');


$form->setRequired('All');
$form->form();