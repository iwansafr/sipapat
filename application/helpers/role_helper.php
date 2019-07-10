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
	return set_user(3);
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