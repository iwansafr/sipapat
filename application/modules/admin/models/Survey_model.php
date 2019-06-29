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

			return $data;
		}
	}
	public function save()
	{
		if(!empty($_POST))
		{
			if($this->db->insert('survey_laptop', $_POST))
			{
				return true;
			}else{
				return false;
			}
		}
	}
}