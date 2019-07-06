<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model
{
	public function tanpa_perangkat()
	{
		$data = array();
		$desa = $this->db->query('SELECT id FROM desa')->result_array();

		$desa_perangkat = $this->db->query('SELECT desa_id FROM perangkat_desa GROUP BY desa_id')->result_array();

		$desa_tmp = array();
		foreach ($desa_perangkat as $key => $value) 
		{
			$desa_tmp[] = $value['desa_id'];
		}

		$desa_id = array();
		foreach ($desa as $key => $value) 
		{
			if(!in_array($value['id'], $desa_tmp))
			{
				$desa_id[] = $value['id'];
			}
		}
		if(!empty($desa_id))
		{
			// $desa_id = implode(',',$desa_id);
			$this->db->select('id,nama');
			$this->db->where_in('id', $desa_id);
			$data = $this->db->get('desa')->result_array();
		}
		return $data;
	}
}