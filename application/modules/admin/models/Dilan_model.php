<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan_model extends CI_Model
{
	public function upload($file = '')
	{
		if(!empty($file['tmp_name']))
		{
			$dir = FCPATH.'images/modules/dilan/';
			if(!is_dir($dir))
			{
				mkdir($dir, 0777);
			}
			if(copy($file['tmp_name'] , $dir.$_SESSION[base_url().'_logged_in']['username'].'.xlsx'))
			{
				return $_SESSION[base_url().'_logged_in']['username'].'.xlsx';
			}
		}
	}
	public function get_penduduk($id = 0)
	{
		return $this->db->get_where('penduduk',['id'=>$id])->row_array();
	}
}