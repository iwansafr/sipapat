<?php defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('memory_limit', '1012M');
$form = new zea();

$form->setTable('penduduk');

$form->init('roll');

$form->search();
$is_desa = is_desa();
$desa_id = 0;
$group = @$_GET['group'];

if(!$is_desa)
{
	$desa_id = @intval($_GET['desa_id']);
	if(!empty($desa_id))
	{
		// $form->setWhere("desa_id = ".$desa_id." AND aktif = ".$aktif_num);
		$q = 'desa_id = '.$desa_id.' AND aktif = '.$aktif_num;
		if(!empty($group))
		{
			if($group != 'umur')
			{
				$q .= ' AND '.$group.' = '.@intval($_GET[$group]);
			}else{
				$umur_group = intval($_GET[$group]);
				$umur_sql = '';
				switch ($umur_group) {
					case '1':
						$umur_sql = ' < 6';
						break;
					case '2':
						$umur_sql = ' < 12';
						break;
					case '3':
						$umur_sql = ' < 26';
						break;
					case '4':
						$umur_sql = ' < 46';
						break;
					case '5':
						$umur_sql = ' > 45';
						break;
					default:
						$umur_sql = '';
						break;
				}
				$q .= " AND DATEDIFF(CURRENT_DATE, STR_TO_DATE(tgl_lhr, '%Y-%m-%d'))/365 {$umur_sql}";
			}
		}
		$form->setWhere($q);
	}else{
		$kecamatan = @$_GET['kec'];
		if(!empty($kecamatan))
		{
			$form->join('desa','ON(penduduk.desa_id=desa.id)','penduduk.id,penduduk.no_kk,penduduk.nik,penduduk.nama,desa.nama AS desa,desa.kecamatan');
			$form->setWhere(" kecamatan = '{$kecamatan}'");
			$form->addInput('kecamatan','plaintext');
		}
	}
}else{
	$desa_id = $this->sipapat_model->get_desa_id();
	$q = 'desa_id = '.$desa_id.' AND aktif = '.$aktif_num;
	if(!empty($group))
	{
		$q .= ' AND '.$group.' = '.@intval($_GET[$group]);
	}
	$form->setWhere($q);
}

$form->order_by('penduduk.id','DESC');
// $form->disable_order_by();
if(!$is_desa && !is_kecamatan())
{
	if(empty($type))
	{
		?>
		<a href="<?php echo base_url('admin/dilan/kecamatan_list/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a>
		<a href="<?php echo base_url('admin/dilan/laporan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Record Data</a>
		<?php
	}
}

if(!empty($desa_id) || $is_desa)
{
	$excel_get = make_get($_GET);
	if($is_desa)
	{
		$excel_get = '?desa_id='.$desa_id;
	}
	$filter_group = 
	[
		'jk'=>'Kelamin',
		'agama'=>'agama',
		'gdr'=>'Golongan Darah',
		'status'=>'Status',
		'shdk'=>'Status dalam keluarga',
		'pnydng_cct'=>'Penyandang Cacat',
		'pddk_akhir'=>'Pendidikan',
		'pekerjaan'=>'Pekerjaan',
		'umur'=>'Umur',
	];
	?>
	<?php if (empty($type)): ?>
		<a target="_blank" href="<?php echo base_url('admin/dilan/download_excel/'.$excel_get) ?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Download</a>
		<a href="<?php echo base_url('admin/dilan/detail_desa/') ?>" class="btn btn-sm btn-success"><i class="fa fa-chart-bar"></i> Statistik</a>
		<div class="col-md-4 pull-right">
			<form action="<?php echo base_url('admin/dilan/filter_by/') ?>" class="pull-right" method="get">
				<div class="form-group form-inline">
					<?php if (!empty($desa_id)): ?>
						<input type="hidden" name="desa_id" value="<?php echo $desa_id ?>">
					<?php endif ?>
					<select class="form-control" name="group">
						<?php foreach ($filter_group as $key => $value): ?>
							<?php $selected = $key == $group ? 'selected' : '';?>
							<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>
						<?php endforeach ?>
					</select>
					<button class="btn btn-default"><i class="fa fa-list"></i> filter</button>
				</div>
			</form>
		</div>
	<?php endif ?>
	<?php	
}

// $form->setHeading('<a target="_blank" href="'.base_url('admin/dilan/penduduk_excel/'.$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>');

$surat_pengantar_text = is_desa() || is_root() ? '<li><a href="'.base_url('admin/dilan/surat_pengantar_choose_form/').'{id}/{nik}"><i class="fa fa-plus"></i>Surat Pengantar</a></li>' : '';
$form->setNumbering(true);
$form->addInput('id','plaintext');
$form->setLink('id',base_url(),'id');
$form->setLabel('id','action');
$form->setPlaintext('id','
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Action
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	  	<li><a href="'.base_url('admin/dilan/detail/').'{id}"><i class="fa fa-search"></i>Detail</a></li>
	    '.$surat_pengantar_text.'
	    <li role="separator" class="divider"></li>
	    <li><a href="#{id}">dll</a></li>
	  </ul>
	</div>
');
$form->addInput('no_kk','plaintext');
$form->addInput('nik','plaintext');
$form->addInput('nama','plaintext');
$form->addInput('alamat','plaintext');
$form->addInput('tgl_lhr','plaintext');
$form->setLabel('alamat','desa');
// $form->addInput('jk','dropdown');
// $form->setOptions('jk',['1'=>'Laki-laki','2'=>'perempuan']);
// $form->setAttribute('jk','disabled');
// $form->addInput('status','dropdown');
// $form->setOptions('status',$this->dilan_model->status());
// $form->setAttribute('status','disabled');

if($is_desa)
{
	$form->addInput('no_rt','plaintext');
	$form->addInput('no_rw','plaintext');
}
if(!empty($type))
{
	$form->addInput('aktif','dropdown');
	$form->setLabel('aktif','tindakan');
	$form->setOptions('aktif',['Tidak Aktif','Terima','Mengajukan']);
}
$form->setUrl('admin/dilan/clear_list/'.$type);
if(is_desa() || is_root())
{
	$form->setDelete(true);
	$form->setEdit(true);
}


$form->form();
if(is_root())
{
	pr($form->getData()['query']);
}