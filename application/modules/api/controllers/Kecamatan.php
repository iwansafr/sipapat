<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
	public function index()
	{

	}
	public function by_regency_id($id = 0)
	{
		$output = ['success'=>0,'data'=>[]];
		if(!empty($id))
		{
			$data = $this->db->query('SELECT * FROM districts WHERE regency_id = ?',$id)->result_array();
			if(!empty($data))
			{
				$output = ['success'=>1,'data'=>$data];
			}
		}
		output_json($output);
	}
}