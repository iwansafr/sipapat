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
		
		$data['data_laptop'] = [];
		$data['data_laptop']['sudah'] = $this->db->query('SELECT desa FROM survey_laptop WHERE laptop = 1')->result_array();
		$data['data_laptop']['belum'] = $this->db->query('SELECT desa FROM survey_laptop WHERE laptop = 0')->result_array();
		$data['laptop'] = count($data['data_laptop']['sudah']);

		$data['data_wifi'] = [];
		$data['data_wifi']['sudah'] = $this->db->query('SELECT desa FROM survey_laptop WHERE wifi = 1')->result_array();
		$data['data_wifi']['belum'] = $this->db->query('SELECT desa FROM survey_laptop WHERE wifi = 0')->result_array();
		$data['wifi'] = count($data['data_wifi']['sudah']);

		$data['data_honor'] = [];
		$data['data_honor']['sudah'] = $this->db->query('SELECT desa FROM survey_laptop WHERE honor = 1')->result_array();
		$data['data_honor']['belum'] = $this->db->query('SELECT desa FROM survey_laptop WHERE honor = 0')->result_array();
		$data['honor'] = count($data['data_honor']['sudah']);


		$data['isi_survey'] = [];
		$data['isi_survey']['sudah'] = $this->db->query('SELECT desa FROM survey_laptop')->result_array();
		$isi_survey_sudah = [];
		foreach ($data['isi_survey']['sudah'] as $is_key => $is_value) {
			$isi_survey_sudah[] = $is_value['desa'];
		}
		$data['isi_survey']['sudah'] = $isi_survey_sudah;
		$data['isi_survey']['desa_sudah'] = count($data['isi_survey']['sudah']);
		$desa = $this->db->query('SELECT nama FROM desa')->result_array();
		foreach($desa AS $ds_key => $ds_value)
		{
			if(!in_array($ds_value['nama'], $data['isi_survey']['sudah'])){
				$data['isi_survey']['belum'][] = $ds_value['nama'];
			}
		}

		$data['isi_survey']['desa_belum'] = count($data['isi_survey']['belum']);
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