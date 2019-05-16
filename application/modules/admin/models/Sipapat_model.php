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
}