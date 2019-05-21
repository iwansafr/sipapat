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
	public function search_user_id($type = 'recipient')
	{
		if(!empty(@($_GET['keyword'])))
		{
			$keyword = $_GET['keyword'];
			$id = $this->db->query('SELECT id fROM user WHERE username = ? ', $keyword)->row_array();
			$id = !empty($id) ? ' OR pesan_status.'.$type.' = '.$id['id'] : '';
			return $id;
		}
	}
	public function pesan()
	{
		$data = array();
		$user = $this->esg->get_esg('user');
		$data['list'] = $this->db->query('SELECT pesan_status.*,pesan.title AS subject,user.username AS name,pesan.created FROM pesan_status,pesan,user WHERE pesan.id=pesan_status.pesan_id AND pesan_status.sender=user.id AND status = 0 AND pesan_status.recipient = ?  LIMIT 10', @$user['id'])->result_array();
		$data['total'] = $this->db->query('SELECT id FROM pesan_status WHERE status = 0 AND recipient = ? ', @$user['id'])->num_rows();
		$this->esg->set_esg('pesan', $data);
	}

	public function get_kecamatan_user()
	{
		$data = $this->db->query("SELECT id,username FROM user WHERE username LIKE 'kec_%'")->result_array();
		if(!empty($data))
		{
			$tmp_data = array();
			if(is_admin())
			{
				$tmp_data['0'] = 'SEMUA DESA';
			}
			foreach ($data as $key => $value) 
			{
				$tmp_data['-'.$value['id']] = 'desa di kecamatan '.strtolower(str_replace('kec_','',$value['username']));
			}

			return $tmp_data;
		}
	}

	public function get_recipient($id = 0)
	{
		$user = $this->esg->get_esg('user');
		$data = array();
		if(!empty($id))
		{
			$data = $this->db->query('SELECT * FROM user WHERE id = ? ', $id)->row_array();
		}else{
			if(is_kecamatan())
			{
				$kecamatan = strtolower(str_replace('kec_','',$user['username']));
				$data = $this->db->query('SELECT user_desa.user_id AS id,user_desa.username FROM desa,user_desa where desa.id=user_desa.desa_id AND desa.kecamatan = ?', $kecamatan)->result_array();;
			}else if(is_desa())
			{
				$kecamatan = $this->db->query('SELECT kecamatan FROM desa,user_desa WHERE user_desa.desa_id=desa.id AND user_desa.user_id = ?', $user['id'])->row_array();
				$kecamatan = 'kec_'.$kecamatan['kecamatan'];
				$data = $this->db->query('SELECT user.id,user.username FROM user,user_role WHERE user.user_role_id = user_role.id AND (user_role.level=2 OR username = ?)',$kecamatan)->result_array();
			}else{
				$data = $this->db->query('SELECT id,username FROM user WHERE active = 1 AND user_role_id > 1 AND id != ? ', @intval($user['id']))->result_array();
			}
			if(!empty($data))
			{
				$data = assoc($data,'id','username');
			}
		}
		return $data;
	}

	public function repair()
	{
		$this->db->select('id');
		$this->db->select('recipient');
		$data = $this->db->get('pesan')->result_array();
		$q = array();
		foreach ($data as $key => $value) 
		{
			if($value['recipient'] == 0)
			{
				// $this->db->update('pesan',['recipient'=>'Semua Desa','kelompok'=>2], ['id'=>$value['id']]);
				$q[] = "UPDATE pesan SET recipient = 'Semua Desa', kelompok = 2 WHERE id = {$value['id']};";
			}
			if($value['recipient']>0)
			{
				$q[] = "UPDATE pesan SET recipient = 'Semua Desa', kelompok = 2 WHERE id = {$value['id']};";
			}
		}
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
			$data['prev'] = $this->db->query('SELECT id FROM pesan_status WHERE pesan_id > ? AND recipient = ? ORDER BY id ASC', [$id, $user['id']])->row_array();
			$data['prev'] = !empty($data['prev']) ? base_url('admin/pesan/detail/'.$data['prev']['id']) : '';
			$data['next'] = $this->db->query('SELECT id FROM pesan_status WHERE pesan_id < ? AND recipient = ? ORDER BY id DESC', [$id, $user['id']])->row_array();
			$data['next'] = !empty($data['next']) ? base_url('admin/pesan/detail/'.$data['next']['id']) : '';
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
			if($_POST['recipient'] == 0 && $user['level'] == 5)
			{
				$this->db->delete('pesan','id='.$last_id);
				$script = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-ban'></i> Alert!</h4>Penerima tidak valid, pesan anda otomatis tidak akan terkirim dan otomatis terhapus.</div>";
				$this->esg->add_script
				(
					'	$(document).ready(function(){
							$(".content").prepend("'.$script.'");
							$(".alert-success").remove();
						});
					'
				);
			}else{
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
				}else if($_POST['recipient'] < 0){
					$user_id = @intval(str_replace('-','',$_POST['recipient']));
					$username = $this->db->query('SELECT username FROM user WHERE id = ?', $user_id)->row_array();
					$username = @$username['username'];
					if(!empty($username))
					{
						$kecamatan = strtolower(str_replace('kec_', '', $username));
						$user_ids = $this->db->query('SELECT user.id FROM user,user_desa,desa WHERE user_desa.desa_id = desa.id AND user.id=user_desa.user_id AND desa.kecamatan = ?',$kecamatan)->result_array();
						if(!empty($user_ids))
						{
							$tmp_data = array();
							$i = 0;
							foreach ($user_ids as $key => $value) 
							{
								$tmp_data[$i]['recipient'] = $value['id'];
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
					}
				}else{
					$this->db->insert('pesan_status', ['recipient'=>@intval($_POST['recipient']),'sender'=>@intval($user['id']),'pesan_id'=>$last_id]);
				}
			}
		}
	}
}