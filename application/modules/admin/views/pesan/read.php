<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Detail Pesan</h3>

    <div class="box-tools pull-right">
      <?php if (!empty($detail_pesan['prev'])): ?>
        <a href="<?php echo $detail_pesan['prev'] ?>" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
      <?php endif ?>
      <?php if (!empty($detail_pesan['next'])): ?>
        <a href="<?php echo $detail_pesan['next'] ?>" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
      <?php endif ?>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="mailbox-read-info">
      <h3><?php echo $detail_pesan['pesan']['title'] ?></h3>
      <h5>
      	<?php if ($this->router->fetch_method() == 'keluar'): ?>
      		Untuk : <?php echo $detail_pesan['recipient'] ?>
      		<?php 
      		if($detail_pesan['pesan']['type']==1) 
      		{
      			foreach($detail_pesan['status'] AS $key =>$value)
      			{
      				if($value['status'] ==0)
      				{
      					echo ' (Belum di baca)';
      				}else{
      					echo ' (Sudah di baca)';
      				}
      			}
      		}
      		?>

      	<?php else: ?>
      		Dari : <?php echo $detail_pesan['sender'] ?>
      	<?php endif ?>
        <span class="mailbox-read-time pull-right"><?php echo $detail_pesan['pesan']['created'] ?></span></h5>
    </div>
    <div class="mailbox-read-message">
      <?php echo $detail_pesan['pesan']['pesan'] ?>
    </div>
  </div>
  <div class="box-footer">
  	<?php if (!empty($detail_pesan['pesan']['file'])): ?>
      <?php $file_path = FCPATH.'images/modules/pesan/'.$detail_pesan['pesan']['id'].'/'.$detail_pesan['pesan']['file'];?>
      <?php if (file_exists($file_path)): ?>
  	    <ul class="mailbox-attachments clearfix">
  	      <li>
  	        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
  	        <div class="mailbox-attachment-info">
  	          <a href="<?php echo image_module('pesan', $detail_pesan['pesan']['id'].'/'.$detail_pesan['pesan']['file']) ?>" class="mailbox-attachment-name download_file " no_load="no_load"><i class="fa fa-paperclip"></i> <?php echo str_replace('_',' ',$detail_pesan['pesan']['file']) ?></a>
  	              <span class="mailbox-attachment-size">
  	                <?php echo round(filesize($file_path)/1000, 1); ?> KB
    	               <a href="<?php echo $file_path ?>" class="btn btn-default btn-xs pull-right download_file " no_load="no_load"><i class="fa fa-cloud-download-alt"></i></a>
  	              </span>
  	        </div>
  	      </li>
  	    </ul>
      <?php else: ?>
        <?php msg('file rusak atau tidak ditemukan','danger') ?>
      <?php endif ?>
  	<?php endif ?>
  </div>
</div>
<?php if (!empty($detail_pesan['status']) && $detail_pesan['pesan']['type']==0): ?>
	<div class="col-md-6">
    <div class="box box-success collapsed-box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">sudah dibaca oleh</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
		  <div class="box-body">
        <?php foreach ($detail_pesan['status'] as $key => $value): ?>
        	<?php if ($value['status'] == 1): ?>
  		        <span class="badge bg-green"><?php echo $value['username'] ?></span>
        	<?php endif ?>
        <?php endforeach ?>
		  </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-warning collapsed-box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">belum dibaca oleh</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
		  <div class="box-body">
        <?php foreach ($detail_pesan['status'] as $key => $value): ?>
        	<?php if ($value['status'] == 0): ?>
  		        <span class="badge bg-red"><?php echo $value['username'] ?></span>
        	<?php endif ?>
        <?php endforeach ?>
		  </div>
    </div>
    <!-- /.box -->
  </div>
<?php endif ?>