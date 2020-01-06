<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="panel panel-default">
	<div class="panel-heading">
		data penduduk
	</div>
	<div class="panel-body">
		<table class="table table-responsive table-bordered">
			<tr>
				<td>Total Penduduk</td>
				<td>: <?php echo $penduduk['penduduk'] ?></td>
			</tr>
			<tr>
				<td>total KK</td>
				<td>: <?php echo $penduduk['kk'] ?></td>
			</tr>
			<tr>
				<td>total PRIA</td>
				<td>: <?php echo $penduduk['pria'] ?></td>
			</tr>
			<tr>
				<td>total WANITA</td>
				<td>: <?php echo $penduduk['wanita'] ?></td>
			</tr>
			<?php foreach ($penduduk['usia'] as $key => $value): ?>
				<tr>
					<td>Usia <?php echo $key ?></td>
					<td>: <?php echo $value ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td>total Janda</td>
				<td>: <?php echo $penduduk['janda'] ?></td>
			</tr>
		</table>
	</div>
</div>