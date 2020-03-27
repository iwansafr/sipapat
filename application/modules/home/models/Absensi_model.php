<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
	public function upload($data = array())
	{
    if(!empty($data))
    {
      $file_name = time().'_'.$data['desa_id'].'_'.$data['perangkat_desa_id'];
      $ext = pathinfo($_FILES['foto']['name']);
      $data['foto'] = $file_name.'.'.$ext['extension'];
      $check_exist = $this->db->get_where('absensi',['desa_id'=>$data['desa_id'],'status'=>$data['status'],'perangkat_desa_id'=>$data['perangkat_desa_id']])->row_array();
      if(empty($check_exist))
      {
        if($this->db->insert('absensi', $data))
        {
          $last_id = $this->db->insert_id();
      		$abs_dir = FCPATH.'images/modules/absensi/'.$last_id.'/';
      		if(!is_dir($abs_dir))
          {
          	mkdir($abs_dir,0777,1);
          }
      		$config['upload_path'] = $abs_dir;
          $config['file_name'] = $file_name;
          $config['allowed_types'] = 'gif|jpg|png|jpeg';

          $this->load->library('upload', $config);


          if (!$this->upload->do_upload('foto'))
          {
            $this->db->delete('absensi',['id'=>$last_id]);
            return ['status'=>'danger','msg'=>'Mohon Maaf Proses Absensi Gagal '.$this->upload->display_errors()];
          }else{
            $config_image_lib['image_library']  = 'gd2';
            $config_image_lib['source_image']   = $abs_dir.$data['foto'];
            // $config_image_lib['create_thumb']   = TRUE;
            $config_image_lib['maintain_ratio'] = TRUE;
            $config_image_lib['width']          = 750;
            $config_image_lib['height']         = 500;
            $this->load->library('image_lib', $config_image_lib);

            $this->image_lib->resize();

            return ['status'=>'success','msg'=>'Terima Kasih Telah Melakukan Absensi'];
          }
        }
      }else{
        return ['status'=>'danger','msg'=>'Anda Sudah Melakukan Absensi'];
      }
    }
	}	
}