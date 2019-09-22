<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan_model extends CI_Model
{
	public function upload($file = '', $mode = '')
	{
		if(!empty($file['tmp_name']))
		{
			$dir = FCPATH.'images/modules/dilan/';
			if(!is_dir($dir))
			{
				mkdir($dir, 0777);
			}
			if(copy($file['tmp_name'] , $dir.$_SESSION[base_url().'_logged_in']['username'].$mode.'.xlsx'))
			{
				return $_SESSION[base_url().'_logged_in']['username'].'.xlsx';
			}
		}
	}
	public function get_penduduk($id = 0)
	{
		return $this->db->get_where('penduduk',['id'=>$id])->row_array();
	}
	public function get_surat($id = 0)
	{
		return $this->db->get_where('dilan_surat',['id'=>$id])->row_array();
	}

	public function kelamin()
	{
		return ['1'=>'Laki-laki', '2'=>'Perempuan'];
	}

	public function golongan_darah()
	{
		$data = ['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-','tidak tahu'];
		$data = array_start_one($data);
		return $data;
	}

	public function agama()
	{
		$data = ['1'=>'Islam','2'=>'Kristen','3'=>'Katholik','4'=>'Hindu','5'=>'Budha','6'=>'Khong Hucu','7'=>'Penghayat Kepercayaan ','8'=>'Lainnya'];
		return $data;
	}

	public function status()
	{
		return ['1'=>'Belum Kawin','2'=>'Kawin','3'=>'Cerai Hidup','4'=>'Cerai Mati'];
	}

	public function shdk()
	{
		$data = [
			'1'=>'Kepala Keluarga',
			'2'=>'Suami',
			'3'=>'Isteri',
			'4'=>'Anak',
			'5'=>'Menantu',
			'6'=>'Cucu',
			'7'=>'Orang Tua',
			'8'=>'Mertua',
			'9'=>'Famili Lain',
			'10'=>'Pembantu',
			'11'=>'Lainnya'
		];
		return $data;
	}

	public function cacat()
	{
		$data = [
			 '1'=>'Cacat Fisik',
			 '2'=>'Cacat Netra/Buta',
			 '3'=>'Cacat Rungu/Wicara',
			 '4'=>'Cacat Mental/Jiwa',
			 '5'=>'Cacat Fisik dan Mental',
			 '6'=>'Cacat lainnya'
		];
		return $data;
	}
}