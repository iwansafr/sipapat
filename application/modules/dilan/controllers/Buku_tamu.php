<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_tamu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
		$this->load->model('admin/sipapat_model');
		$this->load->model('admin/dilan_model');
		$this->load->model('admin/pengguna_model');
	}
    public function index()
    {

    }
    public function desa($desa)
    {
        if(is_numeric($desa)){
            $data = $this->db->query('SELECT * FROM desa WHERE id = ? ', $desa)->row_array();
            if(!empty($data['id'])){
                $data['perangkat_desa'] = $this->db->query('SELECT * FROM perangkat_desa WHERE desa_id = ? AND kelompok = 1',$data['id'])->result_array();
            }
            $jabatan = $this->pengguna_model->jabatan()[1];
            $this->load->view('dilan/buku_tamu/desa',compact('data','jabatan'));
        }else{
            echo 'Link tidak valid';
        }
    }
}