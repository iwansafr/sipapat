<?php if (!empty($desa)): ?>
	
	<style>
		.container-detected {
        text-align: center;
        display: flex;
        flex-direction: column;
        padding: 20px;
        align-items: center;
        justify-content: center;
    }

    .container-image {
        position: relative;
        /* width: image.width,
        height: image.height, */
        margin: 0px auto;
        max-width: 700px;
        max-height: 700px;
        overflow: auto;
    }
    .data-container {
       position: relative;
        /* width: image.width,
        height: image.height, */
        margin: 5px auto;
        max-width: 500px;
        max-height: 500px;
        overflow: auto;
        width: 100%;
    }
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
		td{
			border-radius: 5em;
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
					<!-- <audio id="audio" preload="auto" autoplay="autoplay" hidden="true">
					  <source src="<?php echo base_url('assets/absensi/sound/terima_kasih_wanita.mp3')?>">
					</audio> -->
					<?php 
					if(!empty($status))
					{
						msg($status['msg'],$status['status']);
					}
					if(empty($libur_status))
					{
						$clustp = array_chunk($perangkat, 2);
						// $clustp = $perangkat;
						// pr($clustp);
						?>
						<div class="form-group">
							<table class="table tb_perangkat">
								<input type="hidden" id="pdid" name="perangkat_desa_id" value="0">
								<a href="" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
								<div class="">
									<label for="" class="btn btn-success"></label> Tanda Sudah 
									Absen
									<label for="" class="btn btn-danger"></label> Tanda Belum Absen
								</div>
								<!-- | <span class="badge badge-info">pastikan nama sudah diklik dan sudah capture foto agar tombol upload muncul</span> -->
								<!-- <thead> -->
								<!-- 	<th>no</th>
									<th>nama</th> -->
									<!-- <th>jabatan</th> -->
								<!-- </thead> -->
								<?php $i = 1;?>
								<?php foreach ($clustp as $vkey => $vvalue): ?>
									<tr>
										<?php foreach ($vvalue as $key => $value): ?>
												<?php if ($value['id'] == @intval($sudah[$value['id']]['id'])): ?>
													<?php 
													if($sudah[$value['id']]['valid'] == 2){
														$color = 'btn-secondary';
													}else if($sudah[$value['id']]['valid'] == 1){
														$color = 'btn-secondary';
													}else{
														$color = 'btn-primary';
													}
													?>
													<td class="btn-success" data-id="<?php echo $value['id'] ?>" align="center">
														<label style="margin-bottom: 0;font-size: 24px;"><?php echo $value['nama'] ?></label>
														<!-- <label style="margin-bottom: 0;font-size: 24px;"><?php echo $value['nama'].' | <label class="'.$color.'" style="font-size:12px;">'.$valid[$sudah[$value['id']]['valid']].'</label>' ?></label> -->
													</td>
												<?php else: ?>
													<td style="font-size: 24px;" class="sel_pd btn-danger" data-id="<?php echo $value['id'] ?>" align="center">
														<label style="margin-bottom: 0;font-size: 24px;"><?php echo $value['nama'] ?></label>
													</td>
												<?php endif ?>
												<?php $i++ ?>
										<?php endforeach ?>
									</tr>
								<?php endforeach ?>
							</table>
						</div>
						<div class="form-group" style="text-align: center;">
							<label for="foto">Foto</label>
							<br>
							<label class="fileContainer hidden" style="padding: 1%;">
								<i class="fa fa-camera" style="font-size: 100%;"></i>
								<input type="file" id="imageUpload" name="foto" class="form-control" accept=".gif, .jpg, .jpeg, .png" required oninvalid="this.setCustomValidity('Anda Belum Foto')" oninput="setCustomValidity('')">
							</label>
							<br>
							<img src="" class="image_place" class="img img-responsive" style="object-fit: cover; height: 200px;" alt="foto">
							<p id="filename"></p>
						</div>
						<div class="container-detected">
							<div class="container-image" id="container-image">

					    </div>
					    <div class="data-container" id="container-data">

					    </div>
					    <div id="loading">

					    </div>
						</div>
						<?php
					}else{
						echo '<center>';
						echo '<h5>Mohon Maaf Ini Hari Libur</h5>';
						echo '<h5>'.date('Y-m-d').' '.$libur_status['title'].'</h5>';
						echo '</center>';
					}
					?>
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
		<?php if (!empty($perangkat_bolos)): ?>
			<div class="accordion" id="accordionData">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h2 class="mb-0">
			        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			        	<span class="badge badge-danger">Data Perangkat Absensi Tidak Valid / Tidak Berangkat Pagi</span>
			        </button>
			      </h2>
			    </div>

			    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionData">
			      <div class="card-body">
			      	<table class="table table-bordered table-sm tb_perangkat">
			      		<thead>
			      			<th>No</th>
			      			<th>Nama</th>
			      			<th>Jabatan</th>
			      		</thead>
			      		<tbody>
			      			<?php $i = 1; ?>
					        <?php foreach ($perangkat_bolos as $key => $value): ?>
					        	<tr class="btn-secondary">
											<td style="font-size: 12px;">
												<?php echo $i ?>
											</td>
											<td>
												<label style="margin-bottom: 0;font-size: 12px;"><?php echo $value['nama']; ?></label>
											</td>
											<td>
												<label style="margin-bottom: 0;font-size: 12px;"><?php echo $jabatan[$value['jabatan']] ?></label>
											</td>
										</tr>
										<?php $i++; ?>
					        <?php endforeach ?>
			      		</tbody>
			      	</table>
			      </div>
			    </div>
			    <hr>
			  </div>
			</div>
		<?php endif ?>
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