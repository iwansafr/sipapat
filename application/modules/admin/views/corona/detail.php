<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($data))
{
	?>
	<style>
		td{
			width: 50%;
		}
	</style>
	<div class="panel panel-default card card-default">
		<div class="panel-heading card-header">
			detail
			<?php 
			if(empty($_GET['s']))
			{
				?>
				<a href="?s=print" target="_blank" class="pull-right btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
				<?php
			}
			?>
		</div>
		<div class="panel-body card-body">
			<table class="table table-hover">
				<tr>
					<td>Nama</td>
					<td>: <?php echo $data['nama'] ?></td>
				</tr>
				<tr>
					<td>Umur</td>
					<td>: <?php echo $data['umur'].' Tahun' ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>: <?php echo $kelamin[$data['jk']] ?></td>
				</tr>
				<tr>
					<td>No Handphone</td>
					<td>: <?php echo $data['hp'] ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>: <?php echo @$data['desa']['nama'].' RT '.$data['rt'].' RW '.$data['rw'] ?></td>
				</tr>
			</table>
			<div class="card-group panel-group">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<h6 class="card-title panel-title m-0 font-weight-bold text-primary">
							<a data-toggle="collapse" href="#dari">riwayat perjalanan</a>
						</h6>
					</div>
					<div id="dari" class="card-collapse panel-collapse ">
						<div class="card-body panel-body">
							<table class="table table-hover">
								<tr>
									<td>Dari Negara / Daerah</td>
									<td>: <?php echo $data['dari'] ?></td>
								</tr>
								<tr>
									<td>tgl kedatangan</td>
									<td>: <?php echo $data['tgl'] ?></td>
								</tr>
							</table>
						</div>
						<div class="card-footer panel-footer"></div>
					</div>
				</div>
			</div>
			<div class="card-group panel-group">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<h6 class="card-title panel-title m-0 font-weight-bold text-primary">
							<a data-toggle="collapse" href="#demam">Kondisi Saat Ini</a>
						</h6>
					</div>
					<div id="demam" class="card-collapse panel-collapse ">
						<div class="card-body panel-body">
							<table class="table table-hover">
								<tr>
									<td>Mengalami Demam</td>
									<td>: <?php echo $option[$data['demam']] ?></td>
								</tr>
								<tr>
									<td>Batuk Pilek, Sakit Tenggorokan</td>
									<td>: <?php echo $option[$data['bpst']] ?></td>
								</tr>
								<tr>
									<td>Sesak Nafas</td>
									<td>: <?php echo $option[$data['sesak_nafas']] ?></td>
								</tr>
								<tr>
									<td>Tidak Ada Keluhan</td>
									<td>: <?php echo $option[$data['no_keluhan']] ?></td>
								</tr>
							</table>
						</div>
						<div class="card-footer panel-footer"></div>
					</div>
				</div>
			</div>
			<table class="table table-hover">
				<tr>
					<td>Tatalaksana yang dilakukan</td>
					<td>: <?php echo $data['tatalaksana'] ?></td>
				</tr>
				<tr>
					<td>Keterangan (alasan penyebab mudik / pulang)</td>
					<td>: <?php echo $data['keterangan'] ?></td>
				</tr>
			</table>
		</div>
		<div class="panel-footer card-footer">
			
		</div>
	</div>
	<?php
}else{
	msg('mohon maaf data tidak ditemukan','danger');
}