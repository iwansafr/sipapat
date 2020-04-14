<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new zea();

$desa_id = $this->sipapat_model->get_desa_id();

if(is_kecamatan() && !empty($_GET['desa']) || (is_root() || is_admin() ))
{
	$desa_id = intval($_GET['desa']);
}
if(!empty($desa_id))
{
	$get = [];
	if(!empty($_GET))
	{
		$get = $_GET;
	}
	$tgl = !empty($_GET['tgl']) ? $_GET['tgl'] : '';
	$perangkat_desa_id = !empty($_GET['perangkat_desa_id']) ? $_GET['perangkat_desa_id'] : '';
	$status = !empty($_GET['status']) ? $_GET['status'] : '';
	$where = !empty($tgl) ? " AND CAST(created AS DATE) = '".$tgl."'" : '';
	$where .= !empty($perangkat_desa_id) ? ' AND perangkat_desa_id = '.$perangkat_desa_id : '';
	$where .= !empty($status) ? ' AND status = '.$status : '';

	$form->init('roll');
	$form->setTable('absensi');
	$form->setWhere('desa_id = '.$desa_id.' '.$where);

	$form->addInput('id','plaintext');
	$form->setLabel('id','action');
	$form->setPlainText('id',
		[
			base_url('admin/absensi/detail/{perangkat_desa_id}')=>'Detail',
			base_url('admin/absensi/not_valid/{id}')=>'Tidak Valid'
		]
	);

	$form->setNumbering(true);
	$form->addInput('perangkat_desa_id','dropdown');
	$form->setLabel('perangkat_desa_id','Nama Perangkat');
	$form->tableOptions('perangkat_desa_id','perangkat_desa','id','nama','desa_id = '.$desa_id.' AND kelompok = 1');
	$form->setAttribute('perangkat_desa_id','disabled');
	$form->addInput('foto','thumbnail');

	$form->addInput('status','dropdown');
	$form->setOptions('status',$this->absensi_model->status());
	if(!is_root())
	{
		$form->setAttribute('status','disabled');
	}

	$form->addInput('created','plaintext');
	$form->setLabel('created','waktu');

	$form->addInput('koordinat','plaintext');

	$form->setUrl('admin/absensi/clear_list');

	$form->addInput('valid','checkbox');

	// $form->setEdit(true);
	$form->setDelete(true);
	?>
	<div class="row">
		<div class="col-md-3">
			<form action="" method="get">
				<div class="panel panel-default">
					<div class="panel-heading">
						<label>tanggal</label>
					</div>
					<div class="panel-body">
						<div class="form-group form-inline">
							<?php foreach ($get as $key => $value): ?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
							<?php endforeach ?>
							<input type="date" class="form-control" name="tgl" placeholder="tanggal" value="<?php echo !empty($tgl) ? $tgl : ''; ?>">
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-default">Filter</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-3">
			<form action="" method="get">
				<div class="panel panel-default">
					<div class="panel-heading">
						<label>Perangkat</label>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<?php foreach ($get as $key => $value): ?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
							<?php endforeach ?>
							<select class="form-control" name="perangkat_desa_id">
								<?php if (!empty($form->options['perangkat_desa_id'])): ?>
									<?php foreach ($form->options['perangkat_desa_id'] as $key => $value): ?>
										<?php
										$selected = !empty($perangkat_desa_id) && $perangkat_desa_id == $key ? 'selected' : ''; 
										?>
										<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-default">Filter</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-3">
			<form action="" method="get">
				<div class="panel panel-default">
					<div class="panel-heading">
						<label>Pagi/Siang</label>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<?php foreach ($get as $key => $value): ?>
								<input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
							<?php endforeach ?>
							<select class="form-control" name="status">
								<option value="1" <?php echo !empty($status) && $status == 1 ? 'selected' : '';?> >Pagi</option>
								<option value="2" <?php echo !empty($status) && $status == 2 ? 'selected' : '';?> >Sore</option>
								<option value="3" <?php echo !empty($status) && $status == 3 ? 'selected' : '';?> >Izin</option>
								<option value="3" <?php echo !empty($status) && $status == 4 ? 'selected' : '';?> >Terlambat</option>
							</select>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-default">Filter</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php

	$foto = new zea();
	$foto->setHeading('Foto Pertama');
	$foto->init('roll');
	$foto->setNumbering(true);
	$foto->setTable('absensi');
	$foto->setWhere('desa_id = '.$desa_id);
	$foto->group_by('perangkat_desa_id');
	$foto->order_by('id','ASC');
	$foto->addInput('id','hidden');
	$foto->addInput('perangkat_desa_id','dropdown');
	$foto->setLabel('perangkat_desa_id','Nama Perangkat');
	$foto->tableOptions('perangkat_desa_id','perangkat_desa','id','nama','desa_id = '.$desa_id.' AND kelompok = 1');
	$foto->setAttribute('perangkat_desa_id','disabled');
	$foto->addInput('foto','thumbnail');

	$foto->setUrl('admin/absensi/clear_list');
	$foto->form();

	$form->form();
}else{
	msg('desa tidak diketahui','danger');
}