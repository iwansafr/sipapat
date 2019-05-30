<?php defined('BASEPATH') OR exit('No direct script access allowed');
echo empty(@$_GET['s'])? '<a class="btn btn-warning btn-sm" href="'.base_url('admin/perangkat/'.$module_title[$data['kelompok']].'/list').'"><i class="fa fa-arrow-left"></i> kembali</a>' :'';
if(!empty($id) && is_numeric($id))
{
	if(!empty($data))
	{
		$image_src = image_module('perangkat_desa', $data['id'].'/'.$data['foto']);
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Profile <?php echo $module_title[$data['kelompok']].' '.$data['nama'] ?>
				<?php 
				if(empty($_GET['s']))
				{
					?>
					<a href="?s=print" target="_blank" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-pdf-o"></i>/<i class="fa fa-print"></i> CETAK</a>
					<?php
				}
				?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="image">
								<a href="#">
									<img src="<?php echo $image_src;?>" alt="" style="object-fit: cover;width: 100%; height: 350px;" class="img-responsive image-thumbnail image"  data-toggle="modal" data-target="#detail_image">
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
						<div class="col-md-4">
							<table class="table table-responsive">
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?php echo $data['nama'] ?></td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td>:</td>
									<td><?php echo $data['tempat_lahir'] ?></td>
								</tr>
								<tr>
									<td>Tgl Lahir</td>
									<td>:</td>
									<td><?php echo $data['tgl_lahir']; ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td><?php echo $kelamin[$data['kelamin']] ?></td>
								</tr>
								<tr>
									<td>Agama</td>
									<td>:</td>
									<td><?php echo $agama[$data['agama']] ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data['alamat'] ?></td>
								</tr>
								<tr>
									<td>Status Perkawinan</td>
									<td>:</td>
									<td><?php echo $status_perkawinan[$data['status_perkawinan']] ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-4">
							<table class="table table-responsive">
								<tr>
									<td>Pendidikan Terakhir</td>
									<td>:</td>
									<td><?php echo $pendidikan_terakhir[$data['status_perkawinan']] ?></td>
								</tr>
								<?php 
								if(!empty($jabatan[$kelompok]))
								{
									?>
									<tr>
										<td>Jabatan</td>
										<td>:</td>
										<td><?php echo $jabatan[$kelompok][$data['jabatan']] ?></td>
									</tr>
									<?php
								}
								if($module_title[$kelompok] == 'rt' || $module_title[$kelompok] == 'rw')
								{
									?>
									<tr>
										<td>RW</td>
										<td>:</td>
										<td><?php echo $data['rw'] ?></td>
									</tr>
									<?php
									if($module_title[$kelompok] == 'rt')
									{
										?>
										<tr>
											<td>RT</td>
											<td>:</td>
											<td><?php echo $data['rt'] ?></td>
										</tr>
										<?php
									}
								}
								?>
								<tr>
									<td>NO SK</td>
									<td>:</td>
									<td><?php echo $data['no_sk'] ?></td>
								</tr>
								<tr>
									<td>Tgl Pelantikan</td>
									<td>:</td>
									<td><?php echo $data['tgl_pelantikan'] ?></td>
								</tr>
								<tr>
									<td>Pelantik</td>
									<td>:</td>
									<td><?php echo $data['pelantik'] ?></td>
								</tr>
								<tr>
									<td>Bengkok</td>
									<td>:</td>
									<td><?php echo $data['bengkok'] ?></td>
								</tr>
								<tr>
									<td>Penghasilan</td>
									<td>:</td>
									<td><?php echo $data['penghasilan'] ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<?php 
							$riwayat_pendidikan = $data['riwayat_pendidikan'];
							if (!empty($riwayat_pendidikan))
							{
								$riwayat_pendidikan = explode("\n", $riwayat_pendidikan);
								?>
								<h3>Riwayat Pendidikan</h3>
								<table class="table table-responsive">
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
											<td><?php echo $i ?></td>
											<td><?php echo $value ?></td>
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
						<div class="col-md-6">
							<?php 
							$riwayat_diklat = $data['riwayat_diklat'];
							if (!empty($riwayat_diklat))
							{
								$riwayat_diklat = explode("\n", $riwayat_diklat);
								?>
								<h3>Riwayat Pendidikan</h3>
								<table class="table table-responsive">
									<tr>
										<th>No</th>
										<th>Diklat</th>
									</tr>
									<?php 
									$i = 1;
									foreach ($riwayat_diklat as $key => $value) 
									{
										?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $value ?></td>
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
					</div>
				</div>
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
		<?php
	}
}