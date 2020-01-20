<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($id))
{
	$form = new zea();

	$form->init('edit');

	$form->setId(@intval($id));
	$form->setTable('dilan_surat_pengajuan');

	$data = $form->getData();

	$form->setEditStatus(false);
	$form->setHeading('pengajuan Suket');
	$form->addInput('penduduk_id','dropdown');
	$form->setLabel('penduduk_id','nama');
	$form->setAttribute('penduduk_id','disabled');
	$form->tableOptions('penduduk_id','penduduk','id','nama',' id = '.$data['penduduk_id']);

	$form->addInput('dilan_surat_ket_id','dropdown');
	$form->setLabel('dilan_surat_ket_id','keperluan');
	$form->setAttribute('dilan_surat_ket_id','disabled');
	$form->tableOptions('dilan_surat_ket_id','dilan_surat_ket','id','title',' id = '.$data['dilan_surat_ket_id']);

	$form->addInput('keterangan','plaintext');
	$form->addInput('email','plaintext');
	$form->addInput('hp','plaintext');

	$form->setSave(false);

	$form->form();
	if(!empty($data))
	{
		$detail = $this->dilan_model->get_penduduk($data['penduduk_id']);
	}
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			data diri
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<tr>
					<td>NIK</td>
					<td>: <?php echo $detail['nik'] ?></td>
				</tr>				
				<tr>
					<td>KK</td>
					<td>: <?php echo $detail['no_kk'] ?></td>
				</tr>				
				<tr>
					<td>Alamat</td>
					<td>: <?php echo $detail['alamat'] ?></td>
				</tr>				
				<tr>
					<td>RT</td>
					<td>: <?php echo $detail['no_rt'] ?></td>
				</tr>				
				<tr>
					<td>RW</td>
					<td>: <?php echo $detail['no_rw'] ?></td>
				</tr>				
			</table>
		</div>
		<div class="panel-footer">
			<a href="<?php echo base_url('admin/dilan/surat_pengantar_form/'.$data['penduduk_id'].'/'.$data['dilan_surat_ket_id']) ?>" class="btn btn-success"><i class="fa fa-floppy-o"></i> Buat Surat</a>
		</div>
	</div>
	<?php
}else{
	msg('data tidak valid','danger');
}