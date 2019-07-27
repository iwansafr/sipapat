<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posyantekdes_model extends CI_Model{

	public function get_posyantekdes_id($desa_id = 0)
	{
		if(!empty($desa_id))
		{
			$this->db->select('id');
			return $this->db->get_where('posyantekdes',['desa_id'=>$desa_id])->row_array()['id'];
		}
	}

	public function get_posyantekdes($id = 0)
	{
		if(!empty($id))
		{
			return $this->db->get_where('posyantekdes',['id'=>$id])->row_array();
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