<?php defined('BASEPATH') OR exit('No direct script access allowed');
$navigation = $this->esg->get_esg('navigation');
$title = end($navigation['array']);
$title = $title == 'admin' ? 'BERANDA' : strtoupper($title);
?>
<div class="row">
	<div class="col-md-6">
		<h4>
			<?php echo str_replace('_',' ',$title) ?>
		</h4>
	</div>
</div>
<ol class="breadcrumb">
	<?php
	echo '<li><a href="'.base_url('admin').'"> <i class="fa fa-home"></i> BERANDA</a></li>';
	$nav_tot = count($navigation['array']) - 1;
	if($nav_tot > 1)
	{
		$url = '';
		foreach ($navigation['array'] as $key => $value)
		{
			$url .= '/'.$value;
			if($key < $nav_tot)
			{
				echo '<li><a href="'.base_url($url).'">'.$value.'</a></li>';
			}else{
				$sep = strlen($value)>=15 ? '_' : '';
				echo '<li>'.substr($value,0, 15).$sep.'</li>';
			}
		}
	}
	?>
</ol>