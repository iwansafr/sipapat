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
			'3'=>'<span class="btn-sm btn-warning">Izin Kantor</span>',
			'2'=>'<span class="btn-sm btn-success">Pulang</span>',
			'5'=>'<span class="btn-sm btn-warning">Dinas Kantor</span>',
		];
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
			if(!empty($per_ids))
			{
				$this->db->select('id,nama,jabatan');
				$this->db->where(['desa_id'=>$desa_id]);
				$this->db->where_not_in('id',$per_ids);
				$data = $this->db->get('perangkat_desa')->result_array();
			}
		}
		return $data;
	}
}