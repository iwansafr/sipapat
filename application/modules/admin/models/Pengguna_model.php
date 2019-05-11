<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_desa()
	{
		$this->db->select('id');
		$this->db->select('nama');
		return $this->db->get('desa')->result_array();
	}

	public function get_pengguna($id = 0)
	{
		if(empty($id))
		{
			$user_id = $this->session->userdata(base_url().'_logged_in')['id'];
		}else{
			$user_id = $id;
		}
		$pengguna = $this->db->get_where('user_desa', ['user_id'=>$user_id])->row_array();
		return $pengguna;		
	}

	public function jabatan()
	{
		$data = 
		[
			'1' => 	[
								'1'=>strtoupper('kepala desa'),
								'2'=>strtoupper('sekretaris desa'),
								'3'=>strtoupper('kepala dusun 1'),
								'4'=>strtoupper('kepala dusun ii'),
								'5'=>strtoupper('kepala dusun iii'),
								'6'=>strtoupper('kepala dusun iv'),
								'7'=>strtoupper('kepala dusun v'),
								'8'=>strtoupper('kaur administrasi dan umum'),
								'9'=>strtoupper('kaur keuangan'),
								'10'=>strtoupper('kasi pemerintahan'),
								'11'=>strtoupper('kasi pembangunan'),
								'12'=>strtoupper('kasi kesra'),
								'13'=>strtoupper('staf kaur keuangan'),
								'14'=>strtoupper('staf kasi pemerintahan'),
								'15'=>strtoupper('staf kasi pembangunan'),
								'16'=>strtoupper('staf kasi kesra'),
								'17'=>strtoupper('kader desa')
							],
			'2' =>  [
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('wakil ketua'),
								'3'=>strtoupper('sekretaris'),
								'4'=>strtoupper('anggota')
							],
			'3' =>  [
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('seksi agama'),
								'3'=>strtoupper('seksi pemuda'),
								'4'=>strtoupper('anggota')
							],
			'4' =>  [
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('sekretaris i'),
								'3'=>strtoupper('sekretaris ii'),
								'4'=>strtoupper('bendahara i'),
								'5'=>strtoupper('bendahara ii'),
								'6'=>strtoupper('pokja i'),
								'7'=>strtoupper('pokja ii')
								'8'=>strtoupper('pokja iii')
								'9'=>strtoupper('pokja iv')
							],
			'5' => 	[
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('wakil ketua'),
								'3'=>strtoupper('sekretaris i'),
								'4'=>strtoupper('sekretaris ii'),
								'5'=>strtoupper('bendahara i'),
								'6'=>strtoupper('bendahara ii'),
								'7'=>strtoupper('anggota')
							]
		];
		return $data;
	}

	public function save()
	{
		$last_id = $this->zea->get_insert_id();
		$id = $this->input->get('id');
		if(!empty($last_id) || !empty($id))
		{
		  $last_id = !empty($id) ? $id : $last_id;
		  if(!empty($_POST))
		  {
	    	if((!empty($last_id)))
	    	{
	    		$pengguna_user = array(
	    			'username'     => @$_POST['username'],
	    			'password'     => encrypt(@$_POST['sandi']),
	    			'email'        => @$_POST['email'],
	    			'user_role_id' => $_POST['user_role_id'],
	    			'active'       => @intval($_POST['active']),
	    		);
	    		$this->zea->set_data('user', @intval($_POST['user_id']), $pengguna_user);
	    		if(empty($id))
	    		{
	    			$user_last_id = $this->zea->get_insert_id();
	    			$this->zea->set_data('user_desa', $last_id, ['user_id'=>$user_last_id]);
	    		}
	    		// header('location : '.base_url('home/prala/account_information/?u='.$str.'&p='.$pwd));
	    		// redirect('home/prala/account_information/?u='.urlencode($str).'&p='.urlencode($pwd));
		    }
		  }
		}
	}
	public function delete()
	{
		if(!empty($_POST['del_row']))
		{
			$q = 'SELECT user_id FROM user_desa WHERE ';
			$i = 0;
			foreach ($_POST['del_row'] as $key => $value) 
			{
				if($i>0)
				{
					$q .= ' OR id = ? ';
				}else{
					$q .= ' id = ? ';
				}
				$i++; 
			}
			$user_ids_tmp = $this->db->query($q, $_POST['del_row'])->result_array();
			$user_ids = array();
			foreach ($user_ids_tmp as $key => $value) 
			{
				$user_ids[] = $value['user_id'];
			}
			$this->zea->del_data('user', $user_ids);
		}
	}
}