<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->library('esg');
		$this->notification();
	}

	public function notification()
	{
		$data = array();
		$user = $this->esg->get_esg('user');
		if(!empty($user))
		{
			$data['list'] = $this->db->query('SELECT * FROM notification WHERE status = 0 AND user_id = ? LIMIT 10',$user['id'])->result_array();
			$data['total'] = $this->db->query('SELECT id FROM notification WHERE status = 0 AND user_id = ?',$user['id'])->num_rows();
			$this->esg->set_esg('notification', $data);
		}
	}
}