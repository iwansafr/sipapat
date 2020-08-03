<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model
{
	public function rekap()
	{
		$this->load->model('pengguna_model');
		$lembaga = $this->pengguna_model->lembaga();
		$table = ['pembangunan','potensi_desa','desa_rekening','perdes','posyantekdes','corona','corona_posko','blt'];
		// $data = [];
		foreach($lembaga AS $key => $value)
		{
			$data[$value] = $this->db->query('SELECT count(desa_id) AS total,desa_id FROM perangkat_desa WHERE kelompok = ? GROUP BY desa_id',$key)->result_array();
		}
		foreach ($table as $key => $value) 
		{
			$data[$value] = $this->db->query('SELECT count(desa_id) AS total,desa_id FROM '.$value.' GROUP BY desa_id')->result_array();
		}
		return $data;
	}
}