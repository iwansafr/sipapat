<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_model extends CI_Model
{
	public function sumber_dana()
	{
		return 
		[
			'3'=> strtoupper('PAD ( Pendapatan Asli Desa )'),
			'1'=> strtoupper('DD ( Dana Desa )'),
			'2'=> strtoupper('ADD ( Alokasi Dana Desa )'),
			'6'=> strtoupper('PDRD ( Pajak Daerah Dan Retribusi Daerah )'),
			'4'=> strtoupper('Bankeu Provinsi'),
			'5'=> strtoupper('Bankeu Kabupaten'),
			'7'=> strtoupper('Hibah Dan Sumbangan Pihak ketiga'),
			'9'=> strtoupper('Dana Iuran Warga'),
			'8'=> strtoupper('Lain Lain Pendapatan Yang Sah'),
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