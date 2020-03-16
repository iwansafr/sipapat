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
  if(h<8){
  	brgkt();
  }else if(h>=16){
  	plg();
  }else if(h>=8){
  	terlambat();
  }
  x.innerHTML = "Jam : "+h + ":" + m + ":" + s;
}
setInterval(jam,1000);
function brgkt(){
	document.getElementById('status').value = '1';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.innerHTML = '<i class="fa fa-building"></i> Berangkat';
	btn_upload = document.getElementById('btn_upload');
	btn_upload.classList.remove("d-none");
}
function plg(){
	document.getElementById('status').value = '2';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.innerHTML = '<i class="fa fa-home"></i> Pulang';
	btn_upload = document.getElementById('btn_upload');
	btn_upload.classList.remove("d-none");
}
function terlambat(){
	document.getElementById('status').value = '4';
	btn_status = document.getElementById('btn_status');
	btn_status.classList.remove("d-none");
	btn_status.classList.remove('btn-success');
	btn_status.classList.add('btn-danger');
	btn_status.innerHTML = '<i class="fa fa-building"></i> Terlambat';
	btn_upload = document.getElementById('btn_upload');
	btn_upload.classList.remove("d-none");
}
$(document).ready(function(){
	function remove_alert(){
		$('.alert').remove();
		clearInterval(rm_msg);
	}
	var rm_msg = setInterval(remove_alert,5000);
});