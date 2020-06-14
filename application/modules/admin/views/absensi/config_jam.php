<?php defined('BASEPATH') OR exit('No direct script access allowed');
$day = !empty($_GET['day']) ? intval($_GET['day']) : 0;
$cur_options = $this->absensi_model->hari();
?>
<button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#modal-day">
 <i class="fa fa-cog"></i> HARIs
</button>
<a class="btn btn-warning pull-right btn-sm" href="<?php echo base_url('admin/absensi/config_jam/'.@$desa['id']) ?>">
 <i class="fa fa-undo"></i> Reset
</a>
<div class="modal fade" id="modal-day">
  <div class="modal-dialog">
    <form action="" method="get">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title">Pilih Hari</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="form-group">
	        		<label>Hari</label>
		        	<?php
		        	$input_array = array(
								'name'     => 'day',
								'class'    => 'form-control',
								'options'  => $cur_options,
								'selected' => $day,
							);
							echo form_dropdown($input_array);
							?>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Send</button>
	      </div>
	    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php

if(is_kecamatan() || is_root())
{
	pr($day);
	if(!empty($day))
	{
		pr($cur_options[$day]);
	}
	// pr(date('l'));
	$form = new zea();
	$form->init('param');
	if(!empty($user['pengguna']['district_id']))
	{
		$paramname = base_url().'_'.$user['pengguna']['district_id'].'_absensi_config_jam';
		if(!empty($desa['id']))
		{
			$paramname = base_url().'_'.$user['pengguna']['district_id'].'_'.$desa['id'].'_absensi_config_jam';
			$form->setHeading('desa '.$desa['nama']);
		}
		$form->setParamName($paramname);
	}else{
		$paramname = base_url().'_absensi_config_jam';
		$form->setParamName($paramname);
	}
	$form->setTable('config');
	if(!empty($day))
	{
		$form->setHeading('Config jadwal '.$cur_options[$day]);
		$paramname = $paramname.'_'.$day;
		$form->setParamName($paramname);
	}
	
	$form->addInput('mulai_masuk','text');
	$form->setType('mulai_masuk','time');

	$form->addInput('selesai_masuk','text');
	$form->setType('selesai_masuk','time');

	$form->addInput('mulai_pulang','text');
	$form->setType('mulai_pulang','time');

	$form->addInput('selesai_pulang','text');
	$form->setType('selesai_pulang','time');
	$form->form();
}