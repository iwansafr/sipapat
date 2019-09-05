<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kategori_item = @$kategori[$item];
if(!is_desa() && !is_kecamatan())
{
	?>
	<a href="<?php echo base_url('admin/potensi/kecamatan/'.$kategori_item) ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> filter data</a>
	<?php
}
$form = new zea();
$where = '';
$form->init('roll');
$desa_id = !empty($_GET['desa_id']) ? @intval($_GET['desa_id']) : $desa_id;
$where = '';
$desa_id_get = '';
if(!empty($_GET))
{
	$desa_id_get = [];
	foreach($_GET AS $key => $value)
	{
		$desa_id_get[] = $key.'='.str_replace(' ','+',$value);
	}
	if(!empty($desa_id_get))
	{
		$desa_id_get = '?'.implode('&', $desa_id_get);
	}
}
if(!empty($desa_id))
{
	$where = ' desa_id = '.$desa_id;
	if(!empty($item)){
		$where .= ' AND kategori = '.$item;
	}
}
if(is_kecamatan())
{
	$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
	if(empty(@intval($_GET['desa_id'])))
	{
		$where = " kecamatan = '{$kecamatan}'";
		if(!empty($item)){
			$where .= ' AND kategori = '.$item;
		}
		$form->join('desa','ON(potensi_desa.desa_id=desa.id)','potensi_desa.*,desa.kecamatan');
		$form->addInput('kecamatan','plaintext');
	}
	$this->load->view('desa',['desa_option'=>$this->pengguna_model->get_desa($kecamatan)]);
}
if(!is_desa())
{
	if(!empty(@$_GET['kec']) && empty(@intval($_GET['desa_id'])))
	{
		$kecamatan = @$_GET['kec'];
		$form->join('desa','ON(potensi_desa.desa_id=desa.id)','potensi_desa.*,desa.kecamatan');
		$where = "kecamatan = '{$kecamatan}'";
		if(!empty($item)){
			$where .= ' AND kategori = '.$item;
		}
		$form->addInput('kecamatan','plaintext');
	}else{
		if(!empty($item))
		{
			if(empty($where))
			{
				$where = ' kategori = '.$item;
			}
		}
	}
}
$form->setTable('potensi_desa');

$form->search();

if(!is_desa())
{
	$form->setHeading
	(
		'<a target="_blank" href="'.base_url('admin/potensi/excel/'.@$kategori_item).$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>'
	);
	$form->setWhere($where);
	$form->addInput('desa_id','dropdown');
	$form->tableOptions('desa_id','desa','id','nama');
	$form->setAttribute('desa_id','disabled');
	$form->setLabel('desa_id','desa');
	$form->addInput('user_id','dropdown');
	$form->tableOptions('user_id','user','id','username');
	$form->setAttribute('user_id','disabled');
	$form->setLabel('user_id','pengguna');
}else{
	$form->setHeading('<a href="'.base_url('admin/potensi/edit/?item='.@intval($item)).'"><button class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i></button></a>
		<a target="_blank" href="'.base_url('admin/potensi/excel/'.@$kategori_item).$desa_id_get.'" class="btn btn-sm btn-default"><i class="fa fa-file-excel-o"></i></a>');
	$form->setWhere($where);
}

$form->setNumbering(TRUE);
$form->addInput('id','link');
$form->setLabel('id','detail');
$form->setPlainText('id','detail');
$form->setLink('id',base_url('admin/potensi/detail/'),'id');

$form->addInput('item','plaintext');
$form->addInput('kategori','dropdown');
$form->setOptions('kategori',$kategori);
$form->setAttribute('kategori','disabled');

$form->addInput('produk_desa','dropdown');
$form->setOptions('produk_desa',['Tidak Ada','Ada']);
$form->setLabel('produk_desa','Produk Desa');
$form->setAttribute('produk_desa','disabled');

$form->addInput('satuan','dropdown');
$form->setOptions('satuan',$satuan);
$form->setAttribute('satuan','disabled');

$form->addInput('volume','plaintext');
$form->setType('volume','number');

$form->addInput('waktu','dropdown');
$form->setOptions('waktu',$waktu);
$form->setAttribute('waktu','disabled');
$form->setUrl('admin/potensi/clear_list/'.@$item);
if(!empty($item))
{
	$form->setUrl('admin/potensi/clear_bidang/'.@$item);
}

if(is_desa())
{
	$form->setDelete(TRUE);
	$form->setEdit(TRUE);
	if(!empty($item))
	{
		$form->setEditLink(base_url('admin/potensi/edit?item='.$item.'&id='));
	}
}

$form->setFormName('potensi_form');
$form->form();
pr($form->getData()['query']);