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
}