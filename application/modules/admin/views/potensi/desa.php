<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form action="<?php echo base_url('admin/potensi/list/') ?>" method="get">
	<div class="form-group">
		<label>sortir perdesa</label>
	</div>
	<div class="form-group form-inline">
		<select class="form-control select2" name="desa_id">
			<option>pilih desa</option>
			<?php foreach ($desa_option as $key => $value): ?>
				<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
			<?php endforeach ?>
		</select>
		<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	</div>
</form>