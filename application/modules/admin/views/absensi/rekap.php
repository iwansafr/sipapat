<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->library('table');
// header("Content-type: application/vnd-ms-excel");
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header("Content-Disposition: attachment; filename=Data Perangkat.xls");


$template = array(
        'table_open'            => '<table border="1" class="esg_data_table table table-bordered table-hover table-striped" cellpadding="4" cellspacing="2">',

        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',

        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',

        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',

        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',

        'table_close'           => '</table>'
);

$this->table->set_template($template);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<form action="<?php echo base_url('admin/absensi/rekap/'.$id) ?>" method="get">
				<div class="col-sm-3">
					<label>Tahun</label><input class="form-control" type="number" name="th" value="<?php echo @$year ?>" required>
				</div>
				<div class="col-sm-3">
					<label>Bulan</label>
					<select class="form-control" required name="bl">
						<?php foreach ($bulan as $key => $value): ?>
							<?php $selected = $key == @$month ? 'selected' : ''; ?>
							<option <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $value ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-3">
					<label>Filter</label><br>
					<button class="btn btn-info btn-sm"><i class="fa fa-chart-bar"></i></button>
				</div>
			</form>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?php
			echo $this->table->generate($data);
			?>
		</div>
	</div>
	<div class="panel-footer">
		
	</div>
</div>