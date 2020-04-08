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

	public function excel_list()
	{
		$data['data'] = $this->corona_model->get_data();
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

}