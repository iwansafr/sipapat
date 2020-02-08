<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_root() || is_admin() || is_inspektorat())
{
	$desa_id = @intval($_GET['desa_id']);
}else{
	$desa_id = $this->sipapat_model->get_desa_id();
}
$desa = $this->sipapat_model->get_desa($desa_id);
if(!empty($desa_id) && !empty($desa))
{
	$rekening = $this->sipapat_model->get_rekening($desa_id);
	if(!empty($rekening))
	{
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Rekening Desa <?php echo $rekening['nama'] ?>
				<?php 
				if(empty($_GET['s']))
				{
					?>
					<a href="?s=print&desa_id=<?php echo $desa_id?>" target="_blank" class="pull-right btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
					<a href="<?php echo base_url('admin/desa/rekening_pdf').'?desa_id='.$desa_id ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-pdf"></i> Pdf</a>
					<?php
				}
				?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-responsive">
							<tr>
								<td style="width: 50%;">Nama Pemilik Rekening</td>
								<td>:</td>
								<td><?php echo $rekening['nama'] ?></td>
							</tr>
							<tr>
								<td style="width: 50%;">Alamat Pemilik Rekening</td>
								<td>:</td>
								<td><?php echo $rekening['alamat'] ?></td>
							</tr>
							<tr>
								<td style="width: 50%;">Nomor Rekening Bank</td>
								<td>:</td>
								<td><?php echo $rekening['no_rek'] ?></td>
							</tr>
							<tr>
								<td style="width: 50%;">Nama Bank</td>
								<td>:</td>
								<td><?php echo $rekening['bank'] ?></td>
							</tr>
							<tr>
								<td style="width: 50%;">Nomor NPWP</td>
								<td>:</td>
								<td><?php echo $rekening['no_npwp'] ?></td>
							</tr>
						</table>
						<div class="row">
							<div class="col-md-6">
								<label>Foto Rekening</label>
								<?php if (!empty($rekening['foto_rek'])): ?>
									<img src="<?php echo image_module('desa_rekening',$rekening['id'].'/'.$rekening['foto_rek']) ?>" class="img img-responsive img-fluid" height="100%">
								<?php endif ?>
							</div>
							<div class="col-md-6">
								<label>Foto NPWP</label>
								<?php if (!empty($rekening['foto_npwp'])): ?>
									<img src="<?php echo image_module('desa_rekening',$rekening['id'].'/'.$rekening['foto_npwp']) ?>" class="img img-responsive img-fluid" height="100%">
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
		<?php
	}else{
		msg('data belum ada','danger');
	}
}else{
	msg('desa tidak diketahui','warning');
}