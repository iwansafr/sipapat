<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($data))
{
	?>
	<div class="panel panel-danger">
		<div class="panel-heading">
			Detail Posko Covid-19 Desa <?php echo $desa['nama'] ?>
		</div>
		<div class="panel-body">
			<table class="table table-hover table-bordered">
				<tr>
					<td>Desa</td>
					<td>: <?php echo $desa['nama'] ?></td>
				</tr>
				<tr>
					<td>Alamat Posko</td>
					<td>: <?php echo $data['alamat'] ?></td>
				</tr>
				<tr>
					<td>Penanggung Jawab</td>
					<td>: <?php echo $data['pj'] ?></td>
				</tr>
				<tr>
					<td>Nomor HP</td>
					<td>: <?php echo $data['hp'] ?></td>
				</tr>
				<tr>
					<td>Foto</td>
					<td>: <img class="img img-responsive" src="<?php echo image_module('corona_posko',$data['id'].'/'.$data['foto']) ?>"></td>
				</tr>
			</table>
		</div>
		<div class="panel-footer">
			<?php 
			if(empty($_GET['s']))
			{
				?>
				<a href="?s=print" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}