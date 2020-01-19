<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model
{
	public function tanpa_perangkat()
	{
		$get = @intval($_GET['kelompok']);
		$kelompok_id = ['1'=>'perangkat desa', '2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$kelompok_min = ['1'=>5, '2'=>5,'3'=>5,'4'=>5,'5'=>5,'6'=>3,'7'=>2,'8'=>1,'9'=>5];
		$data = array();
		$desa = $this->db->query('SELECT id,nama FROM desa')->result_array();

		// $desa_perangkat = $this->db->query('SELECT desa_id,COUNT(*) AS tot FROM perangkat_desa GROUP BY desa_id')->result_array();
		$desa_perangkat = $this->db->query('SELECT desa_id,kelompok FROM perangkat_desa order by desa_id ASC')->result_array();
		$desa_tmp = array();

		foreach ($desa_perangkat as $key => $value) 
		{
			$desa_tmp[$value['kelompok']][] = $value['desa_id'];
		}

		$kelompok = [];
		foreach($kelompok_id AS $kkey => $kvalue)
		{
			$total = 1;
			foreach ($desa_tmp[$kkey] as $key => $value) 
			{
				if($key>0)
				{
					if($desa_tmp[$kkey][$key] == $desa_tmp[$kkey][$key-1])
					{
						$total++;
						$kelompok[$kkey][$value] = $total;
					}else{
						$total = 1;
					}
				}
			}
		}
		$data_desa = array();
		foreach ($kelompok_id as $kkey => $kvalue)
		{
			foreach ($desa as $key => $value) 
			{
				$total = @intval($kelompok[$kkey][$value['id']]);
				$desa_tmp[$kkey] = array_unique($desa_tmp[$kkey]);
				if(!in_array($value['id'], $desa_tmp[$kkey]))
				{
					$data_desa['uncomplete'][$kkey][] = 
					[
						'id'=>$value['id'],
						'nama'=>$value['nama'],
						'total' => $total
					];
				}else{
					if($total >= $kelompok_min[$kkey])
					{
						$data_desa['complete'][$kkey][] = 
						[
							'id'=>$value['id'],
							'nama'=>$value['nama'],
							'total' => $total
						];
					}else if($total == 0){
						$data_desa['uncomplete'][$kkey][] = 
						[
							'id'=>$value['id'],
							'nama'=>$value['nama'],
							'total' => $total
						];
					}else{
						$data_desa['kurang'][$kkey][] = 
						[
							'id'=>$value['id'],
							'nama'=>$value['nama'],
							'total' => $total
						];
					}
				}
			}
		}
		if(!empty($data_desa))
		{
			if(!empty($get))
			{
					if(!empty($data_desa['uncomplete'][$get]))
					{
						$data['uncomplete'][$get]['data']  = $data_desa['uncomplete'][$get];
						$data['uncomplete'][$get]['title'] = $kelompok_id[$get];
						$data['uncomplete'][$get]['total'] = count($data_desa['uncomplete'][$get]);
					}
					if(!empty($data_desa['kurang'][$get]))
					{
						$data['kurang'][$get]['data']  = $data_desa['kurang'][$get];
						$data['kurang'][$get]['title'] = $kelompok_id[$get];
						$data['kurang'][$get]['total'] = count($data_desa['kurang'][$get]);
					}
					if(!empty($data_desa['complete'][$get]))
					{
						$data['complete'][$get]['data']  = $data_desa['complete'][$get];
						$data['complete'][$get]['title'] = $kelompok_id[$get];
						$data['complete'][$get]['total'] = count($data_desa['complete'][$get]);
					}
			}else{
				foreach ($kelompok_id as $key => $value)
				{
					if(!empty($data_desa['uncomplete'][$key]))
					{
						$data['uncomplete'][$key]['data']  = $data_desa['uncomplete'][$key];
						$data['uncomplete'][$key]['title'] = $value;
						$data['uncomplete'][$key]['total'] = count($data_desa['uncomplete'][$key]);
					}
					if(!empty($data_desa['kurang'][$key]))
					{
						$data['kurang'][$key]['data']  = $data_desa['kurang'][$key];
						$data['kurang'][$key]['title'] = $value;
						$data['kurang'][$key]['total'] = count($data_desa['kurang'][$key]);
					}
					if(!empty($data_desa['complete'][$key]))
					{
						$data['complete'][$key]['data']  = $data_desa['complete'][$key];
						$data['complete'][$key]['title'] = $value;
						$data['complete'][$key]['total'] = count($data_desa['complete'][$key]);
					}
				}
			}
		}
		return $data;
	}
	public function detail($id = 0)
	{
		return $this->db->get_where('desa',['id'=>$id])->row_array();
	}

	public function tanpa_potensi()
	{
		$data = array();
		$desa = $this->db->query('SELECT id,nama FROM desa')->result_array();

		$desa_potensi = $this->db->query('SELECT desa_id,count(desa_id) AS total FROM potensi_desa GROUP BY desa_id order by desa_id ASC')->result_array();
		$desa_tmp = [];
		foreach ($desa_potensi as $key => $value) 
		{
			$desa_tmp[$value['desa_id']] = $value;
		}

		foreach ($desa as $key => $value) 
		{
			$total = @intval($desa_tmp[$value['id']]['total']);
			if($total>0)
			{
				$data_desa['complete'][] = 
				[
					'id'=>$value['id'],
					'nama'=>$value['nama'],
					'total' => $total
				];
			}else{
				$data_desa['uncomplete'][] = 
				[
					'id'=>$value['id'],
					'nama'=>$value['nama'],
					'total' => $total
				];
			}
		}
		return $data_desa;
	}
}