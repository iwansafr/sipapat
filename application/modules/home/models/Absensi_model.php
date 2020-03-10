<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
	public function upload($data = array())
	{
		pr($data);
		// pr($_FILES);

		// $abs_dir = FCPATH.'images/modules/absensi/';
		// if(!is_dir($abs_dir))
  //   {
  //   	mkdir($abs_dir,0777,1);
  //   }
		// $config['upload_path'] = $abs_dir;
  //   $config['allowed_types'] = 'gif|jpg|png';
  //   $config['max_size']      = 100;
  //   $config['max_width']     = 1024;
  //   $config['max_height']    = 768;

  //   $this->load->library('upload', $config);

  //   if ( ! $this->upload->do_upload('foto'))
  //   {
  //     $error = array('error' => $this->upload->display_errors());
  //     // $this->load->view('upload_form', $error);
  //     pr($error);
  //   }else{
  //     $data = array('upload_data' => $this->upload->data());
  //     // $this->load->view('upload_success', $data);
  //   }
	}	
}