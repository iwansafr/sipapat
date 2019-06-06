<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_model extends CI_Model
{
	public function sumber_dana()
	{
		return 
		[
			'1' => 'DD',
			'2' => 'ADD',
			'3' => 'PAD',
			'4' => 'BANKEU_PROV'
		];
	}
	public function bidang()
	{
		return 
		[
			'1'=>'Pengembangan Desa',
			'2'=>'Pembangunan Desa',
			'3'=>'Pembinaan Kemasyarakatan',
			'4'=>'Ekonomi dan TTG'
		];
	}
	public function get_pembangunan($id=0)
	{
		if(!empty(@intval($id)))
		{
			return $this->db->get_where('pembangunan', ['id'=>$id])->row_array();
		}
	}
}