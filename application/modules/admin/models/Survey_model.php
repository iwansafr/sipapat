<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model
{
	public function get_survey($name='')
	{
		if(!empty(@($name)))
		{
			$data = $this->db->get_where('config',['name'=>$name])->row_array();
			if(!empty($data))
			{
				$data = $data['value'];
				$data = json_decode($data,1);
			}

			pr($data);
		}
	}
}