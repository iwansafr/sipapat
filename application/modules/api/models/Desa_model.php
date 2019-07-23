<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model
{
	public function tanpa_perangkat()
	{
		$data = array();
		$desa = $this->db->query('SELECT id,nama FROM desa')->result_array();

		$desa_perangkat = $this->db->query('SELECT desa_id,COUNT(*) AS tot FROM perangkat_desa GROUP BY desa_id')->result_array();
		// $tmp_desa_id = [];
		
		// pr($desa_perangkat);

		// die();

		// $desa_perangkat = $this->db->query('SELECT desa_id FROM perangkat_desa WHERE count(desa_id) AS c_d_id > 5 GROUP BY desa_id')->result_array();
		// pr($desa_perangkat);
		// die();

		$desa_tmp = array();
		foreach ($desa_perangkat as $key => $value) 
		{
			if($value['tot'] > 4)
			{
				$desa_tmp[] = $value['desa_id'];
			}
		}

		$data_desa = array();
		foreach ($desa as $key => $value) 
		{
			if(!in_array($value['id'], $desa_tmp))
			{
				$data_desa['uncomplete'][] = ['id'=>$value['id'],'nama'=>$value['nama']];
			}else{
				$data_desa['complete'][] = ['id'=>$value['id'],'nama'=>$value['nama']];
			}
		}
		if(!empty($data_desa))
		{
			$data['uncomplete']['data']    = $data_desa['uncomplete'];
			$data['uncomplete']['total']   = count($data_desa['uncomplete']);
			$data['complete']['data']      = $data_desa['complete'];
			$data['complete']['total']     = count($data_desa['complete']);
		}
		return $data;
	}
}