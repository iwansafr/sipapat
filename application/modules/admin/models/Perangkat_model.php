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
	public function get_old($desa_id = 0)
	{
		$output = [];
		$data   = [];
		$output[] = 
		[
			'NAMA',
			'TGL_LAHIR',
			'DESA',
			'KECAMATAN',
			'UMUR',
		];
		if(!empty($desa_id))
		{
			$data = $this->db->query('SELECT p.nama,p.tgl_lahir,d.nama AS desa,d.kecamatan FROM perangkat_desa AS p INNER JOIN desa AS d ON(d.id=p.desa_id) WHERE desa_id = ? AND kelompok = 1',$desa_id)->result_array();
		}else{
			$data = $this->db->query('SELECT p.nama,p.tgl_lahir,d.nama AS desa,d.kecamatan FROM perangkat_desa AS p INNER JOIN desa AS d ON(d.id=p.desa_id) WHERE kelompok = 1')->result_array();
		}
		if(!empty($data))
		{
			foreach ($data as $key => $value) 
			{
				$bday = new DateTime($value['tgl_lahir']);
				$today = new Datetime(date('y-m-d'));
				$diff = $today->diff($bday);
				if(($diff->y > 45 && $diff->y < 100) && !empty($value['nama']))
				{
					$value['umur'] = $diff->y;
					$output[] = $value;
				}
				// printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
			}
		}
		return $output;
	}
	public function rekap()
	{
		$data = [];
		$data['old'] = 0;
		$data['young'] = 0;
		$data['age_n_valid'] = 0;
		$old_tmp = $this->db->query('SELECT p.nama,p.tgl_lahir FROM perangkat_desa AS p INNER JOIN desa AS d ON(d.id=p.desa_id) WHERE kelompok = 1')->result_array();
		$data['sekolah'] = $this->db->query('SELECT id FROM perangkat_desa WHERE pendidikan_terakhir < 10 AND kelompok = 1')->num_rows();
		$data['tidak_sekolah'] = $this->db->query('SELECT id FROM perangkat_desa WHERE pendidikan_terakhir = 10 AND kelompok = 1')->num_rows();
		$pddk_trakhir = $this->pendidikan_terakhir();
		foreach ($pddk_trakhir as $key => $value) 
		{
			$data['pendidikan_terakhir'][$value] = $this->db->query('SELECT id FROM perangkat_desa WHERE pendidikan_terakhir = ? AND kelompok = 1',$key)->num_rows();
		}
		if(!empty($old_tmp))
		{
			$i = 1;
			$j = 1;
			$k = 1;
			foreach ($old_tmp as $key => $value) 
			{
				$bday = new DateTime($value['tgl_lahir']);
				$today = new Datetime(date('y-m-d'));
				$diff = $today->diff($bday);
				if(($diff->y > 45 && $diff->y < 100) && !empty($value['nama']))
				{
					$data['old'] = $i;
					$i++;
				}else if(($diff->y < 46) && !empty($value['nama']))
				{
					$data['young'] = $j;
					$j++;
				}else{
					$data['age_n_valid'] = $k;
					$k++;
				}
				// printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
			}
		}
		return $data;
	}
	public function pendidikan_terakhir()
	{
		return
		[
			'1'=>strtoupper('akademi/diploma iii/s.muda'),
			'2'=>strtoupper('belum tamat sd/sederajat'),
			'3'=>strtoupper('diploma i/ii'),
			'4'=>strtoupper('diploma iv/strata i'),
			'5'=>strtoupper('slta/sederajat'),
			'6'=>strtoupper('sltp/sederajat'),
			'7'=>strtoupper('strata ii'),
			'8'=>strtoupper('strata iii'),
			'9'=>strtoupper('tamat sd/sederajat'),
			'10'=>strtoupper('tidak/belum sekolah')
		];
	}
}