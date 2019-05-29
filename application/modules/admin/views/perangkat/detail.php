<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kelompok = empty($kelompok) ? 1: $kelompok;
$module = ['1'=>'','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd'];
$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd'];
echo '<a class="btn btn-warning btn-sm" href="'.base_url('admin/perangkat/'.$module[$kelompok].'/list').'"><i class="fa fa-arrow-left"></i> kembali</a>';
if(!empty($id) && is_numeric($id))
{
	// $form = new zea();
	// $form->init('edit');
	// $form->setId(@intval($id));
	// $form->setTable('perangkat_desa');
	// $form->addInput('desa_id','static');
	// $form->setValue('desa_id', @$pengguna['desa_id']);
	// $form->setHeading('Detail '.$module_title[$kelompok].' '.@$pengguna['username']);
	// $form->setEditStatus(FALSE);
	// $form->addInput('kelompok','static');
	// $form->setValue('kelompok',$kelompok);
	// $form->addInput('nama','plaintext');
	// $form->addInput('foto','thumbnail');
	// $form->setImage('foto','perangkat_desa');
	// $form->addInput('tempat_lahir','plaintext');
	// $form->setLabel('tempat_lahir','Tempat Lahir');
	// $form->addInput('tgl_lahir','plaintext');
	// $form->setLabel('tgl_lahir','Tanggal Lahir');
	// $form->setType('tgl_lahir','date');
	// $form->addInput('kelamin','dropdown');
	// $form->setAttribute('kelamin','disabled');
	// $form->setLabel('kelamin','Jenis Kelamin');
	// $form->setOptions('kelamin',['Perempuan','Laki-laki']);
	// $form->setAttribute('kelamin','disabled');

	// $form->addInput('alamat','plaintext');
	// $form->addInput('telepon','plaintext');
	// $form->setType('telepon','number');

	// $form->addInput('agama','dropdown');
	// $form->setAttribute('agama','disabled');
	// $form->setOptions('agama',
	// 	[
	// 		'1'=>'Islam',
	// 		'2'=>'Kristen',
	// 		'3'=>'Katholik',
	// 		'4'=>'Hindu',
	// 		'5'=>'Budha',
	// 		'6'=>'Khonghucu',
	// 		'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
	// 	]
	// );
	// $form->addInput('status_perkawinan','dropdown');
	// $form->setAttribute('status_perkawinan','disabled');
	// $form->setLabel('status_perkawinan','Status Perkawinan');
	// $form->setOptions('status_perkawinan',['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin']);
	// $form->setAttribute('status_perkawinan','disabled');

	// $form->addInput('pendidikan_terakhir','dropdown');
	// $form->setAttribute('pendidikan_terakhir','disabled');
	// $form->setLabel('pendidikan_terakhir','Pendidikan Terakhir');
	// $form->setOptions('pendidikan_terakhir',
	// 	[
	// 		'1'=>strtoupper('akademi/diploma iii/s.muda'),
	// 		'2'=>strtoupper('belum tamat sd/sederajat'),
	// 		'3'=>strtoupper('diploma i/ii'),
	// 		'4'=>strtoupper('diploma iv/strata i'),
	// 		'5'=>strtoupper('slta/sederajat'),
	// 		'6'=>strtoupper('sltp/sederajat'),
	// 		'7'=>strtoupper('strata ii'),
	// 		'8'=>strtoupper('strata iii'),
	// 		'9'=>strtoupper('tamat sd/sederajat'),
	// 		'10'=>strtoupper('tidak/belum sekolah')
	// 	]
	// );

	// if(!empty($jabatan[$kelompok]))
	// {
	// 	$form->addInput('jamkes','plaintext');
	// 	// $form->setLabel('jamkes','Jaminan Kesehatan');
	// 	$form->addInput('jabatan', 'dropdown');
	// 	$form->setAttribute('jabatan','disabled');
	// 	$form->setOptions('jabatan', $jabatan[$kelompok]);
	// }

	// if($module_title[$kelompok] == 'rt' || $module_title[$kelompok] == 'rw')
	// {
		// $form->addInput('rw','plaintext');
		// $form->setLabel('rw','Ketua RW');
		// if($module_title[$kelompok] == 'rt')
		// {
			// $form->addInput('rt','plaintext');
			// $form->setLabel('rt','Ketua RT');
			// $form->setLabel('rw','Wilayah RW');
		// }
	// }

	// $form->addInput('no_sk','plaintext');
	// $form->setType('no_sk','number');
	// $form->setLabel('no_sk','Nomor SK');
	// $form->addInput('sk_penetapan_kembali','plaintext');
	// $form->setLabel('sk_penetapan_kembali','SK Penetapan Kembali');

	// $form->addInput('tgl_pelantikan','plaintext');
	// $form->setLabel('tgl_pelantikan','Tanggal Pelantikan');
	// $form->setType('tgl_pelantikan','date');
	// $form->addInput('akhir_masa_jabatan','plaintext');
	// $form->setLabel('akhir_masa_jabatan','Akhir Masa Jabatan');
	// $form->setType('akhir_masa_jabatan','date');

	// $form->addInput('pelantik','plaintext');
	// $form->setLabel('pelantik','Pejabat Pelantik');
	// $form->addInput('bengkok','plaintext');
	// $form->setType('bengkok','number');
	// $form->setLabel('bengkok','Luas Bengkok');
	// $form->addInput('penghasilan','plaintext');
	// $form->setType('penghasilan','number');
	// $form->setLabel('penghasilan','Penghasilan Tetap');

	// $form->addInput('riwayat_pendidikan','plaintext');
	// $form->setLabel('riwayat_pendidikan','Riwayat Pendidikan');
	// $form->addInput('riwayat_diklat','plaintext');
	// $form->setLabel('riwayat_diklat','Riwayat Diklat');

	// $form->setSave(FALSE);
	// $form->form();
	// $data = $form->getData();
	$data = $this->db->query('SELECT * FROM perangkat_desa WHERE id = ?', $id)->row_array();
	$kelamin = ['Perempuan','Laki-laki'];
	$agama = 
		[
			'1'=>'Islam',
			'2'=>'Kristen',
			'3'=>'Katholik',
			'4'=>'Hindu',
			'5'=>'Budha',
			'6'=>'Khonghucu',
			'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
		];
	$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
	if(!empty($data))
	{
		// pr($data);
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Profile <?php echo $module_title[$kelompok].' '.$data['nama'] ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<img src="<?php echo image_module('perangkat_desa', $data['id'].'/'.$data['foto']) ?>" alt="" style="object-fit: cover;width: 100%; height: 350px;">
						</div>
						<div class="col-md-4">
							<table class="table table-responsive">
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?php echo $data['nama'] ?></td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td>:</td>
									<td><?php echo $data['tempat_lahir'] ?></td>
								</tr>
								<tr>
									<td>Tgl Lahir</td>
									<td>:</td>
									<td><?php echo content_date($data['tgl_lahir']) ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td><?php echo $kelamin[$data['kelamin']] ?></td>
								</tr>
								<tr>
									<td>Agama</td>
									<td>:</td>
									<td><?php echo $agama[$data['agama']] ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data['alamat'] ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-4">
							<table class="table table-responsive">
								<tr>
									<td>Status Perkawinan</td>
									<td>:</td>
									<td><?php echo $status_perkawinan[$data['status_perkawinan']] ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>	
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
		<?php
	}
}