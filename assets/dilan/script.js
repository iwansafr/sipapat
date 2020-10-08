$(document).ready(function(){
  let submit = () =>{
    $('#dilan_form').submit(function(e){
      e.preventDefault();
      $('#loading').addClass('hidden');
      $('#dilan_load').removeClass('hidden');
      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      upload_file(formData);
    });
  }
  let upload_file = (postdata) => {
    $.ajax({
      url:_URL+'admin/dilan/upload',
      type:'post',
      data:postdata,
      processData: false,
      contentType: false,
      success:function(re){
        console.log(re);
        if(re.status == 'success'){
          var elem = document.getElementById("dilan_pro");
          var width = 1;
          var id = setInterval(frame,100);
          $('#dilan_success_load').removeClass('hidden');
          upload(re.data);
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
        }else{
          console.log('data kosong');
        }
      }
    });
  }  
  submit();
  let upload = (postfile) =>{
    $.ajax({
      type:"post",
      data: {file:postfile},
      url: _URL+"admin/dilan/insert",
      // beforeSend: function(){
      //   var elem = document.getElementById("dilan_pro");
      //   var width = 1;
      //   var id = setInterval(frame,100);
      //   function frame(){
      //     if(width>=100){
      //       clearInterval(id);
      //     }else{
      //       width = width+1;
      //       elem.style.width = width + "%";
      //       var show = width;
      //       elem.innerHTML = show + " % menyiapkan data";
      //     }
      //   }
      // },
      success:function(result){
        console.log(result);
        if(result.status)
        {
          var elem = document.getElementById("dilan_success_pro");
          var width = 1;
          var id = setInterval(frame,100);
          function frame(){
            if(width>=100){
              clearInterval(id);
              console.log(result);
            }else{
              width = width+1;
              elem.style.width = width + "%";
              var show = width;
              elem.innerHTML = show + " % data berhasil di upload";
            }
          }
        }
      },
      error:function(error){
        console.log(error);
        var str = error.responseText;
        var res = str.substring(1094,1142);
        if(res == 'You have an error in your SQL syntax; check the ')
        {
          console.log('Format Excel tidak sesuai');
          res = 'Format Excel tidak sesuai';
          res = '<div class="alert alert-danger"><strong>danger !</strong> '+res+'</div>'
        }else{
          res = '<div class="alert alert-danger"><strong>danger !</strong> '+res+'</div>'
        }
        $('#error').html(res);

      }
    });
  }

  let modify = () =>{
    $('#dilan_form_edit').submit(function(e){
      e.preventDefault();
      $('#loading').addClass('hidden');
      $('#dilan_load').removeClass('hidden');
      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      upload_file_modify(formData);
    });
  }
  modify();
  let upload_file_modify = (postdata) => {
    $.ajax({
      url:_URL+'admin/dilan/upload_modify',
      type:'post',
      data:postdata,
      processData: false,
      contentType: false,
      success:function(re){
        if(re.status == 'success'){
          var elem = document.getElementById("dilan_pro");
          var width = 1;
          var id = setInterval(frame,100);
          $('#dilan_success_load').removeClass('hidden');
          upload_modify(re.data);
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
        }else{

        }
      }
    });
  }  

  let upload_modify = (postfile) =>{
    $.ajax({
      type:"post",
      data: {file:postfile},
      url: _URL+"admin/dilan/update",
      // beforeSend: function(){
      //   var elem = document.getElementById("dilan_pro");
      //   var width = 1;
      //   var id = setInterval(frame,100);
      //   function frame(){
      //     if(width>=100){
      //       clearInterval(id);
      //     }else{
      //       width = width+1;
      //       elem.style.width = width + "%";
      //       var show = width;
      //       elem.innerHTML = show + " % menyiapkan data";
      //     }
      //   }
      // },
      success:function(result){
        if(result.status)
        {
          var elem = document.getElementById("dilan_success_pro");
          var width = 1;
          var id = setInterval(frame,100);
          function frame(){
            if(width>=100){
              clearInterval(id);
              console.log(result);
            }else{
              width = width+1;
              elem.style.width = width + "%";
              var show = width;
              elem.innerHTML = show + " % data berhasil di upload";
            }
          }
        }
      },
      error:function(error){
        console.log(error);
        var str = error.responseText;
        var res = str.substring(1094,1142);
        if(res == 'You have an error in your SQL syntax; check the ')
        {
          console.log('Format Excel tidak sesuai');
          res = 'Format Excel tidak sesuai';
          res = '<div class="alert alert-danger"><strong>danger !</strong> '+res+'</div>'
        }else{
          res = '<div class="alert alert-danger"><strong>danger !</strong> '+res+'</div>'
        }
        $('#error').html(res);
      }
    });
  }

});