$(document).ready(function(){
	var provinces;
	var regencies;
	var districts;
	var villages;
	var config_kab;
	var desa;

	function set_option(select,data)
	{
		while (select[0].options.length) {
    	select[0].remove(0);
    }
		var selectbox = select[0].options;
		for(var i = 0, l = data.length; i < l; i++){
		  var option = data[i];
		  select[0].options.add( new Option(option.text, option.value, option.selected,option.selected) );
		}
	}
	
	$.ajax({
		type:'post',
		url: _URL+'admin/sipapatconfig/config_kab',
		success:function(result){
			config_kab = result;
		}
	});
	$.ajax({
		type:'post',
		url: _URL+'api/desa/detail/'+_ID,
		success:function(result){
			desa = result;
		}
	});


	$('select[name="province_id"]').on('change', function(){
		var a = $(this).val();
		$('select[name="province_id"] option:selected').each(function(){
			var b = $(this).text();
			$('input[name="provinsi"').val(b);
		});
		var select = $('select[name="regency_id"]');
		if(regencies[a] == undefined){
			var tmp = [{'text':'None','value':'0','selected':'true'}];
		}else{
			var option = regencies[a];
			var tmp = [{'text':'None','value':'0','selected':'true'}];
			for(var i =0; i< option.length;i++){
				tmp[i+1] = [];
				tmp[i+1].text = option[i].name;
				tmp[i+1].value = option[i].id;
			}
		}
		set_option(select, tmp);
	});
	$('select[name="regency_id"]').on('change', function(){
		var a = $(this).val();
		$('select[name="regency_id"] option:selected').each(function(){
			var b = $(this).text();
			$('input[name="kabupaten"').val(b);
		});
		var select = $('select[name="district_id"]');
		if(districts[a] == undefined){
			var tmp = [{'text':'None','value':'0','selected':'true'}];
		}else{
			var option = districts[a];
			var tmp = [{'text':'None','value':'0','selected':'true'}];
			for(var i =0; i< option.length;i++){
				tmp[i+1] = [];
				tmp[i+1].text = option[i].name;
				tmp[i+1].value = option[i].id;
			}
		}
		set_option(select, tmp);
	});

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

	function set_kabupaten()
	{
		$.ajax({
			type: 'post',
			url: _URL+'admin/regencies/all',
			success:function(result){
				var a = config_kab.province_id;
				var select = $('select[name="regency_id"]');
				if(regencies[a] == undefined){
					var tmp = [{'text':'None','value':'0','selected':'true'}];
				}else{
					var option = regencies[a];
					var tmp = [{'text':'None','value':'0','selected':'true'}];
					for(var i =0; i< option.length;i++){
						tmp[i+1] = [];
						if(option[i].id==config_kab.regency_id){
							tmp[i+1].selected =true;
							set_kecamatan();
						}
						tmp[i+1].text = option[i].name;
						tmp[i+1].value = option[i].id;
					}
				}
				set_option(select, tmp);
			}
		});
	}
	function set_kecamatan()
	{
	  $.ajax({
			type:'post',
			data: {id:_ID},
	    url: _URL+'admin/districts/all',
	    success:function(result){
	    	var a = $('select[name="regency_id"]').val();
				var select = $('select[name="district_id"]');
				if(districts[a] == undefined){
					var tmp = [{'text':'None','value':'0','selected':'true'}];
				}else{
					var option = districts[a];
					var tmp = [{'text':'None','value':'0','selected':'true'}];
					for(var i =0; i< option.length;i++){
						tmp[i+1] = [];
						if(option[i].id==desa.district_id){
							tmp[i+1].selected =true;
							set_desa();
						}
						tmp[i+1].text = option[i].name;
						tmp[i+1].value = option[i].id;
					}
				}
				set_option(select, tmp);
	    }
	  });		
	}
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

	$.ajax({
		type:'post',
		data: {id:_ID},
    url: _URL+'admin/provinces/all',
    success:function(result){
    	if(result)
    	{
    		provinces = result;
    		var select = $('select[name="province_id"]');
				var option = provinces;
				var tmp = [{'text':'None','value':'0'}];
				for(var i =0; i< option.length;i++){
					tmp[i+1] = [];
					if(option[i].id==config_kab.province_id){
						tmp[i+1].selected =true;
						set_kabupaten();
					}
					tmp[i+1].text = option[i].name;
					tmp[i+1].value = option[i].id;
				}
				set_option(select, tmp);
    	}
    }
  });

	$.ajax({
		type:'post',
		data: {id:_ID},
    url: _URL+'admin/regencies/all',
    success:function(result){
    	if(result)
    	{
    		regencies = result;
    	}
    }
  });

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
});