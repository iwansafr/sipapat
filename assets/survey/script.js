$(document).ready(function(){
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
		if(a==1){
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