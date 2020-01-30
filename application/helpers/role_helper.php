<?php defined('BASEPATH') OR exit('No direct script access allowed');

function is_kecamatan()
{
	return set_user(4);
}
function is_desa()
{
	return set_user(5);
}
function is_bumdes()
{
	return set_user(6);
}

function is_bupati()
{
	return set_role('bupati');
}

function is_inspektorat()
{
	return set_user(3);
}

function set_role($group = 'admin')
{
	$return = false;
	if(!empty($group))
	{
		$role   = @$_SESSION[base_url().'_logged_in']['role'];
		if(!empty($role))
		{
			if($role==$group)
			{
				$return = true;
			}
		}
	}
	return $return;
}

function set_user($level = 0)
{
	$return = false;
	if(!empty($level))
	{
		$role   = @$_SESSION[base_url().'_logged_in']['level'];
		if(!empty($role))
		{
			if($role==$level)
			{
				$return = true;
			}
		}
	}
	return $return;
}