<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->library('esg');
		// $this->load->library('ZEA/zea');
		// $this->sidebar_menu();
		$this->pesan();
	}
	public function pesan()
	{
		$data = array();
		$user = $this->esg->get_esg('user');
		$data['list'] = $this->db->query('SELECT pesan_status.*,pesan.title AS subject,user.username AS name,pesan.created FROM pesan_status,pesan,user WHERE pesan.id=pesan_status.pesan_id AND pesan_status.sender=user.id AND status = 0 AND pesan_status.recipient = ?  LIMIT 10', @$user['id'])->result_array();
		$data['total'] = $this->db->query('SELECT id FROM pesan_status WHERE status = 0 AND recipient = ? ', @$user['id'])->num_rows();
		$this->esg->set_esg('pesan', $data);
	}
	public function get_recipient($id = 0)
	{
		$user = $this->esg->get_esg('user');
		$data = array();
		if(!empty($id))
		{
			$data = $this->db->query('SELECT * FROM user WHERE id = ? ', $id)->row_array();
		}else{
			$data = $this->db->query('SELECT id,username FROM user WHERE active = 1 AND user_role_id > 1 AND id != ? ', @intval($user['id']))->result_array();
			$data = assoc($data,'id','username');
		}
		return $data;
	}
	public function get_pesan_id($status_id = 0)
	{
		if(!empty($status_id))
		{
			$data = $this->db->query('SELECT pesan_id FROM pesan_status WHERE id = ?', $status_id)->row_array();
			return $data['pesan_id'];
		}
	}
	public function get_pesan($id = 0)
	{
		$user = $this->esg->get_esg('user');
		$data = array();
		if(!empty($id) && is_numeric($id))
		{
			$data['pesan'] = $this->db->get_where('pesan', ['id'=>$id])->row_array();
			if(!empty($data['pesan']))
			{
				$this->db->select('username');
				$data['sender'] = $this->db->get_where('user',['id'=>$data['pesan']['sender']])->row_array();
				$data['sender'] = $data['sender']['username'];
				$data['recipient'] = $this->db->get_where('user',['id'=>$data['pesan']['recipient']])->row_array();
				$data['recipient'] = $data['recipient']['username'];
			}
			if($data['sender'] == $user['username'])
			{
				$data['status'] = $this->db->query('SELECT user.id,user.username,pesan_status.status FROM pesan_status,pesan,user WHERE pesan_status.recipient=user.id AND pesan.id=pesan_status.pesan_id AND pesan_id = ?', $id)->result_array();
			}
			$data['query'] = $this->db->last_query();
		}
		return $data;
	}
	public function save()
	{
		if(!empty($_POST))
		{
			$last_id = $this->zea->get_insert_id();
			$user = $this->esg->get_esg('user');
			if($_POST['recipient']==0)
			{
				$recipient = $this->get_recipient();
				if(!empty($recipient))
				{
					$tmp_data = array();
					$i = 0;
					foreach ($recipient as $key => $value) 
					{
						$tmp_data[$i]['recipient'] = $key;
						$tmp_data[$i]['sender']    = $user['id'];
						$tmp_data[$i]['pesan_id']  = $last_id;
						$i++;
					}
					if($this->db->insert_batch('pesan_status', $tmp_data))
					{
						return ['msg'=>'pesan berhasil terkirim','alert'=>'success'];
					}else{
						return ['msg'=>'pesan gagal terkirim','alert'=>'danger'];
					}
				}
			}else{
				$this->db->insert('pesan_status', ['recipient'=>@intval($_POST['recipient']),'sender'=>@intval($user['id']),'pesan_id'=>$last_id]);
			}
		}
	}
}