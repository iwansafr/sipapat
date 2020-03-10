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
				<h5>Absensi</h5>			
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
					  <a href="#" id="btn_brgkt" onclick="brgkt()" class="btn btn-success">Berangkat</a>
					  <a href="#" id="btn_plg" onclick="plg()" class="btn btn-secondary">Pulang</a>
					</div>
				</div>		
				<div class="form-group">
					<label for="">Nama Perangkat</label>
					<select name="perangkat_desa_id" class="form-control select2" id="select2">
						<?php foreach ($perangkat as $key => $value): ?>
							<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'].' | '.$jabatan[$value['jabatan']] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group" style="text-align: center;">
					<label for="foto">Foto</label>
					<br>
					<label class="fileContainer" style="padding: 10%;">
						<i class="fa fa-camera" style="font-size: 500%;"></i>
						<input type="file"  name="foto" class="form-control" required>
					</label>
				</div>
			</div>
			<div class="panel-footer panel card-footer">
				<button class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
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
	  function addZero(i) {
	    if (i < 10) {
	      i = "0" + i;
	    }
	    return i;
	  }

	  function jam() {
	    var d = new Date();
	    var x = document.getElementById("jam");
	    var h = addZero(d.getHours());
	    var m = addZero(d.getMinutes());
	    var s = addZero(d.getSeconds());
	    x.innerHTML = "Jam : "+h + ":" + m + ":" + s;
	  }
	  setInterval(jam,1000);
	  function brgkt(){
	  	document.getElementById('status').value = '1';
	  	btn_brgkt = document.getElementById('btn_brgkt');
	  	btn_brgkt.classList.remove("btn-secondary");
	  	btn_brgkt.classList.add("btn-success");
	  	btn_plg = document.getElementById('btn_plg');
	  	btn_plg.classList.remove("btn-success");
	  	btn_plg.classList.add("btn-secondary");
	  }
	  function plg(){
	  	document.getElementById('status').value = '2';
	  	btn_plg = document.getElementById('btn_plg');
	  	btn_plg.classList.remove("btn-secondary");
	  	btn_plg.classList.add("btn-success");
	  	btn_brgkt = document.getElementById('btn_brgkt');
	  	btn_brgkt.classList.remove("btn-success");
	  	btn_brgkt.classList.add("btn-secondary");
	  }
	</script>
<?php else: ?>
	<br>
	<?php msg('data tidak ditemukan','danger') ?>
<?php endif ?>