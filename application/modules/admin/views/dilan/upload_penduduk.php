<div class="panel">
	<form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="upload_dilan">
		<div class="panel-heading">
			Upload Data Penduduk
		</div>
		<div class="panel-body">
			<div class="form-group">
				<?php if (!empty($desa)): ?>
					<label for="desa">desa</label>
					<select name="desa_id" class="form-control select2">
						<?php foreach ($desa as $key => $value): ?>
							<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'].' | '.$value['kecamatan'] ?></option>
						<?php endforeach ?>
					</select>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label for="data penduduk">data penduduk</label>
				<input type="file" class="form-control" name="file">
			</div>
		</div>
		<div class="panel-footer">
			<button type="submit" class="btn btn-sm btn-success">Upload</button>
		</div>
	</form>
</div>
<div class="panel">
	<div class="panel-body">
		<div id="upload_loading">
		
		</div>
		<div id="data_duplicate">
			
		</div>
		<div class="progress progress-sm active hidden" id="load_bar">
	    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	      <span class="sr-only">20% Complete</span>
	    </div>
	  </div>
	</div>
</div>