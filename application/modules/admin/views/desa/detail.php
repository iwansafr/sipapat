<?php defined('BASEPATH') OR exit('No direct script access allowed');
echo empty($_GET['s']) ? '<a class="btn btn-warning btn-sm" href="'.base_url('admin/desa/list').'"><i class="fa fa-arrow-left"></i> kembali</a>' :'';
if(!empty($id) && is_numeric($id))
{
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Profile Desa <?php echo $data['nama'] ?>
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
						<img src="<?php echo $image;?>" alt="" style="object-fit: cover; height: 350px;" class="img-responsive image-thumbnail image" >
					</div>
					<div class="col-md-5 col-xs-7">
						<table class="table table-responsive">
							<tr>
								<td>Kode</td>
								<td>:</td>
								<td><?php echo $data['kode'] ?></td>
							</tr>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td><?php echo $data['nama'] ?></td>
							</tr>
							<tr>
								<td>Kecamatan</td>
								<td>:</td>
								<td><?php echo $data['kecamatan'] ?></td>
							</tr>
							<tr>
								<td>Kabupaten</td>
								<td>:</td>
								<td><?php echo $data['kabupaten'] ?></td>
							</tr>
							<tr>
								<td>Provinsi</td>
								<td>:</td>
								<td><?php echo $data['provinsi'] ?></td>
							</tr>
							<tr>
								<td>Kode Pos</td>
								<td>:</td>
								<td><?php echo $data['kode_pos'] ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-4">
						<table class="table table-responsive">
							<tr>
								<td>Telepon</td>
								<td>:</td>
								<td><?php echo $data['telepon'] ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo $data['email'] ?></td>
							</tr>
							<tr>
								<td>Website</td>
								<td>:</td>
								<td><?php echo $data['website'] ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?php echo $data['alamat'] ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			
		</div>
	</div>
	<?php
}else{
	msg('url tidak valid','danger');
}