<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Corona extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
	}
	public function index()
	{

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
	public function lapor($id = 0)
	{
		$custom_api = $this->esg->get_config(base_url().'_api');
		$desa = [];
		if(!empty($custom_api['url']))
		{
			$custom_api = $custom_api['url'];
			$desa = file_get_contents($custom_api.'/api/desa/detail/'.$id);
			if(!empty($desa))
			{
				$desa = json_decode($desa,1);
			}
		}
		$data['desa'] = $desa;
		$this->load->view('index',$data);
	}
}