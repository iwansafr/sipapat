<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perdes_model extends CI_Model{

	public function perdes_item()
	{
		return
		[
			'1'=>'RPJMDS',
			'2'=>'RKP DESA',
			'3'=>'APBDES',
			'6'=>'REALISASI APBDES',
			'4'=>'PERDES KEWENANGAN',
			'5'=>'PERDES ASET'
		];
	}
	public function perdes_progress()
	{
		return
		[
			'1'=>'DRAFTING DI DESA',
			'2'=>'EVALUASI KECAMATAN',
			'3'=>'BELUM DIBUAT',
		];
	}
	public function get_perdes($id = 0)
	{
		if(!empty($id))
		{
			return $this->db->get_where('perdes',['id'=>$id])->row_array();
		}
	}
}