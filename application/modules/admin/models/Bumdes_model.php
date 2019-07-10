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
}