<?php defined('BASEPATH') OR exit('No direct script access allowed');

$color =
[
	'#f44336',
	'#e91e63',
	'#9c27b0',
	'#673ab7',
	'#3f51b5',
	'#2196f3',
	'#03a9f4',
	'#00bcd4',
	'#009688',
	'#4caf50',
	'#cddc39',
	'#ffeb3b',
	'#ffc107',
	'#ff9800'
];
if(!empty($data))
{
	$i = 0;
	foreach ($data as $key => $value) 
	{
		?>
		<div class="col-md-3">
			<a href="<?php echo base_url('admin/dilan/surat_list/'.$value['id'].'/'.str_replace(' ','_',$value['title'])) ?>" class="small-box" style="background:  <?php echo $color[$i]?>; color:white;">
				<div class="small-box" style="background:  <?php echo $color[$i]?>; color:white;">
				  <div class="inner">
				    <h3><?php echo $value['total'] ?></h3>

				    <p><?php echo $value['title'] ?></p>
				  </div>
				  <div class="icon">
				    <i class="fa fa-list"></i>
				  </div>
				  <a href="<?php echo base_url('admin/dilan/surat_list/'.$value['id'].'/'.str_replace(' ','_',$value['title'])) ?>" class="small-box-footer">Lihat Surat <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</a>
		</div>
		<div class="hidden">
			<?php pr($value) ?>
		</div>
		<?php
		$i++;
	}
}