<?php defined('BASEPATH') OR exit('No direct script access allowed');

$allowed = $this->input->get('allowed');
if(!empty($allowed) && is_desa())
{
	?>
	<a href="<?php echo base_url('admin/dilan/download_template') ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Download Template</a>
	<div class="panel panel-default card card-default">
		<div class="panel panel-heading card card-header">
			upload data penduduk desa
		</div>
		<form action="" method="post" enctype="multipart/form-data" id="dilan_form">
			<div class="panel panel-body card card-body">
				<div class="form-group">
					<label for="">upload excel</label>
					<input type="file" name="doc" class="form-control">
				</div>
			</div>
			<div class="panel panel-footer card card-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-success"><i class="fa fa-upload"></i>Upload</button>
				</div>
			</div>
		</form>
	</div>

	<div class="progress progress-md active hidden" id="dilan_load">
	  <div id="dilan_pro" class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
	    <span class="sr-only" id="dilan_span">0% Complete</span>
	  </div>
	</div>
	<div class="progress progress-md active hidden" id="dilan_success_load">
	  <div id="dilan_success_pro" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
	    <span class="sr-only" id="dilan_span">0% Complete</span>
	  </div>
	</div>
	<div id="error"></div>
	<?php
}else{
	msg('anda tidak punya akses ke halaman ini','danger');
}