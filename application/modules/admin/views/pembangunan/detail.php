<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($data))
{
	// pr($data);
	$class = '';
	$jenis = ['Non Fisik','Fisik'];
	$tahap = $data['tahap']<0 ? '1x Tahap' : 'Kegiatan Tahap '.$data['tahap'];
	?>
	<div class="panel panel-default card card-default">
		<div class="panel-heading card-header">
			Detail Pembangunan <?php echo $data['item'] ?>
		</div>
		<div class="panel-body card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
						<table class="table table-striped table-hover">
							<tr>
								<td>Item</td>
								<td>:</td>
								<td><?php echo $data['item'] ?></td>
							</tr>
							<tr>
								<td>Jenis</td>
								<td>:</td>
								<td><?php echo $jenis[$data['jenis']] ?></td>
							</tr>
							<tr>
								<td>Bidang</td>
								<td>:</td>
								<td><?php echo $bidang[$data['bidang']] ?></td>
							</tr>
							<tr>
								<td>Sumber Dana</td>
								<td>:</td>
								<td><?php echo $sumber_dana[$data['sumber_dana']] ?></td>
							</tr>
							<tr>
								<td>Anggaran</td>
								<td>:</td>
								<td><?php echo money($data['anggaran'], 'Rp')?></td>
							</tr>
							<?php if ($data['jenis'] == 0): ?>
								<tr>
									<td>Peserta</td>
									<td>:</td>
									<td><?php echo $data['peserta'] ?></td>
								</tr>
								<tr>
									<td>Tahap Kegiatan</td>
									<td>:</td>
									<td><?php echo $tahap ?></td>
								</tr>
							<?php else: ?>
								<tr>
									<td>pengerjaan</td>
									<td>:</td>
									<td><?php echo content_date($data['from_date']) ?> <br>sampai<br> <?php echo content_date($data['to_date']) ?></td>
								</tr>
							<?php endif ?>
							<tr>
								<td>Th Anggaran</td>
								<td>:</td>
								<td><?php echo $data['th_anggaran'];?></td>
							</tr>
						</table>
						<div class="col-xs-12">
							<?php 
							$volume = $data['vol'];
							if (!empty($volume))
							{
								$volume = explode("\n", $volume);
								?>
								<h3>Volume</h3>
								<table class="table table-striped table-hover table-sm">
									<tbody>
										<?php 
										$i = 1;
										foreach ($volume as $key => $value) 
										{
											$vol_val = explode(':', $value);
											?>
											<tr>
												<?php foreach ($vol_val as $lvkey => $lvvalue): ?>
													<td><?php echo $lvvalue ?></td>
												<?php endforeach ?>
											</tr>
											<?php
											$i++;
										}
										?>
									</tbody>
								</table>
								<?php
							}
							?>
						</div>
						<div class="col-xs-12">
							<?php 
							$lokasi = $data['lokasi'];
							if (!empty($lokasi))
							{
								$lokasi .= "\nDesa : ".@$desa['nama']."\nKecamatan : ".@$desa['kecamatan']."\n";
								$lokasi = explode("\n", $lokasi);
								?>
								<h3>lokasi</h3>
								<table class="table table-striped table-hover table-sm">
									<tbody>
										<?php 
										$i = 1;
										foreach ($lokasi as $key => $value) 
										{
											$lok_val = explode(':', $value);
											?>
											<tr>
												<?php foreach ($lok_val as $lvkey => $lvvalue): ?>
													<td><?php echo $lvvalue ?></td>
												<?php endforeach ?>
											</tr>
											<?php
											$i++;
										}
										?>
									</tbody>
								</table>
								<?php
							}
							?>
						</div>
					</div>
					<div class="col-md-8">
						<?php if ($data['jenis']==1): ?>
							<?php $gambar = [0,50,100]; ?>
							<div class="row">
								<?php foreach ($gambar as $key => $value): ?>
									<div class="col-md-4">
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>gambar <?php echo $value ?>%</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<img src="<?php echo image_module('pembangunan',$data['id'].'/'.$data['doc_'.$value]) ?>" class="img img-responsive" style="object-fit: cover;width: 100%;min-height:200px;">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php endforeach ?>
							</div>
						<?php else: ?>
							<div class="row">
								<div class="col-md-7">
									<table class="table table-hover table-striped">
										<!-- <thead>
											<tr>
												<th>Dokumentasi</th>
											</tr>
										</thead> -->
										<tbody>
											<tr>
												<td>
													<img src="<?php echo image_module('pembangunan',$data['id'].'/'.$data['doc']) ?>" class="img img-responsive" style="object-fit: cover;width: 100%; min-height: 250px;">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer card-footer" style="text-align: right;">
			<a style="font-size: 9px;" href="https://www.dinsua.co.id">dinusa</a>
		</div>
	</div>
	<?php
}