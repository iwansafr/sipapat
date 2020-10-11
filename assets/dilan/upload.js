$(document).ready(function(){
	let submit = () =>{
    $('#upload_dilan').submit(function(e){
      e.preventDefault();
      $('#loading').addClass('hidden');
      // $('#dilan_load').removeClass('hidden');
      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      $('#upload_loading').html('checking data ...');
      $.ajax({
	      url:_URL+'admin/dilan/upload_process',
	      type:'post',
	      data:formData,
	      processData: false,
	      contentType: false,
	      success:function(re){
	        console.log(re);
	      }
	    });
    });
  }
  submit();
});