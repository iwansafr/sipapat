<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/potensi_model');
	}
	public function index()
	{
		$data = $this->db->query("SELECT * FROM potensi_desa where doc != '' ORDER BY id DESC LIMIT 12")->result_array();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','septemper','oktober','november','desember'];
		$bulan = array_start_one($bulan);
		$produk_desa = ['Tidak Ada','Ada'];
		foreach ($data as $key => $value) 
		{
			$desa = $this->sipapat_model->get_desa($value['desa_id']);
			$data[$key]['desa'] = $desa;
			$data[$key]['doc'] = image_module('potensi_desa',$value['id'].'/'.$value['doc']);
			$data[$key]['kategori'] = @$kategori[$data[$key]['kategori']];
			$data[$key]['produk_desa'] = $produk_desa[$data[$key]['produk_desa']];
			$data[$key]['satuan'] = $satuan[$data[$key]['satuan']];
			$data[$key]['waktu'] = $waktu[$data[$key]['waktu']];
		}
		output_json($data);
	}
}