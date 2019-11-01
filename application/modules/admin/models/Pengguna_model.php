<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_desa($kec = '')
	{
		$this->db->select('id');
		$this->db->select('nama');
		if(is_kecamatan())
		{
			$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
			$this->db->where("kecamatan = '{$kecamatan}'");
		}
		if(!empty($kec))
		{
			$this->db->where("kecamatan = '{$kec}'");
		}
		return $this->db->get('desa')->result_array();
	}

	public function get_kecamatan()
	{
		$q = "SELECT id,username AS nama FROM user WHERE username LIKE 'kec_%'";
		if(is_kecamatan())
		{
			$kecamatan = strtoupper(str_replace('kec_','', $this->session->userdata(base_url().'_logged_in')['username']));
			$q = "SELECT id,username AS nama FROM user WHERE username = {$kecamatan}";
		}
		return $this->db->query($q)->result_array();
	}

	public function get_pengguna($id = 0)
	{
		if(empty($id))
		{
			if(!empty($this->session->userdata(base_url().'_logged_in')['id']))
			{
				$user_id = $this->session->userdata(base_url().'_logged_in')['id'];
			}else{
				$user_id = $_SESSION[base_url().'_logged_in']['id'];
			}
		}else{
			$user_id = $id;
		}
		$pengguna = $this->db->get_where('user_desa', ['user_id'=>$user_id])->row_array();
		return $pengguna;		
	}

	public function agama()
	{
		return [
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
	}

	public function jabatan()
	{
		// 1=perangkat desa, 2=bpd,3=lpmp,4=pkk,5=karang taruna,6=rt,7=rw,8=kpmd,9=linmas
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
								'18'=>strtoupper('staf kaur administrasi dan umum'),
								'20'=>strtoupper('staf administrasi dan umum'),
								'9'=>strtoupper('kaur keuangan'),
								'10'=>strtoupper('kasi pemerintahan'),
								'11'=>strtoupper('kasi pembangunan'),
								'12'=>strtoupper('kasi kesra'),
								'13'=>strtoupper('staf kaur keuangan'),
								'14'=>strtoupper('staf kasi pemerintahan'),
								'15'=>strtoupper('staf kasi pembangunan'),
								'16'=>strtoupper('staf kasi kesra'),
								'19'=>strtoupper('staf kadus'),
								'17'=>strtoupper('kader desa'),
							],
			'2' =>  [
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('wakil ketua'),
								'3'=>strtoupper('sekretaris'),
								'4'=>strtoupper('anggota')
							],
			'3' =>  [
								'1'=>strtoupper('ketua'),
								'15'=>strtoupper('wakil ketua'),
								'5'=>strtoupper('sekretaris i'),
								'6'=>strtoupper('sekretaris ii'),
								'7'=>strtoupper('bendahara i'),
								'8'=>strtoupper('bendahara ii'),
								'2'=>strtoupper('seksi agama'),
								'3'=>strtoupper('seksi pemuda'),
								'9'=>strtoupper('seksi keamanan & ketertiban'),
								'10'=>strtoupper('pendidikan & penerangan'),
								'11'=>strtoupper('seksi lingkungan hidup'),
								'12'=>strtoupper('seksi pembangunan ekonomi & koperasi'),
								'13'=>strtoupper('seksi kesehatan & kependudukan'),
								'14'=>strtoupper('seksi kesejahteraan sosial'),
								'4'=>strtoupper('anggota')
							],
			'4' =>  [
								'1'=>strtoupper('ketua'),
								'11'=>strtoupper('wakil ketua'),
								'2'=>strtoupper('sekretaris i'),
								'3'=>strtoupper('sekretaris ii'),
								'4'=>strtoupper('bendahara i'),
								'5'=>strtoupper('bendahara ii'),
								'6'=>strtoupper('pokja i'),
								'7'=>strtoupper('pokja ii'),
								'8'=>strtoupper('pokja iii'),
								'9'=>strtoupper('pokja iv'),
								'10'=>strtoupper('pokja v')
							],
			'5' => 	[
								'1'=>strtoupper('ketua'),
								'2'=>strtoupper('wakil ketua'),
								'3'=>strtoupper('sekretaris i'),
								'4'=>strtoupper('sekretaris ii'),
								'5'=>strtoupper('bendahara i'),
								'6'=>strtoupper('bendahara ii'),
								'7'=>strtoupper('anggota'),
								'8'=>strtoupper('seksi pendidikan dan pelatihan'),
								'9'=>strtoupper('seksi usaha dan kesejahteraan sosial'),
								'10'=>strtoupper('seksi kelompok usaha bersama'),
								'11'=>strtoupper('seksi kerohanian dan pembinaan mental'),
								'12'=>strtoupper('seksi olah raga dan seni budaya'),
								'13'=>strtoupper('seksi lingkungan hidup'),
								'14'=>strtoupper('seksi hubungan masyarakat'),
								'15'=>strtoupper('seksi kerjasama kemitraan'),
							],
			'6' => ['Ketua Rt'],
			'7' => ['Ketua Rw'],
			'8' => ['KPMD'],
			'9' => ['LinMas'],
			// '10' => 
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