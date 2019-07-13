$(document).ready(function(){
  let submit = () =>{
    $('#dilan_form').submit(function(e){
      e.preventDefault();
      $('#loading').addClass('hidden');
      $('#dilan_load').removeClass('hidden');
      var elem = document.getElementById("dilan_pro");
      var width = 1;
      var id = setInterval(frame,100);
      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      upload_file(formData);
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
    });
  }
  function upload_file(postdata){
    $.ajax({
      url:_URL+'admin/dilan/upload',
      type:'post',
      data:postdata,
      processData: false,
      contentType: false,
      success:function(re){
        console.log(re);
      }
    });
  }
  submit();
  let upload = () =>{
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
  }
});