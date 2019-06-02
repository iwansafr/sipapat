<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sipapat_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function set_meta($data = array())
	{
		if(empty($data) || !is_array($data))
		{
			$data = array(
						'title' => 'sipapat',
						'keyword' => 'software development',
						'description' => 'PT media nusa perkasa',
						'developer' => 'esoftgreat',
						'author' => 'esoftgreat',
						'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
						'phone' => '6285640510460',
						'icon' => base_url('images/icon.png'),
					);
		}
		$this->esg->set_esg('meta', $data);
	}

	public function get_pengumuman($name = '')
  {
		$data = array();
		if(!empty($name))
		{
			$value = $this->db->query('SELECT value FROM pengumuman WHERE name = ?', 'kec_'.$name)->row_array();
			if(!empty($value))
			{
				$data = json_decode($value['value'], 1);
			}
		}
		return $data;
	}
	public function get_desa($id = 0)
	{
		if(!empty($id) && is_numeric($id))
		{
			return $this->db->get_where('desa', ['id'=>$id])->row_array();
		}
	}

	public function get_image_kab()
	{
		$data = $this->db->query('SELECT id,image FROM user WHERE user_role_id = 2')->row_array();
		if(!empty($data))
		{
			$image = $data['image'];
			$id = $data['id'];
			return image_module('user', $id.'/'.$image);
		}
	}

	public function perangkat_alert()
	{
		$user = $this->session->userdata(base_url().'_logged_in');
		if(is_desa())
		{
			$perangkat = $this->db->query('SELECT * FROM perangkat_desa WHERE user_id = ?', $user['id'])->result_array();
			if(!empty($perangkat))
			{
				$amj = array();
				foreach ($perangkat as $key => $value)
				{
					if(!empty($value['akhir_masa_jabatan']) && $value['akhir_masa_jabatan'] != '0000-00-00')
					{
						$alert_time = date('Y-m-d', strtotime($value['akhir_masa_jabatan'].' -3 month'));
						$current = date('Y-m-d');
						if($current>=$alert_time)
						{
							$amj[$value['id']]['amj'] = $value['akhir_masa_jabatan'];
							$amj[$value['id']]['kelompok'] = $value['kelompok'];
							$amj[$value['id']]['jabatan'] = $value['jabatan'];
							$amj[$value['id']]['nama'] = $value['nama'];
							if($value['kelompok'] == 6 || $value['kelompok'] == 7)
							{
								$amj[$value['id']]['rt'] = $value['rt'];
								$amj[$value['id']]['rw'] = $value['rw'];
							}
							$amj[$value['id']]['jabatan'] = $this->get_jabatan($value['kelompok'], $value['jabatan']);
						}
					}
				}
				return $amj;
			}
		}else if(is_kecamatan())
		{
			$kecamatan_name = strtoupper(str_replace('kec_', '', $user['username']));
			$desa_ids = $this->db->query('SELECT id,nama FROM desa WHERE kecamatan = ?', $kecamatan_name)->result_array();
			if(!empty($desa_ids))
			{
				$amj = array();
				foreach ($desa_ids as $desa_ids_key => $desa_ids_value) 
				{
					$perangkat = $this->db->query('SELECT * FROM perangkat_desa WHERE desa_id = ?', $desa_ids_value['id'])->result_array();
					if(!empty($perangkat))
					{
						foreach ($perangkat as $key => $value)
						{
							if(!empty($value['akhir_masa_jabatan']) && $value['akhir_masa_jabatan'] != '0000-00-00')
							{
								$alert_time = date('Y-m-d', strtotime($value['akhir_masa_jabatan'].' -3 month'));
								$current = date('Y-m-d');
								if($current>=$alert_time)
								{
									$amj[$value['id']]['amj'] = $value['akhir_masa_jabatan'];
									$amj[$value['id']]['kelompok'] = $value['kelompok'];
									$amj[$value['id']]['nama'] = $value['nama'];
									$amj[$value['id']]['desa'] = $desa_ids_value['nama'];
									if($value['kelompok'] == 6 || $value['kelompok'] == 7)
									{
										$amj[$value['id']]['rt'] = $value['rt'];
										$amj[$value['id']]['rw'] = $value['rw'];
									}
									$amj[$value['id']]['jabatan'] = $this->get_jabatan($value['kelompok'], $value['jabatan']);
								}
							}
						}
					}
				}
				return $amj;
			}
		}

	}

	public function get_jabatan($kelompok_id = 0 , $jabatan_id = 0)
	{
		if(!empty($kelompok_id))
		{
			$this->load->model('pengguna_model');
			$kelompok = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd'];
			$jabatan = $this->pengguna_model->jabatan();
			return ['kelompok'=>$kelompok[$kelompok_id], 'jabatan'=>$jabatan[$kelompok_id][$jabatan_id]];
		}
	}

	public function kepdes_alert()
	{
		$user = $this->session->userdata(base_url().'_logged_in');
		if(!empty($user))
		{
			$data = $this->db->query('SELECT * FROM perangkat_desa WHERE user_id = ? AND kelompok = 1 AND jabatan = 1 LIMIT 1', $user['id'])->row_array();
			$akhir_masa_jabatan = @$data['akhir_masa_jabatan'];
			if(!empty($akhir_masa_jabatan) && $akhir_masa_jabatan != '0000-00-00')
			{
				$alert_time = date('Y-m-d', strtotime($akhir_masa_jabatan.' -3 month'));
				$current = date('Y-m-d');
				if($current>=$alert_time)
				{
					return ['msg'=>'masa jabatan kepala desa '.$data['nama'].' akan berakhir pada tanggal '.$data['akhir_masa_jabatan'],'alert'=>'danger'];
				}
			}
		}
	}
}