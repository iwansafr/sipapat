<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<hr>
<?php 
if(empty($data) && !empty($_GET['nik']))
{
	msg('maaf data penduduk tidak ditemukan','danger');
}else if(!empty($data)){
	if(!empty($data['keterangan']))
	{
		$kelamin = ['1'=>'Laki-laki','2'=>'Perempuan'];
		?>
		<form action="<?php echo base_url('home/suket/ajukan') ?>" method="post">
			<div class="card card-default panel panel-default">
				<div class="panel panel-heading card card-header">
					detail data diri
				</div>
				<div class="panel-body card-body">
					<table class="table">
						<tr>
							<td>NAMA</td>
							<td>:</td>
							<td><?php echo $data['nama'] ?></td>
						</tr>
						<tr>
							<td>JK</td>
							<td>:</td>
							<td><?php echo @$kelamin[$data['jk']] ?></td>
						</tr>
						<tr>
							<td>TTL</td>
							<td>:</td>
							<td><?php echo $data['tmpt_lhr'].', '.content_date($data['tgl_lhr']) ?></td>
						</tr>
						<tr>
							<td>PEKERJAAN</td>
							<td>:</td>
							<td><?php echo $data['data_pekerjaan'][$data['pekerjaan']] ?></td>
						</tr>
						<tr>
							<td>TEMPAT TINGGAL</td>
							<td>:</td>
							<td><?php echo $data['desa'] ?></td>
						</tr>
						<tr>
							<td>SURAT BUKTI</td>
							<td>:</td>
							<td>KTP <?php echo $data['nik'] ?> KK <?php echo $data['no_kk'] ?></td>
						</tr>
					</table>
					<hr>
					<div class="form-group">
						<label>Keperluan</label>
						<select name="keterangan_id" class="form-control" required>
							<?php foreach ($data['keterangan'] as $key => $value): ?>
								<option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
							<?php endforeach ?>
						</select>
						<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
					</div>
					<div class="form-group">
						<label>Catatan Tambahan</label>
						<textarea name="keterangan" rows="3" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>email</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>hp</label>
						<input type="text" name="hp" class="form-control" required>
					</div>
				</div>
				<div class="panel-footer card-footer">
					<button class="btn btn-success">Ajukan</button>
				</div>
			</div>
		</form>
		<?php
	}
}
?>
<?php if (empty($data)): ?>
	<form action="" method="get">
		<div class="card">
			<div class="card-header">
				Suket
			</div>
			<div class="card-body">
				<input type="hidden" name="village_id" value="<?php echo @intval($_GET['village_id']) ?>">
				<div class="form-group">
					<label>NIK</label>
					<input type="number" class="form-control" name="nik" required>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-success">Cari</button>
			</div>
		</div>
	</form>
<?php endif ?>