<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blt_model extends CI_Model
{
	var $desa_id = 0;
	var $district_id = 0;
	var $regency_id = 0;
	public function set_desa_id($desa_id = 0)
	{
		$this->desa_id = $desa_id;
	}
	public function set_district_id($district_id = 0)
	{
		$this->district_id = $district_id;
	}
	public function set_regency_id($regency_id = 0)
	{
		$this->regency_id = $regency_id;
	}
	
}