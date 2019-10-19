<?php defined('BASEPATH') OR exit('No direct script access allowed');

function filter_desa($link = '', $data = '', $desa_option = array())
{
	?>
	<form action="<?php echo $link ?>" method="get">
		<div class="form-group">
			<label>sortir perdesa <?php echo !empty(@$_GET['kec']) ? 'di kecamatan '.strtoupper($_GET['kec']) : ''; ?></label>
			<?php !empty($_GET['kec']) ? msg('jika tidak memilih salah satu desa maka akan menampilkan semua data '.$data.' di kecamatan '.$_GET['kec'],'warning') : ''; ?>
		</div>
		<div class="form-group form-inline">
			<select class="form-control select2" name="desa_id">
				<option>pilih desa</option>
				<?php foreach ($desa_option as $key => $value): ?>
					<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
				<?php endforeach ?>
			</select>
			<?php if (!is_desa()): ?>
				<input type="hidden" name="kec" value="<?php echo @$_GET['kec'] ?>">
			<?php endif ?>
			<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		</div>
	</form>
	<?php
}

function filter_kecamatan($link ='', $kec_option = array())
{
	?>
	<form action="<?php echo $link ?>" method="get">
		<div class="form-group">
			<label>sortir kecamatan</label>
		</div>
		<div class="form-group form-inline">
			<select class="form-control select2" name="kec">
				<option>pilih kecamatan</option>
				<?php foreach ($kec_option as $key => $value): ?>
					<option value="<?php echo str_replace('kec_','',$value['nama']) ?>"><?php echo strtoupper(str_replace('kec_','',$value['nama'])) ?></option>
				<?php endforeach ?>
			</select>
			<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		</div>
	</form>
	<?php
}