<form action="<?php echo base_url('admin/dilan/list') ?>" method="get">
	<div class="form-group">
		<label>sortir data</label>
	</div>
	<div class="form-group form-inline">
		<input type="hidden" value="<?php echo $_GET['group'] ?>" name="group">
		<select class="form-control select2" name="<?php echo @$_GET['group'] ?>">
			<option>pilih <?php echo @$_GET['group'] ?></option>
			<?php foreach ($data[@$_GET['group']] as $key => $value): ?>
				<option value="<?php echo $key ?>"><?php echo strtoupper($value) ?></option>
			<?php endforeach ?>
		</select>
		<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	</div>
</form>