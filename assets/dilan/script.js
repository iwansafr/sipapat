$(document).ready(function(){
	$.ajax({
		type:"post",
		data: {file:"'.$file.'"},
    url: _URL+"admin/dilan/insert",
    beforeSend: function(){
			var elem = document.getElementById("dilan_pro");
			var width = 1;
			var id = setInterval(frame,100);
			function frame(){
				if(width>=100){
					clearInterval(id);
				}else{
					width = width+1;
					elem.style.width = width + "%";
					var show = width;
					elem.innerHTML = show + " % menyiapkan data";
				}
			}
    },
    success:function(result){
    	if(result.status)
    	{
				var elem = document.getElementById("dilan_success_pro");
				var width = 1;
				var id = setInterval(frame,100);
				function frame(){
					if(width>=100){
						clearInterval(id);
					}else{
						width = width+1;
						elem.style.width = width + "%";
						var show = width;
						elem.innerHTML = show + " % data berhasil di upload";
					}
				}
    	}
    },
    error:function(){
    	console.log("error");
    }
  });
});