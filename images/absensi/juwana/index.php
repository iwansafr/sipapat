<?php

$directory = glob('*');
if(!empty($directory))
{
	foreach ($directory as $key => $value) 
	{
		if(preg_match('~.apk~', $value))
		{
			echo '<a href="'.$value.'">'.$value.'</a><br>';
		}
	}
}