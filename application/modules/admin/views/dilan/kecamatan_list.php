<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form action="<?php echo base_url('admin/dilan/desa_list/') ?>" method="get">
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