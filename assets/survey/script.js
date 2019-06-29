$(document).ready(function(){
	var a = $('select[name="laptop"]').val();
	var ang = $('select[name="anggaran"]');
	var sur = $('select[name="surat"]');
	if(a==1){
		ang.attr('disabled','disabled');
		ang.closest('.form-group').addClass('hidden');
		sur.attr('disabled','disabled');
		sur.closest('.form-group').addClass('hidden');
	}else{
		ang.removeAttr('disabled','disabled');
		ang.closest('.form-group').removeClass('hidden');
		sur.removeAttr('disabled','disabled');
		sur.closest('.form-group').removeClass('hidden');
	}
	var wifi = $('select[name="wifi"]').val();
	var wifib = $('select[name="letak_jaringan"]');
	var wific = $('select[name="sumber_biaya"]');
	if(wifi==0){
		wifib.attr('disabled','disabled');
		wifib.closest('.form-group').addClass('hidden');
		wific.attr('disabled','disabled');
		wific.closest('.form-group').addClass('hidden');
	}else{
		wifib.removeAttr('disabled','disabled');
		wifib.closest('.form-group').removeClass('hidden');
		wific.removeAttr('disabled','disabled');
		wific.closest('.form-group').removeClass('hidden');
	}
	var skema = $('select[name="honor"]').val();
	var skemab = $('select[name="skema"]');
	if(skema==1){
		skemab.attr('disabled','disabled');
		skemab.closest('.form-group').addClass('hidden');
	}else{
		skemab.removeAttr('disabled','disabled');
		skemab.closest('.form-group').removeClass('hidden');
	}
	$('select[name="laptop"]').on('change',function(){
		var a = $(this).val();
		var ang = $('select[name="anggaran"]');
		var sur = $('select[name="surat"]');
		if(a==1){
			ang.attr('disabled','disabled');
			ang.closest('.form-group').addClass('hidden');
			sur.attr('disabled','disabled');
			sur.closest('.form-group').addClass('hidden');
		}else{
			ang.removeAttr('disabled','disabled');
			ang.closest('.form-group').removeClass('hidden');
			sur.removeAttr('disabled','disabled');
			sur.closest('.form-group').removeClass('hidden');
		}
	});
	$('select[name="wifi"]').on('change',function(){
		var a = $(this).val();
		var b = $('select[name="letak_jaringan"]');
		var c = $('select[name="sumber_biaya"]');
		if(a==0){
			b.attr('disabled','disabled');
			b.closest('.form-group').addClass('hidden');
			c.attr('disabled','disabled');
			c.closest('.form-group').addClass('hidden');
		}else{
			b.removeAttr('disabled','disabled');
			b.closest('.form-group').removeClass('hidden');
			c.removeAttr('disabled','disabled');
			c.closest('.form-group').removeClass('hidden');
		}
	});
	$('select[name="honor"]').on('change',function(){
		var a = $(this).val();
		var b = $('select[name="skema"]');
		if(a==1){
			b.attr('disabled','disabled');
			b.closest('.form-group').addClass('hidden');
		}else{
			b.removeAttr('disabled','disabled');
			b.closest('.form-group').removeClass('hidden');
		}
	});
});