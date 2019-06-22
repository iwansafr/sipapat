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
					<div class="col-xs-12">
						<table class="table table-striped table-hover table-sm">
							<tbody>
								<tr>
									<td style="width:50%;">Item</td>
									<td style="width:2%;">:</td>
									<td><?php echo $data['item'] ?></td>
								</tr>
								<tr>
									<td style="width=50%;">Jenis</td>
									<td style="width:2%;">:</td>
									<td><?php echo $jenis[$data['jenis']] ?></td>
								</tr>
								<tr>
									<td style="width=50%;">Bidang</td>
									<td style="width:2%;">:</td>
									<td><?php echo $bidang[$data['bidang']] ?></td>
								</tr>
								<tr>
									<td style="width=50%;">Sumber Dana</td>
									<td style="width:2%;">:</td>
									<td><?php echo $sumber_dana[$data['sumber_dana']] ?></td>
								</tr>
								<tr>
									<td style="width=50%;">Anggaran</td>
									<td style="width:2%;">:</td>
									<td><?php echo money($data['anggaran'], 'Rp')?></td>
								</tr>
								<?php if ($data['jenis'] == 0): ?>
									<tr>
										<td style="width=50%;">Peserta</td>
										<td style="width:2%;">:</td>
										<td><?php echo $data['peserta'] ?></td>
									</tr>
									<tr>
										<td style="width=50%;">Tahap Kegiatan</td>
										<td style="width:2%;">:</td>
										<td><?php echo $tahap ?></td>
									</tr>
								<?php else: ?>
									<tr>
										<td style="width=50%;">pengerjaan</td>
										<td style="width:2%;">:</td>
										<td><?php echo content_date($data['from_date']) ?> <br>sampai<br> <?php echo content_date($data['to_date']) ?></td>
									</tr>
								<?php endif ?>
								<tr>
									<td style="width=50%;">Th Anggaran</td>
									<td style="width:2%;">:</td>
									<td><?php echo $data['th_anggaran'];?></td>
								</tr>
							</tbody>
						</table>
					</div>
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
											<?php $j=0; ?>
											<?php foreach ($vol_val as $lvkey => $lvvalue): ?>
												<td <?php echo empty($j) ? 'style="width:50%;"' : ''; ?>><?php echo $lvvalue ?></td>
												<?php if ($j==0): ?>
													<td style="width:2%;">:</td>
												<?php endif ?>
												<?php $j++; ?>
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
							$koordinat = $data['koordinat'];
							$koordinat = explode(",", $koordinat);
							$lokasi .= "\nDesa : ".@$desa['nama']."\nKecamatan : ".@$desa['kecamatan'];
							$lokasi .= "\n".$koordinat[0]."\n".$koordinat[1];
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
											<?php $j =0; ?>
											<?php foreach ($lok_val as $lvkey => $lvvalue): ?>
												<td <?php echo empty($j) ? 'style="width:50%;"' : ''; ?>><?php echo $lvvalue ?></td>
												<?php if ($j==0): ?>
													<td style="width:2%;">:</td>
												<?php endif ?>
												<?php $j++; ?>
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
			</div>
		</div>
		<div class="panel-footer card-footer" style="text-align: right;">
			<a style="font-size: 9px;" href="https://www.dinsua.co.id">dinusa</a>
		</div>
	</div>
	<?php
}