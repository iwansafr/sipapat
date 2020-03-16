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
	      $day_num = date('d', strtotime($date));
	      $day_name = date('l', strtotime($date));
	      $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
	      $tgl[] = ['num'=>$day_num,'name'=>$day_name,'date'=>$date];
	    }
	    return $tgl;
		}
	}
}