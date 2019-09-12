<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
	<div class="panel panel-heading card card-header">
		detail data diri
	</div>
	<div class="panel-body card-body">
		<table class="table table-responsive">
			<tr>
				<td>NAMA</td>
				<td>: <?php echo $penduduk['nama'] ?></td>
			</tr>
			<tr>
				<td>JK</td>
				<td>: <?php echo $penduduk['jk'] ?></td>
			</tr>
			<tr>
				<td>TTL</td>
				<td>: <?php echo $penduduk['tmpt_lhr'].', '.content_date($penduduk['tgl_lhr']) ?></td>
			</tr>
			<tr>
				<td>PEKERJAAN</td>
				<td>: <?php echo $penduduk['pekerjaan'] ?></td>
			</tr>
			<tr>
				<td>TEMPAT TINGGAL</td>
				<td>: <?php echo $desa['nama'] ?></td>
			</tr>
			<tr>
				<td>KABUPATEN</td>
				<td>: <?php echo $desa['kabupaten'] ?></td>
			</tr>
			<tr>
				<td>PROVINSI</td>
				<td>: <?php echo $desa['provinsi'] ?></td>
			</tr>
			<tr>
				<td>SURAT BUKTI</td>
				<td>: KTP <?php echo $penduduk['nik'] ?> KK <?php echo $penduduk['no_kk'] ?></td>
			</tr>
		</table>
	</div>
	<div class="panel-footer card-footer">
		
	</div>
</div>
<?php

$this->zea->setHeading('Surat Keterangan/Pengantar');
$this->zea->setEditStatus(false);
$this->zea->init('edit');
$this->zea->setTable('dilan_surat');

$this->zea->addInput('keperluan','textarea');
$this->zea->addInput('penduduk_id','static');
$this->zea->setValue('penduduk_id',@intval($penduduk['id']));

$this->zea->addInput('desa_id','static');
$this->zea->setValue('desa_id', $desa['id']);

$this->zea->addInput('berlaku_mulai','static');
$this->zea->setValue('berlaku_mulai','0000-00-00');
$this->zea->addInput('berlaku_sampai','static');
$this->zea->setValue('berlaku_sampai','0000-00-00');

$this->zea->addInput('keterangan','textarea');
$this->zea->setLabel('keterangan','Keterangan Lain-lain');

$this->zea->addInput('nomor','text');
$this->zea->addInput('tgl','static');
$this->zea->setValue('tgl','0000-00-00');

$this->zea->setFormName('form_surat_pengantar');

$this->zea->form();

