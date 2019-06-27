<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($_GET['id']))
{
	?>
	<a class="btn btn-warning btn-sm" href="<?php echo base_url('admin/pembangunan/edit?id='.@intval($_GET['id']));?>"><i class="fa fa-arrow-left"></i>Kembali</a>
	<?php

	if(!empty($view) || is_desa() || is_root())
	{
		$id   = @intval($_GET['id']);
		$form = new zea();
		$form->setTable('pembangunan');
		$form->init('edit');
		$form->setId($id);
		if(!empty($id))
		{
			$data = $form->getData();
		}

		$data = array();
		if(!empty($id))
		{
			$data = $form->getData();
		}

		if($view == 'fisik' || @$data['jenis'] == 1)
		{
			if((!empty($_GET['bankeu_prov']) || !empty($_GET['bankeu_kab'])) || (@$data['sumber_dana'] == 4 || @$data['sumber_dana'] == 5) ){
				$form->addInput('doc_0','file');
				$form->setLabel('doc_0','Dokumantasi 0 %');
				$form->addInput('doc_50','file');
				$form->setLabel('doc_50','Dokumantasi 50 %');
				$form->addInput('doc_100','file');
				$form->setLabel('doc_100','Dokumantasi 100 %');
				if(empty($id))
				{
					$form->setAttribute('doc_0',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setAttribute('doc_50',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setAttribute('doc_100',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setRequired(['doc_0','doc_50','doc_100','anggaran']);
				}
			}else{
				$form->addInput('doc_0','file');
				$form->setLabel('doc_0','Dokumantasi 0 %');
				$form->addInput('doc_40','file');
				$form->setLabel('doc_40','Dokumantasi 40 %');
				$form->addInput('doc_80','file');
				$form->setLabel('doc_80','Dokumantasi 80 %');
				$form->addInput('doc_100','file');
				$form->setLabel('doc_100','Dokumantasi 100 %');
				if(empty($id))
				{
					$form->setAttribute('doc_0',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setAttribute('doc_40',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setAttribute('doc_80',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setAttribute('doc_100',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
					$form->setRequired(['doc_0','doc_40','doc_80','doc_100','anggaran']);
				}
			}
		}else{
			$form->addInput('doc','file');
			$form->setLabel('doc','Foto Kegiatan');
			$form->setAttribute('doc',['oninvalid'=>"this.setCustomValidity('gambar tidak boleh kosong')",'oninput'=>"setCustomValidity('')"]);
			$form->setRequired(['doc','anggaran','peserta']);
		}

		$form->form();
	}else{
		msg('Maaf URL yg anda tuju tidak valid', 'danger');
	}
}