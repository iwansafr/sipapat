<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suket_model extends CI_Model{
	public function cari_penduduk($nik = 0,$village_id = 0)
	{
		if(!empty($nik))
		{
			if(!empty($village_id))
			{
				return $this->db->query('SELECT penduduk.*,desa.nama AS desa FROM penduduk INNER JOIN desa ON(desa.id=penduduk.desa_id) WHERE NIK = ? AND desa.id = ?', [$nik,$village_id])->row_array();
			}else{
				return $this->db->query('SELECT penduduk.*,desa.nama AS desa FROM penduduk INNER JOIN desa ON(desa.id=penduduk.desa_id) WHERE NIK = ?', [$nik])->row_array();
			}
		}
	}
	public function ajukan($post = [])
	{
		if(!empty($post))
		{
			$data = [];
			$data['desa_id'] = @$this->db->query('SELECT desa_id FROM penduduk WHERE id = ?',$post['id'])->row_array()['desa_id'];
			if(!empty($data['desa_id']))
			{
				$data['dilan_surat_ket_id'] = $post['keterangan_id'];
				$data['keterangan']         = $post['keterangan'];
				$data['email']              = $post['email'];
				$data['hp']                 = $post['hp'];
				$data['penduduk_id']        = $post['id'];

				$user_id = @$this->db->query('SELECT user_id FROM user_desa WHERE desa_id = ?',$data['desa_id'])->row_array()['user_id'];
				if(!empty($user_id))
				{
					$this->db->trans_start();
					$this->db->insert('dilan_surat_pengajuan', $data);
					$last_id = $this->db->insert_id();
					if(!empty($last_id))
					{
						$notification = [
							'user_id' => $user_id,
							'title' => 'Pengajuan SuKet',
							'link' => base_url('admin/dilan/surat_pengajuan/'.$last_id)
						];
						$this->db->insert('notification',$notification);
						$this->db->trans_complete();
					}else{
						return false;
					}
					return true;
				}else{
					return false;
				}
			}
		}
	}
}