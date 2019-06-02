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
<h1 style="text-align: center; color: <?php echo @$pengumuman['header_color']; ?>; font-weight: bold;"><?php echo @$pengumuman['header'] ?></h1>
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
				if($i==3)
				{
					if(!empty($pengumuman_kecamatan))
					{
						$pengumuman['judul'.$i] = $pengumuman_kecamatan['judul'];
						$pengumuman['pengumuman'.$i] = $pengumuman_kecamatan['pengumuman'];
					}
				}
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
if(!empty($amj_alert))
{
	$is_desa = is_desa();
	?>
	<div class="box-body">
		<div class="box box-danger collapsed-box box-solid">
	    <div class="box-header with-border">
	      <h3 class="box-title">Masa Jabatan Segera Berakhir</h3>
	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
	        </button>
	      </div>
	    </div>
			<div class="box-body">
				<?php
				foreach ($amj_alert as $amj_key => $amj_value) 
				{
					$jabatan = $amj_value['jabatan']['jabatan'];
					if($amj_value['kelompok'] == 6)
					{
						$jabatan .= ' '.$amj_value['rt'];
					}else if($amj_value['kelompok'] == 7)
					{
						$jabatan .= ' '.$amj_value['rw'];
					}else{
						$jabatan .= ' '.$amj_value['jabatan']['kelompok'];
					}
					$jabatan_title = $amj_value['jabatan']['kelompok'].'/';
					if($amj_value['kelompok'] == 1)
					{
						$jabatan_title = '/';
						$jabatan = $amj_value['jabatan']['jabatan'];
					}
					$link = base_url('admin/perangkat/'.$jabatan_title.'edit?id='.$amj_key);
					if($amj_value['amj']<date('Y-m-d'))
					{
						$status = 'Telah Berakhir';
					}else{
						$status = 'Akan Berakhir';
					}
					?>
						<div class="alert alert-danger alert-dismissible">
					    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					    <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
					    <?php echo 'Masa Jabatan '.$jabatan.' dg Nama '.$amj_value['nama'].' '.$status.' pada '.$amj_value['amj'] ?>
					    <?php if ($is_desa): ?>
					    || <a href="<?php echo $link ?>" class="btn btn-default btn-sm btn-success"><i class="fa fa-pencil-alt"></i> Perbarui</a>
					    <?php endif ?>
					  </div>
					<?php
				}
				?>
			</div>
	  </div>
		
	</div>
	<?php
}
echo '</div>';
if(is_root())
{
	// pr(ip_detail(ip()));
}
?>

