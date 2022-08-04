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
	}
    public function index()
    {

    }
    public function desa($desa)
    {
        if(is_numeric($desa)){
            $desa = $this->db->query('SELECT * FROM desa WHERE id = ? ', $desa)->row_array();
            $this->load->view('index');
        }else{
            echo 'Link tidak valid';
        }
    }
}