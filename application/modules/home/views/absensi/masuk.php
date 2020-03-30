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
		.image_place[src=""] {
		  display:none;
		}
	</style>
	<form action="" method="post" enctype="multipart/form-data">
		<hr>
		<div class="panel panel-success card card-success">
			<div class="card-header panel panel-heading" style="padding-bottom:1px;">
				<div class="form-group">
					<h5>Absensi <?php echo $desa['nama'].' | '.$desa['kecamatan']?></h5>
					<div class="btn-group" role="group" aria-label="Basic example">
						<input type="hidden" id="status" name="status" value="1">
					  <label style="margin-bottom: 0;font-size: 12px;" id="btn_status" class="btn btn-sm d-none btn-success"></label>
					</div>
				</div>		
			</div>
			<div class="panel-body panel card-body">
				<?php 
				if(!empty($status))
				{
					msg($status['msg'],$status['status']);
				}
				?>
				<div class="form-group">
					<table class="table table-bordered table-sm tb_perangkat">
						<input type="hidden" id="pdid" name="perangkat_desa_id" value="0">
						<a href="" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
						<thead>
							<th>no</th>
							<th>nama</th>
							<th>jabatan</th>
						</thead>
						<?php $i = 1;?>
						<?php foreach ($perangkat as $key => $value): ?>
							<?php if ($value['id'] == @intval($sudah[$value['id']]['id'])): ?>
								<tr class="btn-secondary">
									<td style="font-size: 12px;">
										<?php echo $i ?>
									</td>
									<td>
										<label style="margin-bottom: 0;font-size: 12px;"><?php echo $value['nama'] ?></label>
									</td>
									<td>
										<label style="margin-bottom: 0;font-size: 12px;"><?php echo $jabatan[$value['jabatan']] ?></label>
									</td>
								</tr>
							<?php else: ?>
								<tr class="sel_pd btn-warning" data-id="<?php echo $value['id'] ?>">
									<td style="font-size: 12px;">
										<?php echo $i ?>
									</td>
									<td>
										<label style="margin-bottom: 0;font-size: 12px;"><?php echo $value['nama'] ?></label>
									</td>
									<td>
										<label style="margin-bottom: 0;font-size: 12px;"><?php echo $jabatan[$value['jabatan']] ?></label>
									</td>
								</tr>
							<?php endif ?>
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
					<img src="" class="image_place" class="img img-responsive" style="object-fit: cover; height: 200px;" alt="foto">
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