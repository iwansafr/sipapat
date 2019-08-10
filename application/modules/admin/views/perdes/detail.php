<?php defined('BASEPATH') OR exit('No direct script access allowed');
//  [ID] => 74
//     [DESA_ID] => 233
//     [USER_ID] => 250
//     [ITEM] => 1
//     [NO] => 141.03  / VII  / 2015
//     [TGL_PENETAPAN] => 2015-07-09
//     [TGL_PELAKSANAAN] => 2015-07-09
//     [FILE_OFFICE] => ["FILE_OFFICE_141.03__\/_VII__\/_2015_0_1565240747.DOC"]
//     [PROGRESS] => 2
//     [CREATED] => 2019-08-08 12:05:47
//     [UPDATED] => 2019-08-08 12:05:47
// [1] => RPJMDS
//     [2] => RKP DESA
//     [3] => APBDES
//     [4] => PERDES KEWENANGAN
//     [5] => PERDES ASET
// [1] => DRAFTING DI DESA
//     [2] => EVALUASI KECAMATAN
//     [3] => BELUM DIBUAT
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