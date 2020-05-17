<script src="<?php echo base_url('templates/bare') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('templates/bare') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('templates/AdminLTE'); ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url('templates/AdminLTE'); ?>/assets/dist/js/script.js"></script>
<script src="<?php echo base_url('templates/AdminLTE'); ?>/assets/summernote/summernote.js"></script>
<script src="<?php echo base_url('templates/AdminLTE'); ?>/assets/jquery/jquery.doubleScroll.js"></script>

<script>
	$('.select2').select2();
</script>
<?php
$this->esg->extra_js();
$this->esg->script();