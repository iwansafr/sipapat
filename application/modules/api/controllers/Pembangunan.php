<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/pembangunan_model');
	}
	public function index()
	{
		$data = $this->db->query("SELECT * FROM pembangunan where doc != '' OR doc_0 != '' OR doc_40 != '' OR doc_50 != '' OR doc_80 != '' OR doc_100 != '' ORDER BY id DESC LIMIT 12")->result_array();
		$sumber_dana = $this->pembangunan_model->sumber_dana();
		$peserta = $this->pembangunan_model->peserta();
		$bidang = $this->pembangunan_model->bidang();
		$tahap = ['-1'=>'1x Tahapan','1'=>'Tahap I','2'=>'Tahap II','3'=>'Tahap III'];
		$jenis = ['non fisik','fisik'];
		$doc = [0,40,50,80,100];
		foreach ($data as $key => $value) 
		{
			$desa                          = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa']            = $desa;
			$data[$key]['jenis']           = $jenis[$value['jenis']];
			$data[$key]['sumber_dana']     = $sumber_dana[$value['sumber_dana']];
			if(!empty($value['sumber_dana_alt']))
			{
				$data[$key]['sumber_dana_alt'] = $sumber_dana[$value['sumber_dana_alt']];
			}
			if(!empty($value['peserta']))
			{
				$value['peserta'] = string_to_array($value['peserta']);
				$tmp_peserta = [];
				foreach ($value['peserta'] as $vkey => $vvalue) 
				{
					$vvalue = $vvalue-1;
					if(!empty($peserta[$vvalue]))
					{
						$tmp_peserta[] = $peserta[$vvalue]['title'];
					}
				}
				$data[$key]['peserta'] = $tmp_peserta;
			}
			$data[$key]['bidang'] = $bidang[$value['bidang']];

			if(!empty($value['doc']))
			{
				$data[$key]['doc'] = image_module('pembangunan',$value['id'].'/'.$value['doc']);
			}
			foreach ($doc as $dkey => $dvalue)
			{
				if(!empty($value['doc_'.$dvalue]))
				{
					$data[$key]['doc_'.$dvalue] = image_module('pembangunan',$value['id'].'/'.$value['doc_'.$dvalue]);
				}
			}
		}
		output_json($data);
	}
}