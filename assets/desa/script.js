$(document).ready(function(){
	var districts;
	var villages;
	var config_kab;
	var desa;


  $.ajax({
		type:'post',
		data: {id:_ID},
    url: _URL+'admin/districts/all',
    success:function(result){
    	if(result)
    	{
    		districts = result;
    	}
    }
  });
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
	$.ajax({
		type:'post',
		url: _URL+'admin/sipapatconfig/config_kab',
		success:function(result){
			config_kab = result;
			start_desa();
		}
	});
	$.ajax({
		type:'post',
		url: _URL+'api/desa/detail/'+_ID,
		success:function(result){
			desa = result;
		}
	});

	function set_option(select,data)
	{
		if(select[0]!= undefined){
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
		$('select[name="district_id"] option:selected').each(function(){
			var b = $(this).text();
			$('input[name="kecamatan"').val(b);
		});
		var select = $('select[name="village_id"]');
		if(villages[a] == undefined){
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
		set_desa();
		set_option(select, tmp);
	});
	$('select[name="village_id"]').on('change', function(){
		var a = $(this).val();
		console.log(a);
		$('select[name="village_id"] option:selected').each(function(){
			var b = $(this).text();
			$('input[name="nama"').val(b);
		});
	});

	function set_desa()
	{
	  $.ajax({
			type:'post',
			data: {id:_ID},
	    url: _URL+'admin/villages/all',
	    success:function(result){
	    	var a = $('select[name="district_id"]').val();
				var select = $('select[name="village_id"]');
				if(villages[a] == undefined){
					var tmp = [{'text':'None','value':'0','selected':'true'}];
				}else{
					var option = villages[a];
					var tmp = [{'text':'None','value':'0','selected':'true'}];
					for(var i =0; i< option.length;i++){
						tmp[i+1] = [];
						if(option[i].id==desa.village_id){
							tmp[i+1].selected =true;
						}
						tmp[i+1].text = option[i].name;
						tmp[i+1].value = option[i].id;
					}
				}
				set_option(select, tmp);
	    }
	  });		
	}

  function start_desa(){
  	var id = setInterval(load, 20);
		var width = 0;
		var link = _URL+'admin/villages/all';
		if(config_kab.regency_id != undefined){
			link = _URL+'admin/villages/by_regency_id/'+config_kab.regency_id;
		}
    function load(){
		  $.ajax({
				type:'post',
				data: {id:_ID},
		    url: link,
		    success:function(result){
		    	var a = $('select[name="district_id"]').val();
					var select = $('select[name="village_id"]');
					if(villages[a] === undefined){
						var tmp = [{'text':'None','value':'0','selected':'true'}];
						width = 1;
					}else{
						var option = villages[a];
						var tmp = [{'text':'None','value':'0','selected':'true'}];
						for(var i =0; i< option.length;i++){
							tmp[i+1] = [];
							if(option[i].id==desa.village_id){
								tmp[i+1].selected =true;
							}
							tmp[i+1].text = option[i].name;
							tmp[i+1].value = option[i].id;
							width = 0;
						}
						width = 1;
					}
					set_option(select, tmp);
		    }
		  });
		  if(width==0){
		  	$('#loading').removeClass('hidden')
		  }else{
		  	$('#loading').addClass('hidden')
		  	clearInterval(id);		
		  }
    }
  }
});