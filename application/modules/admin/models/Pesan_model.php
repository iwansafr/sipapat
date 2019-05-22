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

	public function bc_recipient()
	{
		$user = $this->esg->get_esg('user');
		$data = array();
		if(is_kecamatan())
		{
			$kecamatan = strtolower(str_replace('kec_','',$user['username']));
			$data[$user['id'].'|'.$kecamatan] = 'Semua Desa di '.$kecamatan;
		}else if(is_desa())
		{
			
		}else{
			$tmp_data = $this->db->query("SELECT id,username FROM user WHERE username LIKE 'kec_%'")->result_array();
			if(!empty($tmp_data))
			{
				if(is_admin() || is_root())
				{
					$data['ad'] = 'SEMUA DESA';
					$data['ak'] = 'SEMUA KECAMATAN';
				}
				foreach ($tmp_data as $key => $value) 
				{
					$username = strtolower(str_replace('kec_','',$value['username']));
					$data[$value['id'].'|'.$username] = 'desa di kecamatan '.$username;
				}
			}
		}
		return $data;
	}

	public function sg_recipient()
	{
		$user = $this->esg->get_esg('user');
		$data = array();
		if(is_kecamatan())
		{
			$kecamatan = strtolower(str_replace('kec_','',$user['username']));
			$data = $this->db->query('SELECT user_desa.user_id AS id,user_desa.username FROM desa,user_desa where desa.id=user_desa.desa_id AND desa.kecamatan = ?', $kecamatan)->result_array();
			$admin_data = $this->db->query('SELECT id,username FROM user WHERE user_role_id = ?', 2)->result_array();
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
			$tmp_data = array();
			foreach ($data as $key => $value) 
			{
				$tmp_data[$key]['username'] = $value['username'];
				$tmp_data[$key]['id'] = $value['id'].'|'.$value['username'];
			}
			$data = $tmp_data;
			if(!empty($admin_data))
			{
				$tmp_admin_data = array();
				foreach ($admin_data as $key => $value) 
				{
					$tmp_admin_data[$key]['username'] = $value['username'].'(admin)';
					$tmp_admin_data[$key]['id'] = $value['id'].'|'.$value['username'].'(admin)';
				}
				$data = array_merge($tmp_admin_data,$data);
			}
			$data = assoc($data,'id','username');
		}
		return $data;
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
				$data = $this->db->query('SELECT user_desa.user_id AS id,user_desa.username FROM desa,user_desa where desa.id=user_desa.desa_id AND desa.kecamatan = ?', $kecamatan)->result_array();
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
		$ids = array();
		foreach ($data as $key => $value) 
		{
			if($value['recipient']>0)
			{
				$ids[$value['recipient']] = $value['recipient'];
			}else if($value['recipient']<0)
			{
				$ids[$value['recipient']] = $value['recipient'];
			}
			$ids[$value['recipient']] = $value['recipient'];
		}
		$username_desa = array();
		foreach ($ids as $key => $value) 
		{
			if($value>0)
			{
				$q = $this->db->query('SELECT username FROM user WHERE id = ?', $value)->row_array();
				$q = $q['username'];
				$username_desa[$value] = $q;
			}else if($value<0)
			{
				$b = $value-$value;
				$value = $b-$value;
				$q = $this->db->query('SELECT username FROM user WHERE id = ?', $value)->row_array();
				$q = $q['username'];
				$username_desa[$value] = 'Desa di kecamatan'.$q;
			}else if($value == 0)
			{
				$username_desa[$value] = 'Semua Desa';
			}
		}
		$q = array();
		foreach ($data as $key => $value) 
		{
			$c = $value['recipient'];
			if($value['recipient']<0)
			{
				$b = $value['recipient']-$value['recipient'];
				$c = $b-$value['recipient'];
				$kelompok = 4;
			}else if($value['recipient'] == 0)
			{
				$kelompok = 2;
			}else if($value['recipient'] > 0)
			{
				$kelompok = 1;
			}else{
				$kelompok = 5;
			}
			$recipient = !empty($username_desa[$c]) ? $username_desa[$c] : 'Akun di hapus';
			$q[] = ['id'=>$value['id'],'recipient'=>$recipient,'kelompok'=>$kelompok];
		}
		if(!empty($q))
		{
			$this->db->update_batch('pesan', $q,'id');
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
			// $data['prev'] = $this->db->query('SELECT id FROM pesan_status WHERE pesan_id > ? AND recipient = ? ORDER BY id ASC', [$id, $user['id']])->row_array();
			// $data['prev'] = !empty($data['prev']) ? base_url('admin/pesan/detail/'.$data['prev']['id']) : '';
			// $data['next'] = $this->db->query('SELECT id FROM pesan_status WHERE pesan_id < ? AND recipient = ? ORDER BY id DESC', [$id, $user['id']])->row_array();
			// $data['next'] = !empty($data['next']) ? base_url('admin/pesan/detail/'.$data['next']['id']) : '';
			if(!empty($data['pesan']))
			{
				$this->db->select('username');
				$data['sender'] = $this->db->get_where('user',['id'=>$data['pesan']['sender']])->row_array();
				$data['sender'] = $data['sender']['username'];
				$data['recipient'] = $data['pesan']['recipient'];
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
			if(!empty($last_id))
			{
				$data = $this->db->get_where('pesan',['id'=>$last_id])->row_array();
				$kelompok = 0;
				if($data['type']==1)
				{
					$kelompok = 1;
					$recipient = $data['recipient'];
					$recipient = explode('|',$recipient);
					$this->db->insert('pesan_status', ['recipient'=>@intval($recipient[0]),'sender'=>@intval($user['id']),'pesan_id'=>$last_id]);
					$this->db->update('pesan',['recipient'=>$recipient[1],'kelompok'=>$kelompok],['id'=>$last_id]);
				}else if($data['type'] == 0)
				{
					$recipient = $data['recipient'];
					$new_recipient = '';
					if($recipient=='ad')
					{
						$kelompok = 2;
						$new_recipient = 'Semua Desa';
						$recipient = $this->db->query('SELECT id FROM user WHERE active = 1 AND user_role_id = 3 AND id != ? ', @intval($user['id']))->result_array();
					}else if($recipient=='ak')
					{
						$kelompok = 4;
						$new_recipient = 'Semua Kecamatan';
						$recipient = $this->db->query("SELECT id FROM user WHERE username LIKE 'kec_%'")->result_array();
					}else{
						$kelompok = 5;
						$recipient = explode('|',$recipient);
						if(!empty($recipient[1]))
						{
							$kecamatan = $recipient[1];
							$new_recipient = 'Desa di Kecamatan '.$kecamatan;
							$user_ids = $this->db->query('SELECT user.id FROM user,user_desa,desa WHERE user_desa.desa_id = desa.id AND user.id=user_desa.user_id AND desa.kecamatan = ?',$kecamatan)->result_array();
							if(!empty($user_ids))
							{
								$recipient = $user_ids;
							}
						}
					}
					if(!empty($recipient))
					{
						// $recipient = assoc($recipient,'id','username');
						$tmp_data = array();
						$i = 0;
						foreach ($recipient as $key => $value) 
						{
							$tmp_data[$i]['recipient'] = $value['id'];
							$tmp_data[$i]['sender']    = $user['id'];
							$tmp_data[$i]['pesan_id']  = $last_id;
							$i++;
						}
						if($this->db->insert_batch('pesan_status', $tmp_data))
						{
							$this->db->update('pesan',['recipient'=>$new_recipient,'kelompok'=>$kelompok],['id'=>$last_id]);
							return ['msg'=>'pesan berhasil terkirim','alert'=>'success'];
						}else{
							return ['msg'=>'pesan gagal terkirim','alert'=>'danger'];
						}
					}
				}
			}
		}
	}
	public function old_save()
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