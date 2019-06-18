<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
	}
	public function index()
	{
		$data = $this->esg->get_config('pengumuman');
		output_json($data);
	}
}