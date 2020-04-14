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
  var now = h*60 + parseInt(m);
  var selesai_masuk = config_jam.selesai_masuk.split(':');
  var mulai_masuk = config_jam.mulai_masuk.split(':');
  var selesai_pulang = config_jam.selesai_pulang.split(':');
  var mulai_pulang = config_jam.mulai_pulang.split(':');

  var brgkt_start = mulai_masuk[0] * 60 + parseInt(mulai_masuk[1]);
  var brgkt_end = selesai_masuk[0] * 60 + parseInt(selesai_masuk[1]);
  var plg_start = mulai_pulang[0] * 60 + parseInt(mulai_pulang[1]);
  var plg_end = selesai_pulang[0] * 60 + parseInt(selesai_pulang[1]);
  if(brgkt_start<= now && now <= brgkt_end){
  	brgkt();
  }else if(brgkt_end<= now && now <= plg_start){
  	terlambat();
  }else if(now <=plg_end && now >= plg_start){
  	plg();
  }else{
  	off();
  }
  x.innerHTML = "Jam : "+h + ":" + m + ":" + s;
}
setInterval(jam,1000);
function brgkt(){
	document.getElementById('status').value = '1';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.innerHTML = '<i class="fa fa-building"></i> Berangkat';
	btn_status.classList.remove('btn-danger');
	btn_upload = document.getElementById('btn_upload');
	btn_status.classList.add('btn-success');
	// btn_upload.classList.remove("d-none");
}
function plg(){
	document.getElementById('status').value = '2';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.classList.remove('btn-danger');
	btn_status.innerHTML = '<i class="fa fa-home"></i> Pulang';
	btn_upload = document.getElementById('btn_upload');
	btn_status.classList.add('btn-success');
	// btn_upload.classList.remove("d-none");
}
function off(){
	document.getElementById('status').value = '4';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.classList.remove('btn-success');
	btn_status.classList.add('btn-danger');
	btn_status.innerHTML = '<i class="fa fa-building"></i> Absensi Off';
	btn_upload = document.getElementById('btn_upload');
	btn_upload.classList.add("d-none");
}
function terlambat(){
	document.getElementById('status').value = '4';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.classList.remove('btn-success');
	btn_status.classList.add('btn-danger');
	btn_status.innerHTML = '<i class="fa fa-building"></i> Terlambat';
	btn_upload = document.getElementById('btn_upload');
	// btn_upload.classList.remove("d-none");
}
$(document).ready(function(){
	function getLocation() {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition);
	  } else { 
	    alert("perangkat anda tidak mendukung untuk menangkap lokasi anda");
	  }
	}

	function showPosition(position) {
		$("form").find(".panel-body").append("<label>LOKASI</label><br>Latitude: " + position.coords.latitude + 
	  "<br>Longitude: " + position.coords.longitude+"<input type='hidden' name='koordinat' value='long:"+position.coords.longitude+",lat:"+position.coords.latitude+"'>");
	}
	getLocation();


	function remove_alert(){
		$('.alert').remove();
		clearInterval(rm_msg);
	}
	var rm_msg = setInterval(remove_alert,5000);

	function show_camera(){
		clearInterval(sh_cmr);
	}
	var sh_cmr = setInterval(show_camera,5000);
	
	function readURL(input,a){
	  if (input.files && input.files[0]){
	    var reader = new FileReader();
	    reader.onload = function(e){
	    	// if(e.total>500000 && isFileImage(input.files[0])){
	    	// 	var suc = $(a).siblings('input[type="file"]').val('');
	  			// alert('ukuran file tidak boleh lebih dari 500KB');
	    	// }else{
	    		console.log(e);
	      	$(a).attr('src', e.target.result);
	      	// $('#filename').html(e.target.result);
	    	// }
	    };
	    reader.readAsDataURL(input.files[0]);
	  }
	}
	$(document).on('change', 'input[type="file"]', function(){
		console.log($(this));
		var a = $('.image_place');
		readURL(this,a);
		// if (this.files && this.files[0]){
	 //    var reader = new FileReader();
	 //    reader.onload = function(e){
		// 	$('#filename').html(e.target.result);
	 //    };
	 //    reader.readAsDataURL(this.files[0]);
	 //  }
	});
	$(document).on('click','.sel_pd',function(){
		var id = $(this).data('id');
		$('input[name="perangkat_desa_id"]').val(id);
		btn_upload = document.getElementById('btn_upload');
		btn_upload.classList.remove("d-none");
		$('.sel_pd').removeClass('btn-success');
		// $('.sel_pd').removeClass('display-1');
		$('.sel_pd').addClass('btn-warning');

		$(this).addClass('btn-success')
		// $(this).addClass('display-1');
		$(this).removeClass('btn-warning')
	});	
});
