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
	public function get_desa_by_district()
	{
		$id = $this->session->userdata(base_url().'_logged_in')['id'];
		$data = [];
		$data['user'] = $this->db->get_where('user_desa',['user_id'=>$id])->row_array();

		if(!empty($data['user']['district_id']))
		{
			$data['desa'] = $this->db->get_where('desa',['district_id'=>$data['user']['district_id']])->result_array();
		}else{
			$data['desa'] = $this->db->get_where('desa',['kecamatan'=>str_replace('kec_','',$data['user']['username'])])->result_array();
		}
		return $data;
	}

	public function get_district_id()
	{
		$id = $this->session->userdata(base_url().'_logged_in')['id'];
		$data = $this->db->get_where('user_desa',['user_id'=>$id])->row_array();

		$district_id = 0;
		if(!empty($data['district_id']))
		{
			$district_id = $data['district_id'];
		}
		return $district_id;
	}
}