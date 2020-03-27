<?php if (!empty($perangkat)): ?>
	
	<style>
		.fileContainer {
	    overflow: hidden;
	    position: relative;
	}

	.fileContainer [type=file] {
	    cursor: inherit;
	    display: block;
	    font-size: 999px;
	    filter: alpha(opacity=0);
	    min-height: 100%;
	    min-width: 100%;
	    opacity: 0;
	    position: absolute;
	    right: 0;
	    text-align: right;
	    top: 0;
	}

	/* Example stylistic flourishes */

	.fileContainer {
	    background: grey;
	    border-radius: .5em;
	    /*float: left;*/
	    padding: .5em;
	}

	.fileContainer [type=file] {
	    cursor: pointer;
	}
	}
	</style>
	<form action="" method="post" enctype="multipart/form-data">
		<hr>
		<div class="panel panel-success card card-success">
			<div class="card-header panel panel-heading">
				<h5>Absensi <?php echo $desa['nama'].' | '.$desa['kecamatan']?></h5>
			</div>
			<div class="panel-body panel card-body">
				<?php 
				if(!empty($status))
				{
					msg($status['msg'],$status['status']);
				}
				?>
				<div class="form-group">
					<div class="btn-group" role="group" aria-label="Basic example">
						<input type="hidden" id="status" name="status" value="1">
					  <label id="btn_status" class="btn d-none btn-success"></label>
					</div>
				</div>		
				<div class="form-group">
					<label for="">Nama Perangkat</label>
					<a href="" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
					<table class="table table-bordered table-sm tb_perangkat">
						<input type="hidden" id="pdid" name="perangkat_desa_id" value="0">
						<thead>
							<h5>Belum Absen</h5>
						</thead>
						<?php $i = 1;?>
						<?php foreach ($perangkat as $key => $value): ?>
							<tr>
								<td>
									<?php echo $i ?>
								</td>
								<td>
									<label class="btn btn-sm btn-warning sel_pd" data-id="<?php echo $value['id'] ?>"><?php echo $value['nama'].' | '.$jabatan[$value['jabatan']] ?></label>
								</td>
							</tr>
							<?php $i++ ?>
						<?php endforeach ?>
					</table>
					<table class="table table-bordered">
						<thead>
							<h5>Sudah Absen</h5>
						</thead>
						<?php $i = 1; ?>
						<?php foreach ($sudah as $key => $value): ?>
							<tr>
								<td>
									<?php echo $i ?>
								</td>
								<td>
									<label class="btn btn-sm btn-success" data-id="<?php echo $value['id'] ?>"><?php echo $value['nama'].' | '.$jabatan[$value['jabatan']] ?></label>
								</td>
							</tr>
							<?php $i++ ?>
						<?php endforeach ?>
					</table>
				</div>
				<div class="form-group" style="text-align: center;">
					<label for="foto">Foto</label>
					<br>
					<label class="fileContainer" style="padding: 10%;">
						<i class="fa fa-camera" style="font-size: 500%;"></i>
						<input type="file"  name="foto" class="form-control" accept=".gif, .jpg, .jpeg, .png" required>
					</label>
					<br>
					<img src="" class="image_place" class="img img-responsive" style="object-fit: cover; height: 200px;" alt="">
					<p id="filename"></p>
				</div>
			</div>
			<div class="panel-footer panel card-footer">
				<button class="btn btn-success d-none" id="btn_upload"><i class="fa fa-upload"></i> Upload</button>
				<div class="jam float-right">
					<span class="badge badge-success">
						<div id="jam">
							
						</div>
					</span>
				</div>
			</div>
		</div>
	</form>
	<script>

	</script>
<?php else: ?>
	<br>
	<?php msg('data tidak ditemukan','danger') ?>
<?php endif ?>