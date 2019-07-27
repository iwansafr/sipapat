$(document).ready(function(){
  let desa = () =>{
    $.get(_URL+'api/desa?field=id-nama',function(data){
      var desa_id = document.getElementById('current_desa_id').getAttribute('data-id');
      var option = data;
      var tmp = [{'text':'None','value':'0'}];
      for(var i =0; i< option.length;i++){
        tmp[i+1] = [];
        tmp[i+1].text = option[i].nama;
        tmp[i+1].value = option[i].id;
        if(option[i].id == desa_id){
          tmp[i+1].selected = true;
        }
      }
      set_option($('select[name="desa_id"]'),tmp);
    });
  }
  let set_option = (select,data) =>{
    while (select[0].options.length) {
      select[0].remove(0);
    }
    var selectbox = select[0].options;
    for(var i = 0, l = data.length; i < l; i++){
      var option = data[i];
      select[0].options.add( new Option(option.text, option.value, option.selected,option.selected) );
    }
  }
  desa();
});