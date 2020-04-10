$(document).ready(function(){
	var districts;
	var config_kab;

	$.ajax({
		type:'post',
		url: _URL+'admin/sipapatconfig/config_kab',
		success:function(result){
			config_kab = result;
			if(config_kab.regency_id > 0){
				set_kecamatan(config_kab.regency_id);
			}
			// start_desa();
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
  function set_kecamatan(regency_id){
		var link = _URL+'api/kecamatan/by_regency_id/'+regency_id;
	  $.ajax({
			type:'post',
	    url: link,
	    success:function(result){
	    	var option = result.data;
				var tmp = [{'text':'Pilih Kecamatan','value':'0','selected':'true'}];
				for(var i =0; i< option.length;i++){
					tmp[i+1] = [];
					
					tmp[i+1].text = option[i].name;
					tmp[i+1].value = option[i].id;
				}
	    	set_option($('select[name="district_id"]'),tmp);
	    }
	  });
  }
});