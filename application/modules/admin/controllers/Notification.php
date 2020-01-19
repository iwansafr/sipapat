<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('notification_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function clear_list()
	{
		$this->load->view('message/index');
	}
	public function detail($id = 0)
	{
		if(!empty($id))
		{
			$data['id'] = $id;
			$this->zea->set_data('notification', $id, ['status'=>1]);
			$this->notification_model->notification();
			$this->load->view('index', $data);
		}
	}
}