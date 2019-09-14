<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkat_model extends CI_Model
{
	public function kepala_desa($desa_id = 0)
	{
		$data = [];
		if(!empty($desa_id))
		{
			$data = $this->db->get_where('perangkat_desa', ['kelompok'=>1,'jabatan'=>1,'desa_id'=>$desa_id])->row_array();
		}else{
			$data = $this->db->get_where('perangkat_desa', ['kelompok'=>1,'jabatan'=>1])->result_array();
		}
		return $data;
	}
}