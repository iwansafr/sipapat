<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_model extends CI_Model
{
	public function sumber_dana()
	{
		return 
		[
			'1'=> 'PAD ( Pendapatan Asli Desa )',
			'2'=> 'DD ( Dana Desa )',
			'3'=> 'ADD ( Alokasi Dana Desa )',
			'4'=> 'PDRD ( Pajak Daerah Dan Retribusi Daerah )',
			'5'=> 'Bankeu Provinsi',
			'6'=> 'Bankeu Kabupaten',
			'7'=> 'Hibah Dan Sumbangan Pihak ketiga',
			'8'=> 'Lain Lain Pendapatan Yang Sah'
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