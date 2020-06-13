<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model{

	public function tgl($date){
		if(!empty($date))
		{
			$date_set = substr($date, 0,8);
			$end = $date_set . date('t', strtotime($date)); //get end date of month
			$tgl = [];
			while(strtotime($date) <= strtotime($end))
			{
				$current_date = $date;
	      $day_num = date('d', strtotime($date));
	      $day_name = date('l', strtotime($date));
	      $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
	      $tgl[] = ['num'=>$day_num,'name'=>$day_name,'date'=>$current_date];
	    }
	    return $tgl;
		}
	}
	public function keterangan()
	{
		return ['3'=>['1'=>'Acara Keluarga','2'=>'Acara Kantor'],'5'=>['3'=>'dinas kantor berangkat','4'=>'dinas kantor pulang']];
	}
	public function status()
	{
		return 
		[
			'0'=>'<span class="btn-sm btn-info">Kosong</span>',
			'1'=>'<span class="btn-sm btn-success">Berangkat</span>',
			'4'=>'<span class="btn-sm btn-danger">Terlambat</span>',
			'3'=>'<span class="btn-sm btn-warning">Izin</span>',
			'2'=>'<span class="btn-sm btn-success">Pulang</span>',
			'5'=>'<span class="btn-sm btn-warning">Dinas lUAR</span>',
		];
	}
	public function clean_status()
	{
		return ['0'=>'Kosong','1'=>'Berangkat','2'=>'Pulang','3'=>'Izin','4'=>'Terlambat','5'=>'Dinas Luar'];
	}
	public function valid()
	{
		return ['0'=>'<span class="btn-sm btn-info">Belum diValidasi</span>','1'=>'<span class="btn-sm btn-success">Valid</span>','2'=>'<span class="btn-sm btn-danger">Tidak Valid</span>'];
	}
	public function bulan()
	{
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
	  $bulan = array_start_one($bulan);
	  return $bulan;
	}
	public function get_all($district_id = 0, $date = 0)
	{
		if(empty($date)){
			 $date= date('Y-m-d');
		}
		if(!empty($district_id))
		{
			$tmp_data = $this->db->query('SELECT a.id,a.desa_id,a.status,d.nama,d.district_id,a.created FROM absensi AS a INNER JOIN desa AS d ON(d.id=a.desa_id) WHERE district_id = ? AND CAST(a.created AS date) = ? ORDER BY status ASC',[$district_id, $date])->result_array();
			// pr($this->db->last_query());
			$data = [];
			$status_message = $this->absensi_model->status();
			$this->db->select('id,nama');
			$desa = $this->db->get_where('desa',['district_id'=>$district_id])->result_array();
			$perangkat_total = $this->db->query('SELECT COUNT(p.id) AS perangkat,desa_id FROM perangkat_desa AS p INNER JOIN desa AS d ON(p.desa_id=d.id) WHERE district_id = ? AND p.kelompok = 1 GROUP BY p.desa_id',$district_id)->result_array();
			$data_perangkat = [];
			if(!empty($perangkat_total))
			{
				foreach ($perangkat_total as $key => $value) 
				{
					$data_perangkat[$value['desa_id']] = $value['perangkat'];
				}
			}
			if(!empty($desa))
			{
				foreach ($desa as $key => $value) 
				{
					foreach ($status_message as $smkey => $smvalue) 
					{
						if($smkey > 0)
						{
							$data[$value['id']]['absensi'][$smkey]['total'] = 0;
							$data[$value['id']]['absensi'][$smkey]['judul'] = $smvalue;
							$data[$value['id']]['desa']['nama'] = $value['nama'];
							$data[$value['id']]['desa']['id'] = $value['id'];
						}else{
							$data[$value['id']]['absensi']['0']['total'] = $data_perangkat[$value['id']];
							$data[$value['id']]['absensi']['0']['judul'] = '<span class="btn-sm btn-danger">Tidak Masuk</span>';
							$data[$value['id']]['desa']['nama'] = $value['nama'];
							$data[$value['id']]['desa']['id'] = $value['id'];
						}
					}
				}
			}
			// pr($tmp_data);
			// pr($data);die();
			if(!empty($tmp_data))
			{
				$status_count = [];
				foreach ($tmp_data as $key => $value) 
				{
					$status_count[$value['desa_id']][$value['status']] = !empty($status_count[$value['desa_id']][$value['status']]) ? $status_count[$value['desa_id']][$value['status']]+1 : 1;
					if(!empty($value['status']))
					{
						if($value['status'] != 2){
							$data[$value['desa_id']]['absensi']['0']['total'] = $data[$value['desa_id']]['absensi']['0']['total']-1;
						}
						$data[$value['desa_id']]['absensi'][$value['status']]['total'] = $status_count[$value['desa_id']][$value['status']];
						$data[$value['desa_id']]['absensi'][$value['status']]['judul'] = $status_message[$value['status']];
						$data[$value['desa_id']]['desa']['nama'] = $value['nama'];
						$data[$value['desa_id']]['desa']['id'] = $value['desa_id'];
					}
				}
			}
			return $data;
		}
	}
	public function get_absensi($desa_id = 0, $date = 0)
	{
		if(empty($date)){
			 $date= date('Y-m-d');
		}
		if(!empty($desa_id))
		{
			$tmp_data = $this->db->query('SELECT a.id,a.desa_id,a.status,d.nama,d.district_id,a.created FROM absensi AS a INNER JOIN desa AS d ON(d.id=a.desa_id) WHERE desa_id = ? AND CAST(a.created AS date) = ? ORDER BY status ASC',[$desa_id, $date])->result_array();
			// pr($this->db->last_query());
			$data = [];
			$status_message = $this->absensi_model->status();
			$this->db->select('id,nama');
			$desa = $this->db->get_where('desa',['id'=>$desa_id])->result_array();
			$perangkat_total = $this->db->query('SELECT COUNT(p.id) AS perangkat,desa_id FROM perangkat_desa AS p INNER JOIN desa AS d ON(p.desa_id=d.id) WHERE desa_id = ? AND p.kelompok = 1 GROUP BY p.desa_id',$desa_id)->result_array();
			$data_perangkat = [];
			if(!empty($perangkat_total))
			{
				foreach ($perangkat_total as $key => $value) 
				{
					$data_perangkat[$value['desa_id']] = $value['perangkat'];
				}
			}
			if(!empty($desa))
			{
				foreach ($desa as $key => $value) 
				{
					foreach ($status_message as $smkey => $smvalue) 
					{
						if($smkey > 0)
						{
							$data[$value['id']]['absensi'][$smkey]['total'] = 0;
							$data[$value['id']]['absensi'][$smkey]['judul'] = $smvalue;
							$data[$value['id']]['desa']['nama'] = $value['nama'];
							$data[$value['id']]['desa']['id'] = $value['id'];
						}else{
							$data[$value['id']]['absensi']['0']['total'] = $data_perangkat[$value['id']];
							$data[$value['id']]['absensi']['0']['judul'] = '<span class="btn-sm btn-danger">Tidak Masuk</span>';
							$data[$value['id']]['desa']['nama'] = $value['nama'];
							$data[$value['id']]['desa']['id'] = $value['id'];
						}
					}
				}
			}
			// pr($tmp_data);
			// pr($data);die();
			if(!empty($tmp_data))
			{
				$status_count = [];
				foreach ($tmp_data as $key => $value) 
				{
					$status_count[$value['desa_id']][$value['status']] = !empty($status_count[$value['desa_id']][$value['status']]) ? $status_count[$value['desa_id']][$value['status']]+1 : 1;
					if(!empty($value['status']))
					{
						if($value['status'] != 2){
							$data[$value['desa_id']]['absensi']['0']['total'] = $data[$value['desa_id']]['absensi']['0']['total']-1;
						}
						$data[$value['desa_id']]['absensi'][$value['status']]['total'] = $status_count[$value['desa_id']][$value['status']];
						$data[$value['desa_id']]['absensi'][$value['status']]['judul'] = $status_message[$value['status']];
						$data[$value['desa_id']]['desa']['nama'] = $value['nama'];
						$data[$value['desa_id']]['desa']['id'] = $value['desa_id'];
					}
				}
			}
			return $data;
		}
	}
	public function get_bolos_list($desa_id = 0,$date = 0)
	{
		$data = [];
		if(!empty($desa_id))
		{
			$per_id = $this->db->query("SELECT perangkat_desa_id FROM absensi WHERE CAST(created AS date) = '{$date}' AND desa_id = {$desa_id}")->result_array();
			$per_ids = [];
			if(!empty($per_id))
			{
				foreach ($per_id as $key => $value) 
				{
					$per_ids[] = $value['perangkat_desa_id'];
				}
			}
			$this->db->select('id,nama,jabatan');
			$this->db->where(['desa_id'=>$desa_id,'kelompok'=>'1']);
			if(!empty($per_ids))
			{
				$this->db->where_not_in('id',$per_ids);
			}
			$data = $this->db->get('perangkat_desa')->result_array();
		}
		return $data;
	}

	public function upload($data = array())
	{
    if(!empty($data))
    {
      $file_name = time().'_'.$data['desa_id'].'_'.$data['perangkat_desa_id'];
      $ext = pathinfo($_FILES['foto']['name']);
      $data['foto'] = $file_name.'.'.$ext['extension'];
      $date = date('Y-m-d');
      $check_exist = $this->db->get_where('absensi',['desa_id'=>$data['desa_id'],'status'=>$data['status'],'perangkat_desa_id'=>$data['perangkat_desa_id'],'CAST(created AS date) = '=>$date])->row_array();
      $this->load->library('faced/FaceDetector');
      $faceDetect = new FaceDetector();
      $valid_face = false;
      if($faceDetect->faceDetect($_FILES['foto']['tmp_name']))
      {
        $valid_face = true;
      }
      if(!$valid_face)
      {
        return ['status'=>'danger','msg'=>'Wajah Tidak Valid, pastikan wajah terlihat saat mengambil gambar'];
      }
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
	public function is_libur($date = '')
	{
		if(empty($date))
		{
			$date = date('Y-m-d');
		}
		$libur = $this->db->query('SELECT * FROM absensi_libur WHERE date = ? ORDER BY id DESC',$date)->row_array();
		return $libur;
	}

	public function hari()
	{
		return [1=>'Minggu',2=>'Senin',3=>'Selasa',4=>'Rabu',5=>'Kamis',6=>'Jumat',7=>'Sabtu'];
	}
}