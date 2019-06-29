<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sipapat_model');
	}

	public function get_chart()
	{
		$kec = !empty($_GET['kec']) ? @$_GET['kec'] : '';
		$data = [];
		$data['laptop'] = @$this->db->query('SELECT count(id) AS total FROM survey_laptop WHERE laptop = 1')->row_array()['total'];
		$data['wifi'] = @$this->db->query('SELECT count(id) AS total FROM survey_laptop WHERE wifi = 1')->row_array()['total'];
		$data['honor'] = @$this->db->query('SELECT count(id) AS total FROM survey_laptop WHERE honor = 1')->row_array()['total'];
		return $data;
	}

	public function save()
	{
		$user_id = @intval($_SESSION[base_url().'_logged_in']['id']);
		if(!empty($_POST))
		{
			$data = $this->get_survey();
			$desa = $this->getDesa();
			$new = false;
			$id = @intval($data['id']);
			if(empty($data))
			{
				$new = true;
			}
			$data              = $_POST;
			$data['user_id']   = $user_id;
			$data['desa']      = @$desa['nama'];
			$data['kecamatan'] = @$desa['kecamatan'];
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

	public function getDesa()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		if(!empty($desa_id))
		{
			$data = $this->sipapat_model->get_desa($desa_id);
			if(!empty($data))
			{
				return $data;
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