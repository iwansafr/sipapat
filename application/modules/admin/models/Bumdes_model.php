<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes_model extends CI_Model{
	public function kategori_usaha()
	{
		return 
		[
			'1'=>'JASA KEUANGAN',
			'2'=>'JASA NON KEUANGAN',
			'3'=>'BROKERING',
			'4'=>'PERTANIAN',
			'5'=>'PETERNAKAN',
			'6'=>'PERDAGANGAN',
		];
	}
	public function tingkat_pemeringkatan()
	{
		return
		[
			'1'=>'DASAR',
			'2'=>'TUMBUH',
			'3'=>'BERKEMBANG',
			'4'=>'MAJU'
		];
	}

	public function get_bumdes_id($desa_id = 0)
	{
		if(!empty($desa_id))
		{
			$this->db->select('id');
			return $this->db->get_where('bumdes',['desa_id'=>$desa_id])->row_array()['id'];
		}
	}

	public function get_bumdes($id = 0)
	{
		if(!empty($id))
		{
			return $this->db->get_where('bumdes',['id'=>$id])->row_array();
		}
	}

	public function get_alamat($alamat = '')
	{
		if(!empty($alamat))
		{
			$alamat = explode("\n",$alamat);
			$alamat_array = [];
			foreach ($alamat as $key => $value) 
			{
				$tmp_alamat = explode(':',$value);
				$alamat_array[@$tmp_alamat[0]] = @$tmp_alamat[1];	
			}
			return $alamat_array;
		}
	}
}