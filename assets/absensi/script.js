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
  if(h<8 && h>=6){
  	brgkt();
  }else if(h>=8 && h<14){
  	terlambat();
  }else if(h<16 && h>=14){
  	plg();
  }else if(h==16 && m==0){
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
	// btn_upload.classList.remove("d-none");
}
function plg(){
	document.getElementById('status').value = '2';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.classList.remove('btn-danger');
	btn_status.innerHTML = '<i class="fa fa-home"></i> Pulang';
	btn_upload = document.getElementById('btn_upload');
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
	function remove_alert(){
		$('.alert').remove();
		clearInterval(rm_msg);
	}
	var rm_msg = setInterval(remove_alert,5000);
	
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
	      	$('#filename').html(e.target.result);
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
		$('.sel_pd').addClass('btn-warning');

		$(this).addClass('btn-success')
		$(this).removeClass('btn-warning')
	});	
});
