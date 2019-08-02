<?php defined('BASEPATH') OR exit('No direct script access allowed');
$module_kelompok = $module_title[$data['kelompok']] == 'perangkat' ? '': $module_title[$data['kelompok']];
$class = '';
if(!empty(@$_GET['s']))
{
	$class = 'table-sm';
	?>
	<style type="text/css">
		td{
			padding: 0!important;
		}
	</style>
	<?php
}else{
	echo '<a class="btn btn-warning btn-sm" href="'.base_url('admin/perangkat/'.$module_kelompok.'/list').'"><i class="fa fa-arrow-left"></i> kembali</a>';
}
if(!empty($id) && is_numeric($id))
{
	if(!empty($data))
	{
		$image_src = image_module('perangkat_desa', $data['id'].'/'.$data['foto']);
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				PROFIL <?php echo strtoupper($module_title[$data['kelompok']].' '.$data['nama']); ?>
				<?php 
				if(empty($_GET['s']))
				{
					?>
					<a href="?s=print" target="_blank" class="pull-right btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
					<?php
				}
				?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3 col-xs-5">
							<div class="image">
								<a href="#">
									<img src="<?php echo $image_src;?>" alt="" style="object-fit: cover; height: 350px;" class="img-responsive image-thumbnail image"  data-toggle="modal" data-target="#detail_image">
								</a>
							</div>
							<div class="modal fade" id="detail_image" tabindex="-1" role="dialog" aria-labelledby="detail_image">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="detail_image"><?php echo 'Foto '.$data['nama'];?></h4>
							      </div>
							      <div class="modal-body" style="text-align: center;">
							        <img src="<?php echo $image_src; ?>" class="img-thumbnail img-responsive">
							      </div>
							      <div class="modal-footer">
							      </div>
							    </div>
							  </div>
							</div>
						</div>
						<div class="col-md-4 col-xs-7">
							<table class="table table-responsive <?php echo $class ?>">
								<tr>
									<td>NIK</td>
									<td>:</td>
									<td><?php echo strtoupper($data['nik']); ?></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?php echo strtoupper($data['nama']); ?></td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td>:</td>
									<td><?php echo strtoupper($data['tempat_lahir']); ?></td>
								</tr>
								<tr>
									<td>Tgl Lahir</td>
									<td>:</td>
									<td><?php echo strtoupper($data['tgl_lahir']); ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td><?php echo strtoupper($kelamin[$data['kelamin']]); ?></td>
								</tr>
								<tr>
									<td>Agama</td>
									<td>:</td>
									<td><?php echo strtoupper($agama[$data['agama']]); ?></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td>:</td>
									<td><?php echo strtoupper($data['telepon']); ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo strtoupper($data['alamat']); ?></td>
								</tr>
								<tr>
									<td>Status Perkawinan</td>
									<td>:</td>
									<td><?php echo strtoupper($status_perkawinan[$data['status_perkawinan']]); ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-4">
							<table class="table table-responsive <?php echo $class ?>">
								<tr>
									<td>Pendidikan Terakhir</td>
									<td>:</td>
									<td><?php echo strtoupper($pendidikan_terakhir[$data['pendidikan_terakhir']]) ?></td>
								</tr>
								<?php 
								if(!empty($jabatan[$kelompok]))
								{
									?>
									<tr>
										<td>Jabatan</td>
										<td>:</td>
										<td><?php echo strtoupper($jabatan[$kelompok][$data['jabatan']]); ?></td>
									</tr>
									<?php
								}
								if($module_title[$kelompok] == 'rt' || $module_title[$kelompok] == 'rw')
								{
									$penghasilan_title = 'Insentif/Tahun';
									?>
									<tr>
										<td>RW</td>
										<td>:</td>
										<td><?php echo strtoupper($data['rw']); ?></td>
									</tr>
									<?php
									if($module_title[$kelompok] == 'rt')
									{
										?>
										<tr>
											<td>RT</td>
											<td>:</td>
											<td><?php echo strtoupper($data['rt']); ?></td>
										</tr>
										<?php
									}
								}else{
									$penghasilan_title = $kelompok == 1 ? 'Gaji' : 'Insentif/Tahun';
									?>
									<tr>
										<td>Bengkok</td>
										<td>:</td>
										<td><?php echo strtoupper($data['bengkok']); ?></td>
									</tr>
									<?php
								}
								?>
								<tr>
									<td>NO SK</td>
									<td>:</td>
									<td><?php echo strtoupper($data['no_sk']); ?></td>
								</tr>
								<tr>
									<td>Tgl Pelantikan</td>
									<td>:</td>
									<td><?php echo strtoupper($data['tgl_pelantikan']); ?></td>
								</tr>
								<tr>
									<td>Pelantik</td>
									<td>:</td>
									<td><?php echo strtoupper($data['pelantik']); ?></td>
								</tr>
								<tr>
									<td><?php echo strtoupper($penghasilan_title); ?></td>
									<td>:</td>
									<td><?php echo strtoupper($data['penghasilan']); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-xs-6">
							<?php 
							$riwayat_pendidikan = $data['riwayat_pendidikan'];
							if (!empty($riwayat_pendidikan))
							{
								$riwayat_pendidikan = explode("\n", $riwayat_pendidikan);
								?>
								<h3>Riwayat Pendidikan</h3>
								<table class="table table-responsive <?php echo $class ?>">
									<tr>
										<th>No</th>
										<th>Jenjang</th>
									</tr>
									<?php 
									$i = 1;
									foreach ($riwayat_pendidikan as $key => $value) 
									{
										?>
										<tr>
											<td><?php echo strtoupper($i); ?></td>
											<td><?php echo strtoupper($value); ?></td>
										</tr>
										<?php
										$i++;
									}
									?>
									
								</table>
								<?php
							}
							?>
						</div>
						<div class="col-xs-6">
							<?php 
							$riwayat_diklat = $data['riwayat_diklat'];
							if (!empty($riwayat_diklat))
							{
								$riwayat_diklat = explode("\n", $riwayat_diklat);
								?>
								<h3>Riwayat Diklat</h3>
								<table class="table table-responsive <?php echo $class ?>">
									<thead>
										<tr>
											<th>No</th>
											<th>Diklat</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
										foreach ($riwayat_diklat as $key => $value) 
										{
											?>
											<tr>
												<td><?php echo strtoupper($i); ?></td>
												<td><?php echo strtoupper($value); ?></td>
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
			<div class="panel-footer">
				
			</div>
		</div>
		<?php
	}
}