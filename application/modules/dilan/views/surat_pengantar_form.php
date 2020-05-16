<?php defined('BASEPATH') OR exit('No direct script access allowed');
$paramname = str_replace('/', '_', base_url().'_dilan_config');
$dilan_config = $this->esg->get_config($paramname);
?>
<style>
	body{
		background-image: url(<?php echo image_module('config',$paramname.'/'.$dilan_config['image'])?>);
		background-size: cover;
		/*color: white;*/
	}
	html {
	  scroll-behavior: smooth;
	}

</style>
<div class="container-fluid mt-5">
	<div class="container">
		<div class="card bg-dark text-white" id="start_section">
			<div class="card card-header">
				<h6 class="panel-title text-primary">
					DETAIL DATA DIRI
					<a href="#end_section" class="btn btn-secondary pull-right"><i class="fa fa-arrow-down"></i></a>
				</h6>
			</div>
			<div class="card-body">
				<table class="table text-white">
					<tr>
						<td>NAMA</td>
						<td>: <?php echo $penduduk['nama'] ?></td>
					</tr>
					<tr>
						<td>JK</td>
						<td>: <?php echo @$kelamin[$penduduk['jk']] ?></td>
					</tr>
					<tr>
						<td>TTL</td>
						<td>: <?php echo $penduduk['tmpt_lhr'].', '.content_date($penduduk['tgl_lhr']) ?></td>
					</tr>
					<tr>
						<td>PEKERJAAN</td>
						<td>: <?php echo $pekerjaan[$penduduk['pekerjaan']] ?></td>
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
			<div class="card-footer">
				
			</div>
		</div>
		<?php

		$cur_date = date_create();
		$current_date = date_format($cur_date, 'Y-m-d');
		date_add($cur_date, date_interval_create_from_date_string('1 month'));
		$next_date = date_format($cur_date, 'Y-m-d');

		$this->zea->setDarkMode(true);
		$this->zea->setHeading('Surat Keterangan/Pengantar');
		$this->zea->setEditStatus(false);
		$this->zea->init('edit');
		$this->zea->setTable('dilan_surat');

		$this->zea->addInput('keperluan','textarea');
		$this->zea->addInput('penduduk_id','static');
		$this->zea->setValue('penduduk_id',@intval($penduduk['id']));

		$this->zea->addInput('dilan_surat_ket_id', 'static');
		$this->zea->setValue('dilan_surat_ket_id',$keterangan['id']);

		$this->zea->addInput('desa_id','static');
		$this->zea->setValue('desa_id', $desa['id']);

		$this->zea->addInput('berlaku_mulai','static');
		$this->zea->setValue('berlaku_mulai',$current_date);
		$this->zea->addInput('berlaku_sampai','static');
		$this->zea->setValue('berlaku_sampai',$next_date);

		$this->zea->addInput('keterangan','textarea');
		$this->zea->setLabel('keterangan','Keterangan Lain-lain');

		// $this->zea->addInput('nomor','text');
		// DLN/01/RONGGO/04/2020
		// DLN/01/
		$this->zea->addInput('tgl','static');
		$this->zea->setValue('tgl',$current_date);
		if(!empty($keterangan))
		{
			$this->zea->setValue('keperluan',$keterangan['keperluan']);
			$this->zea->setValue('keterangan',$keterangan['keterangan']);
			// $this->zea->setAttribute('keperluan','readonly');
			// $this->zea->setAttribute('keterangan','readonly');
		}

		$this->zea->setFormName('form_surat_pengantar');

		$this->zea->form();
		?>
		<div id="end_section"></div>
	</div>
</div>
?>
