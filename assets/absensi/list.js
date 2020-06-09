$(document).ready(function(){
	$('#data_list').find('thead').find('tr').prepend('<th>foto</th>');
	$('#data_awal').find('tbody').find('tr').find('td').each(function(){
		// var id = $(this).data('id');
		var id = $(this).attr('perangkat_desa_id');
		if(id > 0 ){
			var img = $('#data_awal').find('td[perangkat_desa_id="'+id+'"]').closest('tr').find('img').closest('td').html();
			var d = $('#data_list').find('td[perangkat_desa_id="'+id+'"]').closest('tr').prepend(img);
		}
	});
	function remove_pertama(){
		// $('#data_awal').remove();
		// clearInterval(rm_msg);
	}
	// var rm_msg = setInterval(remove_pertama,1000);
});