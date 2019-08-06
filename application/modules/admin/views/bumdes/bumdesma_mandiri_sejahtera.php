<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
	?>
	<div class="row">
		<div class="col-md-4">
			<?php $this->load->view('bumdesma_edit') ?>
		</div>
		<div class="col-md-8">
			<?php $this->load->view('bumdesma_list') ?>
		</div>
	</div>
	<?php
}else{
	$this->load->view('bumdesma_list');
}