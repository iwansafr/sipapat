<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_model extends CI_Model
{
	public function sumber_dana()
	{
		return 
		[
			'3'=> 'PAD ( Pendapatan Asli Desa )',
			'1'=> 'DD ( Dana Desa )',
			'2'=> 'ADD ( Alokasi Dana Desa )',
			'6'=> 'PDRD ( Pajak Daerah Dan Retribusi Daerah )',
			'4'=> 'Bankeu Provinsi',
			'5'=> 'Bankeu Kabupaten',
			'7'=> 'Hibah Dan Sumbangan Pihak ketiga',
			'8'=> 'Lain Lain Pendapatan Yang Sah'
		];
	}
	public function peserta()
	{
		return
		[
			[
				'id'=>'1',
				'par_id'=>'0',
				'title'=>'Kepala Desa'
			],
			[
				'id'=>'2',
				'par_id'=>'0',
				'title'=>'Perangkat Desa'
			],
			[
				'id'=>'3',
				'par_id'=>'0',
				'title'=>'Lembaga Desa'
			],
			[
				'id'=>'4',
				'par_id'=>'0',
				'title'=>'Warga Desa'
			],
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