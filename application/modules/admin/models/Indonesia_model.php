<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Indonesia_model extends CI_Model{

	public function get_province_by_id($id = 0)
	{
		return $this->db->get_where('provinces',['id'=>$id])->row_array();
	}
	public function get_regency_by_id($id = 0)
	{
		return $this->db->get_where('regencies',['id'=>$id])->row_array();
	}
	public function get_district_by_id($id = 0)
	{
		return $this->db->get_where('districts',['id'=>$id])->row_array();
	}
	public function get_village_by_id($id = 0)
	{
		return $this->db->get_where('villages',['id'=>$id])->row_array();
	}
}