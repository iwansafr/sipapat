<?php if (!empty($kepdes)): ?>
	
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
		.d-none{
			display: none;
		}
	</style>
	<?php if (empty($libur)): ?>
		<form action="" method="post" enctype="multipart/form-data">
			<hr>
			<div class="panel panel-success card card-success">
				<div class="card-header panel panel-heading" style="padding-bottom:1px;">
					<div class="form-group">
						<h5>Absensi <?php echo $desa['nama'].' | '.$desa['kecamatan']?></h5>
						<?php if (empty($libur_status)): ?>
							<div class="btn-group" role="group" aria-label="Basic example">
								<input type="hidden" id="status" name="status" value="1">
							  <label style="margin-bottom: 0;font-size: 12px;" id="btn_status" class="btn btn-sm d-none btn-success"></label>
							</div>
						<?php endif ?>
					</div>		
				</div>
				<div class="panel-body panel card-body">
					<?php 
					if(!empty($status))
					{
						msg($status['msg'],$status['status']);
					}
					?>
					<?php if (empty($libur_status)): ?>
						<div class="form-group">
							<table class="table table-bordered table-sm tb_perangkat" style="text-align: center;">
								<input type="hidden" id="pdid" name="perangkat_desa_id" value="0">
								<a href="" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
								| <span class="badge badge-info">pastikan nama sudah diklik</span>
								| <span class="badge badge-info">dan sudah capture foto</span>
								| <span class="badge badge-info">agar tombol upload muncul</span>
								<thead>
									<th style="text-align: center;">nama</th>
								</thead>
								<?php $i = 1;?>
								<?php foreach ($perangkat as $key => $value): ?>
								<?php $ganjil = $i%2;?>
									<?php if ($value['id'] == @intval($sudah[$value['id']]['id'])): ?>
										<?php 
										if($sudah[$value['id']]['valid'] == 2){
											$color = 'btn-danger';
										}else if($sudah[$value['id']]['valid'] == 1){
											$color = 'btn-success';
										}else{
											$color = 'btn-primary';
										}
										?>
										<tr style="background: grey;">
											<td>
												<label style="font-size: 24px;"><?php echo $value['nama'].' | <label class="'.$color.'">'.$valid[$sudah[$value['id']]['valid']].'</label>' ?></label>
											</td>
										</tr>
									<?php else: ?>
										<tr class="sel_pd btn-warning" data-id="<?php echo $value['id'] ?>">
											<td>
												<label style="font-size: 24px;"><?php echo $value['nama'] ?></label>
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
					<?php else: ?>
						<?php
						echo '<center>';
						echo '<h5>Mohon Maaf Ini Hari Libur</h5>';
						echo '<h5>'.date('Y-m-d').' '.$libur_status['title'].'</h5>';
						echo '</center>';
						?>
					<?php endif ?>
				</div>
				<div class="panel-footer panel card-footer">
					<button class="btn btn-success d-none" id="btn_upload"><i class="fa fa-upload"></i> Upload</button>
					<div class="jam pull-right">
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
		<hr>
		<h1 style="text-align: center;background: #b91533;color: white;">Maaf Hari Ini Libur</h1>
		<a href="" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
	<?php endif ?>
	
<?php else: ?>
	<br>
	<?php msg('data tidak ditemukan','danger') ?>
<?php endif ?>