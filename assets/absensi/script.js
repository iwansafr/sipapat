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
  }
  console.log(h);
  x.innerHTML = "Jam : "+h + ":" + m + ":" + s;
}
setInterval(jam,1000);
function brgkt(){
	document.getElementById('status').value = '1';
	btn_brgkt = document.getElementById('btn_brgkt');
	btn_brgkt.classList.remove("btn-secondary");
	btn_brgkt.classList.remove("d-none");
	btn_brgkt.classList.add("btn-success");
	btn_plg = document.getElementById('btn_plg');
	btn_plg.classList.remove("btn-success");
	btn_plg.classList.add("btn-secondary");
	btn_plg.classList.add("d-none");
	btn_izin = document.getElementById('btn_izin');
	btn_izin.classList.remove("btn-success");
	btn_izin.classList.add("btn-secondary");
}
function plg(){
	document.getElementById('status').value = '2';
	btn_plg = document.getElementById('btn_plg');
	btn_plg.classList.remove("btn-secondary");
	btn_plg.classList.remove("d-none");
	btn_plg.classList.add("btn-success");
	btn_brgkt = document.getElementById('btn_brgkt');
	btn_brgkt.classList.remove("btn-success");
	btn_brgkt.classList.add("btn-secondary");
	btn_brgkt.classList.add("d-none");
	btn_izin = document.getElementById('btn_izin');
	btn_izin.classList.remove("btn-success");
	btn_izin.classList.add("btn-secondary");
}
function izin(){
	document.getElementById('status').value = '3';
	btn_izin = document.getElementById('btn_izin');
	btn_izin.classList.remove("btn-secondary");
	btn_izin.classList.add("btn-success");
	btn_plg = document.getElementById('btn_plg');
	btn_plg.classList.remove("btn-success");
	btn_plg.classList.add("btn-secondary");
	btn_brgkt = document.getElementById('btn_brgkt');
	btn_brgkt.classList.remove("btn-success");
	btn_brgkt.classList.add("btn-secondary");
}
$(document).ready(function(){
	function remove_alert(){
		$('.alert').remove();
		clearInterval(rm_msg);
	}
	var rm_msg = setInterval(remove_alert,5000);
});