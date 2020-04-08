<?php

$directory = glob('*/');
if(!empty($directory))
{
	foreach ($directory as $key => $value) 
	{
		echo '<a href="'.$value.'">'.$value.'</a><br>';
	}
}