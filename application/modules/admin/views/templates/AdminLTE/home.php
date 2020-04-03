<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($dashboard_config['pengumuman']))
{
	if(is_sipapat())
	{
		$pengumuman = $this->esg->get_config('pengumuman');
	}else{
		$pengumuman = $this->esg->get_config('sispudes_pengumuman');
	}
	?>
	<style type="text/css">
		.content-wrapper{
			background: url(<?php echo image_module('config','pengumuman'.'/'.$pengumuman['background_image']) ?>) center top no-repeat;
	    /*height: 100vh;*/
	    background-size: cover;
	    position: relative;
		}	
	</style>
	<?php
}?>
<h1 style="text-align: center; color: <?php echo @$pengumuman['header_color']; ?>; font-weight: bold;"><?php echo @$pengumuman['header'] ?></h1>
<div class="col-md-12">
	<?php
	if(!empty($dashboard) && !empty($dashboard_config['custom_dashboard']))
	{
		foreach ($dashboard as $key => $value) 
		{
			?>
			<div class="col-md-3" style="height: 150px; margin-bottom: 2%;">
				<div class="small-box" style="background:  <?php echo $value['color'] ?>; color:white; height: 150px;">
				  <div class="inner">
				    <h3><?php echo $value['title'] ?></h3>

				    <p><?php echo $value['description'] ?></p>
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
	?>
</div>
<hr>
<?php
if(!is_bumdes())
{
	echo '<div class="row">';
	if(!empty($pengumuman))
	{
			?>
			<div class="container">
				<h1 style="text-shadow: -1px -1px 0 #eae1e1, 1px -1px 0 #f3ecec, -1px 1px 0 #f7f0f0, 1px 1px 0 #f3eeee;">Pengumuman</h1>
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
	if(!empty($home) && !empty($dashboard_config['dashboard']))
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
	if(!empty($amj_alert) && !empty($dashboard_config['amj']))
	{
		$is_desa = is_desa();
		?>
		<div class="box-body">
			<div class="box box-danger collapsed-box box-solid">
		    <div class="box-header with-border">
		      <h3 class="box-title"><?php echo count($amj_alert) ?> Masa Jabatan Segera Berakhir</h3>
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
							$alert = 'warning';
							$status = 'Telah Berakhir';
						}else{
							$alert = 'danger';
							$status = 'Akan Berakhir';
						}
						?>
							<div class="alert alert-<?php echo $alert;?> alert-dismissible">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						    <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
						    <?php echo 'Masa Jabatan '.$jabatan.' '.$amj_value['desa'].' dg Nama '.$amj_value['nama'].' '.$status.' pada '.$amj_value['amj'] ?>
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
	if(!empty($dashboard_config['absensi']) && (is_kecamatan() || is_desa()))
	{
		if(!empty($absensi))
		{
			$absensi_config = $this->esg->get_config(base_url('_absensi_config'));
			if(empty($_GET['date'])){
				$date = date('Y-m-d');
			}else{
				$date = $_GET['date'];
				$date = strtotime($date);
				$date = date('Y-m-d',$date);
			}
			?>
			<h1 style="text-align: center; color: <?php echo @$absensi_config['header_color']; ?>; font-weight: bold;"><?php echo @$absensi_config['header'].' '.@$user['district']['name'] ?></h1>
			<div class="text-center">
				<form action="" method="get">
					<div class="form-inline">
						<input type="date" name="date" class="form-control" value="<?php echo $date ?>">
						<button class="btn btn-warning">Filter</button>
					</div>
				</form>
				<br>
			</div>
			<?php
			foreach ($absensi as $key => $value) 
			{
				?>
				<div class="col-md-3" style="height: 100%; margin-bottom: 2%;">
					<div class="small-box" style="background:  #222d32; color:white; height: 100%;">
					  <div class="inner">
					    <h5><?php echo $value['desa']['nama'] ?> | <?php echo $date ?></h5>
							<table class="table">
						    <?php foreach ($value['absensi'] as $abkey => $abvalue): ?>
						    	<tr>
						    		<td>
						    			<?php echo $abvalue['judul']; ?>
						    		</td>
						    		<td>:</td>
						    		<td>
						    			<?php echo $abvalue['total'] ?>
						    			<?php if (!empty($abkey)): ?>
						    				 | <a target="_blank" href="<?php echo base_url('admin/absensi/list/?desa='.$value['desa']['id'].'&tgl='.$date.'&status='.$abkey) ?>">detail</a>
						    			<?php else: ?>
						    				<!-- <a target="_blank" href="<?php echo base_url('admin/absensi/bolos_list/?desa='.$value['desa']['id'].'&tgl='.$date) ?>">detail</a> -->
						    			<?php endif ?>
						    		</td>
						    	</tr>
						    <?php endforeach ?>
						    <?php if (is_desa()): ?>
						    	<tr>
						    		<td colspan="3">
						    			<a href="<?php echo base_url('admin/absensi/masuk/') ?>" target="_blank" class="btn btn-sm btn-primary" style="width: 100%;">ABSEN KEPDES</a>
						    		</td>
						    	</tr>
						    <?php endif ?>
							</table>
					  </div>
					  <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<?php
			}
		}else{
			?>
			<div class="center text-center">
				<a class="btn btn-warning" href=""><i class="fa fa-refresh"></i> Refresh</a>
			</div>
			<?php
		}
	}
	echo '</div>';
}
if(is_root())
{
	// pr(ip_detail(ip()));
}
?>
<div class="hidden">
	<?php pr($user) ?>
	<?php pr($_SERVER) ?>
</div>

