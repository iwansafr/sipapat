<?php defined('BASEPATH') OR exit('No direct script access allowed');
$pengumuman = $this->esg->get_config('pengumuman');
?>
<style type="text/css">
	.content-wrapper{
		background: url(<?php echo image_module('config','pengumuman'.'/'.$pengumuman['background_image']) ?>) center top no-repeat;
    height: 100vh;
    background-size: cover;
    position: relative;
	}	
</style>
<?php
echo '<div class="row">';
if(!empty($pengumuman))
{
		?>
		<div class="container">
			<h1>Pengumuman</h1>
			<?php
			for($i=1;$i<4;$i++)
			{
				?>
				<div class="callout callout-info">
		    <h4><?php echo @$pengumuman['judul'.$i] ?>!</h4>

		    <p><?php echo @$pengumuman['pengumuman'.$i] ?></p>
		  	</div>
		  	<?php
			}?>
		</div>
		<?php
}
if(!empty($home))
{
	foreach ($home as $key => $value) 
	{
		?>
		<div class="col-md-3">
			<div class="small-box" style="background:  <?php echo $value['color'] ?>; color:white;">
			  <div class="inner">
			    <h3><?php echo $value['total'] ?></h3>

			    <p><?php echo str_replace('_',' ',$key) ?></p>
			  </div>
			  <div class="icon">
			    <i class="<?php echo $value['icon'] ?>"></i>
			  </div>
			  <a href="<?php echo @$value['link'] ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<?php
	}
}
echo '</div>';
if(is_root())
{
	// pr(ip_detail(ip()));
}
?>

