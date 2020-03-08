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
			<div class="form-group">
				<label for="">Nama Perangkat</label>
				<select name="perangkat_id" class="form-control select2" id="select2">
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
					<input type="file"  name="foto" class="form-control">
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
</script>