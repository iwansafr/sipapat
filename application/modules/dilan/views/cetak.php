<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);

?>
<style>
	body{
		background-image: url(<?php echo image_module('config',$paramname.'/'.$dilan_config['image_light'])?>);
		background-size: cover;
		/*color: white;*/
	}
	html {
	  scroll-behavior: smooth;
	}

</style>
<div class="container-fluid mt-5">
	<div class="container">
		<div class="card bg-dark text-white" id="start_section">
			<div class="card card-header">
				<h6 class="panel-title text-primary">
					Cetak Surat Pengantar
					<a href="#end_section" class="btn btn-secondary pull-right"><i class="fa fa-arrow-down"></i></a>
				</h6>
			</div>
			<div class="card-body" style="min-height: 1000px;">
				<iframe src="<?php echo base_url('admin/dilan/surat_pengantar/'.$id.'/surat pengantar') ?>" style="width: 100%;min-height: 1000px;"></iframe>
			</div>
			<div class="card-footer">
				surat tidak tampil ? <button onclick="klikSurat()" class="btn btn-sm btn-secondary">Klik di sini</button>
			</div>
		</div>
		<div id="end_section"></div>
	</div>
</div>
<script>
function klikSurat() {
  window.open("<?php echo base_url('admin/dilan/surat_pengantar/'.$id.'/surat pengantar') ?>");
}
</script>