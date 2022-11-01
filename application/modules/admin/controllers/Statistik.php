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
    public function admin_penduduk_statistik()
    {
        $this->load->view('index');
    }
    public function agama(){
        $this->load->view('index');
    }
    public function admin_agama_statistik()
    {
        $this->load->view('index');
    }
    public function pendidikan(){
        $this->load->view('index');
    }
    public function admin_pendidikan_statistik()
    {
        $this->load->view('index');
    }
    public function sarpras(){
        $this->load->view('index');
    }
    public function admin_sarpras_statistik()
    {
        $this->load->view('index');
    }
    public function pekerjaan(){
        if(!$this->db->field_exists('pelajar','statistik_penduduk'))
		{
			$this->load->dbforge();
			$fields = array(
                'pelajar' => array(
                        'type' => 'INT',
                        'constraint' => '11',
                        'default' => '0',
                        'after' => 'asn'
                ),
			);
			$this->dbforge->add_column('statistik_penduduk',$fields);
		}
        if(!$this->db->field_exists('perangkat_desa','statistik_penduduk'))
		{
			$this->load->dbforge();
			$fields = array(
                'perangkat_desa' => array(
                        'type' => 'INT',
                        'constraint' => '11',
                        'default' => '0',
                        'after' => 'asn'
                ),
			);
			$this->dbforge->add_column('statistik_penduduk',$fields);
		}
        $this->load->view('index');
    }
    public function admin_pekerjaan_statistik()
    {
        $this->load->view('index');
    }

    public function sarpras_fasilitas_pendidikan(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_pemerintahan(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_ibadah(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_ekonomi(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_kesehatan(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_lingkungan(){
        $this->load->view('index');
    }

    public function sarpras_fasilitas_pendidikan_statistik(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_pemerintahan_statistik(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_ibadah_statistik(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_ekonomi_statistik(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_kesehatan_statistik(){
        $this->load->view('index');
    }
    public function sarpras_fasilitas_lingkungan_statistik(){
        $this->load->view('index');
    }
}