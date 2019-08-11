<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-default card card-default">
	<div class="panel-heading card-header">
		detail perdes <?php echo $perdes['no'] ?>
	</div>
	<div class="panel-body card-body">
		<table class="table table-hover">
			<tr>
				<td>No</td>
				<td>:<?php echo $perdes['no'] ?></td>
			</tr>
			<tr>
				<td>item</td>
				<td>:<?php echo $perdes_options[$perdes['item']] ?></td>
			</tr>
			<tr>
				<td>tgl penetapan</td>
				<td>:<?php echo content_date($perdes['tgl_penetapan']) ?></td>
			</tr>
			<tr>
				<td>tgl pelaksanaan</td>
				<td>:<?php echo content_date($perdes['tgl_pelaksanaan']) ?></td>
			</tr>
			<tr>
				<td>progress</td>
				<td>:<?php echo $perdes_progress[$perdes['progress']] ?></td>
			</tr>
			<?php if (!empty($perdes['file_office'])): ?>
				<?php 
				$file_office = json_decode($perdes['file_office']);
				foreach ($file_office as $key => $value) 
				{
					?>
					<tr>
						<td></td>
						<td>
							<a href="<?php echo image_module('perdes', 'gallery/'.$perdes['id'].'/'.$value) ?>" class="btn btn-default btn-xs download_file " no_load="no_load">
								<i class="fa fa-cloud-download-alt"></i> Download File
							</a>
						</td>
					</tr>
					<?php
				}?>
				
			<?php endif ?>
		</table>
	</div>
	<div class="panel-footer card-footer">
		<span style="font-size: 8px;">sipapat</span>
	</div>
</div>