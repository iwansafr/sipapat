<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
  <div class="col-md-3">
    <?php $this->load->view('pesan/folder') ?>
  </div>
  <div class="col-md-9">
		<?php
		if(!empty($id))
		{
			if(!empty($detail_pesan))
			{
				$this->load->view('pesan/read');
			}
		}?>
  </div>
</div>
