<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suket_model extends CI_Model{
	public function cari_penduduk($nik = 0,$village_id = 0)
	{
		if(!empty($nik))
		{
			if(!empty($village_id))
			{
				return $this->db->query('SELECT penduduk.*,desa.nama AS desa FROM penduduk INNER JOIN desa ON(desa.id=penduduk.desa_id) WHERE NIK = ? AND desa.village_id = ?', [$nik,$village_id])->row_array();
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
				$data['keterangan'] = $post['keterangan'];
				$data['email'] = $post['email'];
				$data['hp'] = $post['hp'];
			}
		}
	}
}