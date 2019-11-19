<?php defined('BASEPATH') OR exit('No direct script access allowed');

$i = 1;
foreach($data AS $key => $value)
{
	?>
	<span class="badge success"><?php echo $i.'. '.$value['nama'] ?></span>
	<?php
	$i++;
}