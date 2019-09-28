<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($data['keterangan']) && !empty($id))
{
	{
		foreach ($data['keterangan'] as $key => $value) 
		{
			?>
			<div class="col-md-3">
				<a href="<?php echo base_url('admin/dilan/surat_pengantar_form/'.$id.'/'.$value['id']) ?>" class="small-box" style="background:  #363b71; color:white;">
					<div class="small-box" style="background:  #363b71; color:white;">
					  <div class="inner">
					    <h3>form</h3>

					    <p><?php echo $value['title'] ?></p>
					  </div>
					  <div class="icon">
					    <i class="fa fa-list"></i>
					  </div>
					  <a href="<?php echo base_url('admin/dilan/surat_pengantar_form/'.$id.'/'.$value['id']) ?>" class="small-box-footer">Buat <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</a>
			</div>
			<?php
		}
	}
}