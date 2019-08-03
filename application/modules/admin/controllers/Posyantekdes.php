<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posyantekdes extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->model('posyantekdes_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function pengurus($posy_id = 0)
	{
		$status = false;
		if(!empty($posy_id)){
			$id = @intval($_GET['id']);
			$this->esg_model->set_nav_title('pengaturan pengurus');
			$pengguna = $this->pengguna_model->get_pengguna();
			$posyantekdes = $this->posyantekdes_model->get_posyantekdes($posy_id);
			$jabatan = $this->posyantekdes_model->jabatan();
			if($pengguna['desa_id'] == $posyantekdes['desa_id']){
				$status = true;
			}
		}
		$this->load->view('index',['id'=>@$id,'status'=>@$status,'posy_id'=>@@$posy_id,'pengguna'=>@@$pengguna,'jabatan'=>@$jabatan,'posyantekdes'=>@$posyantekdes]);
	}

	public function clear_list(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('posyantekdes/index',['pengguna'=>$pengguna]);
	}
	public function edit(){
		$this->esg->add_js(base_url('assets/posyantekdes/script.js'));
		$pengguna = $this->pengguna_model->get_pengguna();
		$data = ['id'=>@intval($_GET['id']),'pengguna'=>$pengguna];
		$this->load->view('index', $data);
	}

	public function detail(){
		$pengguna = $this->pengguna_model->get_pengguna();
		$id = @intval($_GET['id']);
		$posyantekdes = $this->posyantekdes_model->get_posyantekdes($id);
		$alamat = $posyantekdes['alamat'];
		$alamat_tmp = [];
		if(preg_match('~:~',$alamat)){
			$alamat = explode("\n", $alamat);
			foreach($alamat as $al_key => $al_value){
				$al_value = explode(':',$al_value);
				$alamat_tmp[@$al_value[0]] = @$al_value[1];
			}
		}else if(preg_match('~=~',$alanat)){
			$alamat = explode("\n", $alamat);
			foreach($alamat as $al_key => $al_value){
				$al_value = explode('=',$al_value);
				$alamat_tmp[@$al_value[0]] = @$al_value[1];
			}
		}
		$pengurus = $this->posyantekdes_model->get_pengurus($posyantekdes['id']);
		$desa = $this->sipapat_model->get_desa($pengguna['desa_id']);
		$jabatan = $this->posyantekdes_model->jabatan();
		unset($posyantekdes['user_id'],$posyantekdes['desa_id'],$posyantekdes['id'],$posyantekdes['created'],$posyantekdes['updated'], $posyantekdes['alamat']);
		$data = 
		[
			'id'=>@intval($_GET['id']),
			'pengguna'=>$pengguna,
			'pengurus'=>$pengurus,
			'posyantekdes'=>$posyantekdes,
			'desa'=>$desa,
			'jabatan'=>$jabatan,
			'alamat'=>$alamat_tmp
		];
		$this->load->view('index', $data);
	}
}