<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = @$form['field'];
if(!empty($form))
{
	$form = json_encode($form);
	pr($form);
}