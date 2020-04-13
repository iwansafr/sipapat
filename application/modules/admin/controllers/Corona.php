<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Corona extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('corona_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function desa($group = '')
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option'=>$this->pengguna_model->get_desa($kec),'group'=>$group]);
	}

	public function kecamatan()
	{
		$this->load->helper('filter');
		$this->load->view('index',['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}

	public function excel_list()
	{
		$desa_id = @intval($this->input->get('desa_id'));
		if(is_desa())
		{
			if(!empty($this->session->userdata()[base_url().'_logged_in']['pengguna']['desa_id']))
			{
				$desa_id = $this->session->userdata()[base_url().'_logged_in']['pengguna']['desa_id'];
			}
		}
		$kec = '';
		if(empty($desa_id))
		{
			$kec = $this->input->get('kec');
		}
		$data['data'] = $this->corona_model->get_data($desa_id,$kec);
		$this->load->view('index',$data);
	}

	public function list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['user'=>$pengguna]);
	}

	public function clear_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('corona/list',['user'=>$pengguna]);
	}

	public function edit()
	{
		$this->load->view('index');
	}

	public function detail($id = 0)
	{
		if(!empty($id))
		{
			$this->esg_model->set_nav_title('Detail Pelapor');
			$data['data'] = $this->db->get_where('corona',['id'=>$id])->row_array();
			if(!empty($data['data']['desa_id']))
			{
				$data['kelamin'] = ['1'=>'Laki-laki','2'=>'Perempuan'];
				$data['option'] = ['Tidak','Iya'];
				$data['data']['desa'] = $this->db->query('SELECT nama FROM desa WHERE id = ?',$data['data']['desa_id'])->row_array();
			}
			$this->load->view('index',$data);
			if(@$_GET['s']=='print')
			{
				?>
				<script type="text/javascript">
					window.print();
				</script>
				<?php
			}
		}
	}
	public function rekap()
	{
		$data['rekap'] = $this->corona_model->get_rekap();
		$this->load->view('index',$data);
	}

	public function posko_list()
	{
		$this->load->view('index');
	}

}