<?php defined('BASEPATH') OR exit('No direct script access allowed');

function is_kecamatan()
{
	$return = false;
	$role   = @$_SESSION[base_url().'_logged_in']['level'];
	if(!empty($role))
	{
		if($role==4)
		{
			$return = true;
		}
	}
	return $return;
}
function is_desa()
{
	$return = false;
	$role   = @$_SESSION[base_url().'_logged_in']['level'];
	if(!empty($role))
	{
		if($role==5)
		{
			$return = true;
		}
	}
	return $return;
}