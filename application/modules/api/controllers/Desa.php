<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller
{
	public function index()
	{
		$data = $this->db->get('desa')->result_array();
		output_json($data);
	}
}