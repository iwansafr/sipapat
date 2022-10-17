<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->model('statistik_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
    }
    public function index()
    {

    }
    public function penduduk()
    {
        $this->load->view('index');
    }

}