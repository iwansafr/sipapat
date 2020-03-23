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
		return ['0'=>'<span class="btn-sm btn-info">Kosong</span>','1'=>'<span class="btn-sm btn-success">Berangkat</span>','2'=>'<span class="btn-sm btn-success">Pulang</span>','3'=>'<span class="btn-sm btn-warning">Izin Kantor</span>','4'=>'<span class="btn-sm btn-danger">Terlambat</span>','5'=>'<span class="btn-sm btn-warning">Dinas Kantor</span>'];
	}
	public function clean_status()
	{
		return ['0'=>'Kosong','1'=>'Berangkat','2'=>'Pulang','3'=>'Izin Kantor','4'=>'Terlambat','5'=>'Dinas Kantor'];
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
	public function get_all($district_id = 0)
	{
		if(!empty($district_id))
		{
			$tmp_data = $this->db->query('SELECT a.id,a.desa_id,a.status,d.nama,d.district_id FROM absensi AS a INNER JOIN desa AS d ON(d.id=a.desa_id) WHERE district_id = ? AND CAST(a.created AS date) = ?',[$district_id, date('Y-m-d')])->result_array();
			$data = [];
			$status_message = $this->absensi_model->status();
			$this->db->select('id,nama');
			$desa = $this->db->get_where('desa',['district_id'=>$district_id])->result_array();
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
						}
					}
				}
			}
			if(!empty($tmp_data))
			{
				$status_count = [];
				

				foreach ($tmp_data as $key => $value) 
				{
					$status_count[$value['status']] = !empty($status_count[$value['status']]) ? $status_count[$value['status']]+1 : 1;
					if(!empty($value['status']))
					{
						$data[$value['desa_id']]['absensi'][$value['status']]['total'] = $status_count[$value['status']];
						$data[$value['desa_id']]['absensi'][$value['status']]['judul'] = $status_message[$value['status']];
						$data[$value['desa_id']]['desa']['nama'] = $value['nama'];
						$data[$value['desa_id']]['desa']['id'] = $value['desa_id'];
					}
				}
			}
			return $data;
		}
	}
}