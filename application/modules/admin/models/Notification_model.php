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
		$data['list'] = $this->db->query('SELECT * FROM notification WHERE status = 0 LIMIT 10')->result_array();
		$data['total'] = $this->db->query('SELECT id FROM notification WHERE status = 0')->num_rows();
		$this->esg->set_esg('notification', $data);
	}
}