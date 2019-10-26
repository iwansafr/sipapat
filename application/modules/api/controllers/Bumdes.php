<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/bumdes_model');
	}
	public function index()
	{
		$this->db->limit('12');
		$this->db->order_by('RAND()');
		$data = $this->db->get_where('bumdes',"no_perdes != '' AND no_perkades != ''")->result_array();
		foreach ($data as $key => $value) 
		{
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa'] = $desa;
		}
		output_json($data);
	}
	public function get_all()
	{
		$data = [];
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		$page = !empty($_GET['page']) ? @intval($_GET['page']) : '';

		$this->db->select('bumdes.id, bumdes.nama, desa.nama AS desa, desa.kecamatan AS kecamatan');
		$this->db->order_by('nama','asc');
		if(!empty($sipapat_config['regency_id']))
		{
			$this->db->where(['regency_id'=>$sipapat_config['regency_id']]);
		}
		$this->db->join('desa','desa.id=bumdes.desa_id');
		$data = $this->db->get('bumdes')->result_array();
		// $data['query'] = $this->db->last_query();
		output_json($data);
	}
}