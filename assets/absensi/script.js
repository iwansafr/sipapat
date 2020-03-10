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