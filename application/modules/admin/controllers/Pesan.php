<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pesan_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function repair()
	{
		$this->pesan_model->repair();
	}

	public function masuk($id = 0)
	{
		$this->esg_model->set_nav_title('Pesan Masuk');
		$data['id'] = 0;
		if(!empty($id))
		{
			$data['id'] = @intval($id);
			$data['detail_pesan'] = $this->pesan_model->get_pesan($id);
		}
		$data['search_user_id'] = $this->pesan_model->search_user_id('sender');
		$this->load->view('index', $data);
	}
	public function keluar($id = 0)
	{
		$this->esg_model->set_nav_title('Pesan Terkirim');
		$data['id'] = 0;
		if(!empty($id))
		{
			$data['id'] = @intval($id);
			$data['detail_pesan'] = $this->pesan_model->get_pesan($id);
		}
		$data['search_user_id'] = $this->pesan_model->search_user_id('recipient');
		$this->load->view('index', $data);
	}
	public function edit($mode = '')
	{
		$this->esg_model->set_nav_title('Buat Pesan');
		if($mode == 'broadcast')
		{
			$data['type'] = 0;
			$data['recipient'] = $this->pesan_model->bc_recipient();
		}else if($mode == 'single')
		{
			$data['type'] = 1;
			$data['recipient'] = $this->pesan_model->sg_recipient();
		}
		// $data['recipient'] = $this->pesan_model->get_recipient();
		// if(is_admin() || is_root())
		// {
		// 	$data['kecamatan_user'] = $this->pesan_model->get_kecamatan_user();
		// }
		$this->load->view('index', $data);
	}
	public function clear_list($title = '')
	{
		$this->esg_model->set_nav_title('Pesan '.$title);
		$data = array();
		$data['id'] = 0;
		if(!empty($id))
		{
			$data['id'] = @intval($id);
			$data['detail_pesan'] = $this->pesan_model->get_pesan($id);
		}
		$data['search_user_id'] = $this->pesan_model->search_user_id('sender');
		$this->pesan_model->pesan();
		$data['pesan'] = $this->esg->get_esg('pesan');
		$this->load->view('pesan/'.$title, $data);
	}
	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Pesan');
		$data['id'] = 0;
		if(!empty($id))
		{
			$data['id'] = $id;
			$this->zea->set_data('pesan_status', $id, ['status'=>1]);
			$this->pesan_model->pesan();
			if(!empty($id))
			{
				$data['id'] = @intval($id);
				$id = $this->pesan_model->get_pesan_id($id);
				$data['detail_pesan'] = $this->pesan_model->get_pesan($id);
			}
			$this->load->view('index', $data);
		}
	}
}