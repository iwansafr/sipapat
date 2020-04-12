$(document).ready(function(){
	var villages;
	$.ajax({
		type:'post',
		data: {id:_ID},
    url: _URL+'admin/villages/all',
    success:function(result){
    	if(result)
    	{
    		villages = result;
    	}
    }
  });
	function set_option(select,data){
		if(select[0] != undefined){
			while (select[0].options.length) {
	    	select[0].remove(0);
	    }
			var selectbox = select[0].options;
			for(var i = 0, l = data.length; i < l; i++){
			  var option = data[i];
			  select[0].options.add( new Option(option.text, option.value, option.selected,option.selected) );
			}
		}
	}
	$('select[name="district_id"]').on('change', function(){
		var a = $(this).val();
		var select = $('select[name="desa_id"]');
		console.log(villages[a]);
		if(villages[a] === undefined){
			var tmp = [{'text':'None','value':'0','selected':'true'}];
		}else{
			var option = villages[a];
			var tmp = [{'text':'None','value':'0','selected':'true'}];
			for(var i =0; i< option.length;i++){
				tmp[i+1] = [];
				
				tmp[i+1].text = option[i].name;
				tmp[i+1].value = option[i].id;
			}
		}
		// set_desa();
		set_option(select, tmp);
	});
})