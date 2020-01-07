<?php
$i = 1;
foreach($data AS $key => $value)
{
	?>
	<a href="<?php echo base_url('admin/desa/rekening?desa_id='.$value['desa_id'])?>">
		<span class="badge success"><?php echo $i.'. '.$value['nama'] ?></span>
	</a>
	<?php
	$i++;
}