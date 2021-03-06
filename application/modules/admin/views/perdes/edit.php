<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa() || is_root())
{
	if((@$perdes['desa_id'] == @$desa_id) || empty($_GET['id']))
	{
		$id = @intval($_GET['id']);
		$form = new zea();
		$form->setTable('perdes');
		$form->init('edit');
		$form->setId($id);
		$form->addInput('item','dropdown');
		$form->setOptions('item',$perdes_options);
		$form->addInput('no','text');
		$form->setLabel('no','Nomor');
		$form->addInput('tgl_penetapan','text');
		$form->setType('tgl_penetapan','date');
		$form->setHelp('tgl_penetapan','dd = tgl, mm = bulan, yyyy = tahun');
		$form->addInput('tgl_pelaksanaan','text');
		$form->setType('tgl_pelaksanaan','date');
		$form->setHelp('tgl_pelaksanaan','dd = tgl, mm = bulan, yyyy = tahun');

		$form->addInput('file_office','uploads');
		$form->setAccept('file_office','.doc,.docx,.xls,.xlsx');
		// $form->setAttribute('file_office',['accept'=>'.doc,.docx,.xls,.xlsx']);
		$form->addInput('progress','dropdown');
		if(is_desa())
		{
			$form->addInput('desa_id','static');
			$form->setValue('desa_id',@intval($desa_id));
		}else{
			if(!empty($sipapat_config))
			{
				$form->addInput('desa_id','dropdown');
				$form->setLabel('desa_id','Desa');
				$form->tableOptions('desa_id','desa','id','nama','regency_id = '.$sipapat_config['regency_id']);

			}
		}
		$form->addInput('user_id','static');
		$form->setValue('user_id',@intval($user['id']));
		$form->setOptions('progress',$perdes_progress);

		if(empty($id))
		{
			$form->setRequired('All');
		}
		$form->form();
	}else{
		msg('anda tidak punya akses ke halaman ini ', 'danger');
	}
}else{
	msg('Anda Tidak Memiliki akses ke halaman ini','danger');
}