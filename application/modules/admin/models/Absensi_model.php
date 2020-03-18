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
	public function status()
	{
		return ['0'=>'<span class="btn-sm btn-info">Kosong</span>','1'=>'<span class="btn-sm btn-success">Berangkat</span>','2'=>'<span class="btn-sm btn-success">Pulang</span>','3'=>'<span class="btn-sm btn-warning">Izin</span>','4'=>'<span class="btn-sm btn-danger">Terlambat</span>'];
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
}