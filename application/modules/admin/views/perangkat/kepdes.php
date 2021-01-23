<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="box">
	<table class="table">
		<thead>
			<th>NO</th>
			<th>Kecamatan</th>
			<th>SMA</th>
			<th>D3</th>
			<th>S1</th>
			<th>S2</th>
			<th>S3</th>
		</thead>
		<tbody>
			<?php $sma = []; $sma['total'] = 0;?>
			<?php $d3 = []; $d3['total'] = 0;?>
			<?php $s1 = []; $s1['total'] = 0;?>
			<?php $s2 = []; $s2['total'] = 0;?>
			<?php $s3 = []; $s3['total'] = 0;?>
			<?php foreach ($kecamatan as $key => $value): ?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['kecamatan'] ?></td>
					<?php foreach ($rekap['SMA'] as $rvalue): ?>
						<?php if ($value['kecamatan'] == $rvalue['kecamatan']): ?>
							<?php $sma['total'] += $rvalue['total']; ?>
							<td><?php echo $rvalue['total']?></td>
							<?php $sma[$value['kecamatan']] = true; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if (empty($sma[$value['kecamatan']])): ?>
						<td>0</td>
					<?php endif ?>
					<?php foreach ($rekap['D3'] as $rvalue): ?>
						<?php if ($value['kecamatan'] == $rvalue['kecamatan']): ?>
							<?php $d3['total'] += $rvalue['total']; ?>
							<td><?php echo $rvalue['total'] ?></td>
						<?php $d3[$value['kecamatan']] = true; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if (empty($d3[$value['kecamatan']])): ?>
						<td>0</td>
					<?php endif ?>

					<?php foreach ($rekap['S1'] as $rvalue): ?>
						<?php if ($value['kecamatan'] == $rvalue['kecamatan']): ?>
							<?php $s1['total'] += $rvalue['total']; ?>
							<td><?php echo $rvalue['total'] ?></td>
						<?php $s1[$value['kecamatan']] = true; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if (empty($s1[$value['kecamatan']])): ?>
						<td>0</td>
					<?php endif ?>

					<?php foreach ($rekap['S2'] as $rvalue): ?>
						<?php if ($value['kecamatan'] == $rvalue['kecamatan']): ?>
							<?php $s2['total'] += $rvalue['total']; ?>
							<td><?php echo $rvalue['total'] ?></td>
						<?php $s2[$value['kecamatan']] = true; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if (empty($s2[$value['kecamatan']])): ?>
						<td>0</td>
					<?php endif ?>

					<?php foreach ($rekap['S3'] as $rvalue): ?>
						<?php if ($value['kecamatan'] == $rvalue['kecamatan']): ?>
							<?php $s3['total'] += $rvalue['total']; ?>
							<td><?php echo $rvalue['total'] ?></td>
						<?php $s3[$value['kecamatan']] = true; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if (empty($s3[$value['kecamatan']])): ?>
						<td>0</td>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
			<tr>
				<td colspan="2"><b>Total</b></td>
				<td> <?php echo $sma['total'] ?> </td>
				<td> <?php echo $d3['total'] ?> </td>
				<td> <?php echo $s1['total'] ?> </td>
				<td> <?php echo $s2['total'] ?> </td>
				<td> <?php echo $s3['total'] ?> </td>
			</tr>
		</tbody>
	</table>
</div>

<?php
$form = new Zea();
$form->init('roll');
$form->search();
$form->setTable('perangkat_desa');
$form->setNumbering(TRUE);
$form->setWhere(' kelompok = 1 AND jabatan = 1');
$form->group_by('desa_id');

$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detail');
$form->setLink('id',base_url('admin/perangkat/detail'),'id');
$form->setClearGet('id');

$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setAttribute('desa_id','disabled');
$form->setLabel('desa_id','Nama Desa');
$form->addInput('nama','plaintext');
// $form->addInput('foto','thumbnail');
$form->addInput('tempat_lahir','plaintext');
$form->setLabel('tempat_lahir','Tempat Lahir');
$form->addInput('tgl_lahir','plaintext');
$form->setLabel('tgl_lahir','Tanggal Lahir');
$form->setType('tgl_lahir','date');
$form->addInput('kelamin','dropdown');
$form->setLabel('kelamin','Jenis Kelamin');
$form->setOptions('kelamin',['Perempuan','Laki-laki']);
$form->setAttribute('kelamin','disabled');
$form->addInput('agama','dropdown');
$form->setOptions('agama',
	[
		'1'=>'Islam',
		'2'=>'Kristen',
		'3'=>'Katholik',
		'4'=>'Hindu',
		'5'=>'Budha',
		'6'=>'Khonghucu',
		'7'=>'Kepercayaan Terhadap Tuhan YME/Lainnya'
	]
);
$form->setAttribute('agama','disabled');

$form->addInput('status_perkawinan','dropdown');
$form->setLabel('status_perkawinan','Status Perkawinan');
$form->setOptions('status_perkawinan',['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin']);
$form->setAttribute('status_perkawinan','disabled');

$form->addInput('pendidikan_terakhir','dropdown');
$form->setLabel('pendidikan_terakhir','Pendidikan Terakhir');
$form->setOptions('pendidikan_terakhir',
	[
		'1'=>strtoupper('akademi/diploma iii/s.muda'),
		'2'=>strtoupper('belum tamat sd/sederajat'),
		'3'=>strtoupper('diploma i/ii'),
		'4'=>strtoupper('diploma iv/strata i'),
		'5'=>strtoupper('slta/sederajat'),
		'6'=>strtoupper('sltp/sederajat'),
		'7'=>strtoupper('strata ii'),
		'8'=>strtoupper('strata iii'),
		'9'=>strtoupper('tamat sd/sederajat'),
		'10'=>strtoupper('tidak/belum sekolah')
	]
);
$form->setAttribute('pendidikan_terakhir','disabled');

$form->addInput('no_sk','plaintext');
$form->setType('no_sk','number');
$form->setLabel('no_sk','Nomor SK');
$form->addInput('sk_penetapan_kembali','plaintext');
$form->setLabel('sk_penetapan_kembali','SK Penetapan Kembali');

$form->addInput('tgl_pelantikan','plaintext');
$form->setLabel('tgl_pelantikan','Tanggal Pelantikan');
$form->setType('tgl_pelantikan','date');

$form->addInput('akhir_masa_jabatan','plaintext');
$form->setLabel('akhir_masa_jabatan','Akhir Masa Jabatan');
$form->setType('akhir_masa_jabatan','date');

$form->setUrl('admin/perangkat/kepdes_list/');

$form->form();
if(is_root())
{
	// pr($form->getData()['query']);
}