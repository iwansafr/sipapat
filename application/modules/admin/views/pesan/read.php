<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Detail Pesan</h3>

    <div class="box-tools pull-right">
      <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
      <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="mailbox-read-info">
      <h3><?php echo $detail_pesan['pesan']['title'] ?></h3>
      <h5>
      	<?php if ($this->router->fetch_method() == 'keluar'): ?>
      		To : 
      		<?php 
      		if($detail_pesan['pesan']['recipient']==0) 
      		{
      			echo 'SEMUA USER';
      		}else{
      			echo $detail_pesan['recipient'];
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
      		From : <?php echo $detail_pesan['sender'] ?>
      	<?php endif ?>
        <span class="mailbox-read-time pull-right"><?php echo $detail_pesan['pesan']['created'] ?></span></h5>
    </div>
    <div class="mailbox-read-message">
      <?php echo $detail_pesan['pesan']['pesan'] ?>
    </div>
  </div>
  <div class="box-footer">
  	<?php if (!empty($detail_pesan['pesan']['file'])): ?>
	    <ul class="mailbox-attachments clearfix">
	      <li>
	        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
	        <div class="mailbox-attachment-info">
	          <a target="_blank" href="<?php echo image_module('pesan', $detail_pesan['pesan']['id'].'/'.$detail_pesan['pesan']['file']) ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $detail_pesan['pesan']['file'] ?></a>
	              <span class="mailbox-attachment-size">
	                <?php echo round(filesize(FCPATH.'images/modules/pesan/'.$detail_pesan['pesan']['id'].'/'.$detail_pesan['pesan']['file'])/1000, 1); ?> KB
	                <a target="_blank" href="<?php echo image_module('pesan', $detail_pesan['pesan']['id'].'/'.$detail_pesan['pesan']['file']) ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download-alt"></i></a>
	              </span>
	        </div>
	      </li>
	    </ul>
  	<?php endif ?>
  </div>
</div>
<?php if (!empty($detail_pesan['status']) && $detail_pesan['pesan']['recipient']==0): ?>
	<div class="col-md-3">
    <div class="box box-success collapsed-box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">sudah dibaca oleh</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <?php foreach ($detail_pesan['status'] as $key => $value): ?>
      	<?php if ($value['status'] == 1): ?>
		      <div class="box-body">
		        <?php echo $value['username'] ?>
		      </div>
      	<?php endif ?>
      <?php endforeach ?>
    </div>
  </div>
  <div class="col-md-3">
    <div class="box box-warning collapsed-box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">belum dibaca oleh</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <?php foreach ($detail_pesan['status'] as $key => $value): ?>
      	<?php if ($value['status'] == 0): ?>
		      <div class="box-body">
		        <?php echo $value['username'] ?>
		      </div>
      	<?php endif ?>
      <?php endforeach ?>
    </div>
    <!-- /.box -->
  </div>
<?php endif ?>