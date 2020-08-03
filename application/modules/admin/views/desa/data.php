<?php $desa_tmp = [] ?>
<?php foreach ($desa as $key => $value): ?>
	<?php $desa_tmp[$value['id']] = $value['nama'] ?>
<?php endforeach ?>
<?php $rekap = []; ?>
<?php foreach ($desa as $dkey => $dvalue): ?>
	<?php $rekap[$dvalue['id']]['desa'] = $dvalue['nama'] ?>
	<?php foreach ($data as $key => $value): ?>
		<?php foreach ($value as $vkey => $vvalue): ?>
			<?php 
			$rekap[$vvalue['desa_id']][$key] = $vvalue['total'];
			?>
		<?php endforeach ?>
	<?php endforeach ?>
<?php endforeach ?>

<div class="panel panel-default">
	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table esg_data_table">
				<thead>
					<td>NO</td>
					<td>Desa</td>
					<td>Total Data</td>
				</head>
				<tbody>
					<?php $j = 1; ?>
					<?php foreach ($rekap as $key => $value): ?>
						<?php if (!empty($desa_tmp[$key])): ?>
							<tr>
								<td><?php echo $j++ ?></td>
								<td>
									<?php echo $desa_tmp[$key] ?>
								</td>
								<td>
									<?php $total = 0; ?>
									<?php foreach ($value as $vkey => $vvalue): ?>
										<?php if (is_numeric($vvalue)): ?>
											<?php $total += $vvalue ?>
										<?php endif ?>
									<?php endforeach ?>
									<?php echo $total ?>
								</td>
							</tr>
						<?php endif ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>