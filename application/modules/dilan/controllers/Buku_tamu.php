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
        $this->load->model('dilan/bukutamu');
	}
    public function index()
    {

    }
    public function desa($desa)
    {
        $msg = [];
        if(!empty($this->input->post())){
            $post = $this->input->post();
            $post['desa_id'] = $desa;
            $msg = $this->bukutamu->save($post);
        }
        if(is_numeric($desa)){
            $data = $this->db->query('SELECT * FROM desa WHERE id = ? ', $desa)->row_array();
            if(!empty($data['id'])){
                $data['perangkat_desa'] = $this->db->query('SELECT * FROM perangkat_desa WHERE desa_id = ? AND kelompok = 1',$data['id'])->result_array();
            }
            $jabatan = $this->pengguna_model->jabatan()[1];
            $keperluan = $this->bukutamu->keperluan();
            
            $this->load->view('dilan/buku_tamu/desa',compact('data','jabatan','keperluan','msg'));
        }else{
            echo 'Link tidak valid';
        }
    }
}