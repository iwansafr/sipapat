$(document).ready(function(){
	var data = [];
	let submit = () =>{
    $('#upload_dilan').submit(function(e){
      e.preventDefault();
      $('#loading').addClass('hidden');
      // $('#dilan_load').removeClass('hidden');
      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      $('#upload_loading').html('checking data ...');
      $('#load_bar').removeClass('hidden');
      var id = setInterval(frame,100);
      function frame(){
      	$('#upload_loading').append('.');
      }
      $.ajax({
	      url:_URL+'admin/dilan/upload_process',
	      type:'post',
	      data:formData,
	      processData: false,
	      contentType: false,
	      success:function(re){
	      	console.log(re.status);
	        if(re.status == 'danger'){
	        	var msg = `<div class="alert alert-${re.status}">${re.msg}</div>`
	        	$('#upload_loading').html(msg);
      			$('#load_bar').addClass('hidden');
      			clearInterval(id);
	        }else if(re.status =='warning'){
	        	var msg = `<div class="alert alert-${re.status}">${re.msg}</div> apakah anda ingin melanjutkan upload data penduduk tanpa penduduk tsb ? <br> <a href="" class="btn btn-sm btn-warning">Upload Ulang File</a> <button class="btn btn-sm btn-success" id="force_upload">Lanjutkan</button><br>`;
	        	$('#upload_loading').html(msg);
      			$('#load_bar').addClass('hidden');
      			// console.log(re.check_exist);
      			var data_duplicate = '<table class="table">';
      			for(var i =0;i<=re.check_exist.length-1; i++){
      				// $('#data_duplicate').append(`<tr><td>${i+1}</td><td>${re.check_exist[i]}</td></tr>`);
      				data_duplicate += `<tr><td>${i+1}</td><td>${re.check_exist[i]}</td></tr>`;
      				if(i == re.check_exist.length-1){
      					// $('#data_duplicate').append('</table>');
      				}
      			}
      			data_duplicate += '</table>';
      			$('#data_duplicate').html(data_duplicate);
      			data = re.data;
            console.log(data);
      			clearInterval(id);
	        }else if(re.status == 'success'){
	        	var msg = `<div class="alert alert-${re.status}">${re.msg}</div> apakah anda ingin melanjutkan upload data penduduk tanpa penduduk tsb ? <br><button class="btn btn-sm btn-success" id="force_upload">Lanjutkan</button><br>`;
	        	$('#upload_loading').html(msg);
      			$('#load_bar').addClass('hidden');
      			data = re.data;
      			clearInterval(id);
	        }
	      }
	    });
    });
  }
  submit();
  $(document).on('click','#force_upload',function(){
  	$('#upload_loading').html('Uploading data ...');
    $('#load_bar').removeClass('hidden');
    var id = setInterval(frame,100);
    function frame(){
    	$('#upload_loading').append('.');
    }
    var data_part = [];
    var data_send = [];
    var i = 0;
    var k = 1;
    for(j in data){
    	data_part.push(data[j]);
    	i++;
    	if(i==50){
    		data_send[k] = [];
    		data_send[k] = data_part;
    		// insert_penduduk(_URL, data_part);
    		data_part = [];
    		k++;
    		i= 0;
    	}
    }
    data_send[k] = data_part;
    for(j in data_send){
    	// console.log(data_send[j]);
    	insert_penduduk(_URL, data_send[j]);
    }
    // console.log(data_send);
    // console.log('last => '+data_part);
    insert_penduduk(_URL, data_part);
    clearInterval(id);
  });
  function insert_penduduk(_URL, data_part){
  	$.ajax({
			url: _URL+'admin/dilan/insert_penduduk',
			type: 'post',
			data: {data:data_part},
			success: function(re){
				var msg = `<div class="alert alert-${re.status}">${re.msg}</div>`
	  		$('#upload_loading').append(msg);
			}
		});
  }
});

