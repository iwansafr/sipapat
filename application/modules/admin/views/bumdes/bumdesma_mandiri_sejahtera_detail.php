<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="card panel panel-default card-default">
	<div class="panel-heading card-header">
		detail bumdesma | 
		<a href="<?php echo base_url('admin/bumdes/bumdesma_pdf/'.@intval($_GET['id']).'/detail_bumdesma') ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-file-pdf-o"></i> PDF | <i class="fa fa-print"></i> Cetak</a>
	</div>
	<div class="panel-body card-body">
		<table class="table table-responsive">
			<tr>
				<td style="width:30%;">nama desa</td>
				<td>: <?php echo $this->sipapat_model->get_desa($data['desa_id'])['nama'] ?></td>
			</tr>
			<tr>
				<td style="width: 30%;">modal</td>
				<td>: <?php echo money($data['modal']) ?></td>
			</tr>
			<tr>
				<td style="width: 30%;">sumber dana</td>
				<td>: <?php echo $this->pembangunan_model->sumber_dana()[$data['sumber_dana']]; ?></td>
			</tr>
			<tr>
				<td style="width: 30%;">tahun anggaran</td>
				<td>: <?php echo $data['th_anggaran'] ?></td>
			</tr>
			<tr>
				<td>termin</td>
				<td>: <?php echo $this->bumdes_model->termin()[$data['termin']] ?></td>
			</tr>
		</table>
	</div>
	<div class="panel-footer card-footer">
		
	</div>
</div>