<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model
{
	public function save()
	{
		$user_id = @intval($_SESSION[base_url().'_logged_in']['id']);
		if(!empty($_POST))
		{
			$data = $this->get_survey();
			$new = false;
			$id = @intval($data['id']);
			if(empty($data))
			{
				$new = true;
			}
			$data = $_POST;
			$data['user_id'] = $user_id;
			if($new)
			{
				if($this->db->insert('survey_laptop', $data))
				{
					return true;
				}else{
					return false;
				}
			}else{
				if($this->db->update('survey_laptop', $data, ['id'=>$id]))
				{
					return true;
				}else{
					return false;
				}
			}
		}
	}
	public function get_survey($id = 0)
	{
		$data = array();
		if(empty($id))
		{
			$user_id = @intval($_SESSION[base_url().'_logged_in']['id']);
			$data = $this->db->get_where('survey_laptop',['user_id'=>$user_id])->row_array();
		}
		return $data;
	}
}