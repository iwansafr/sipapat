<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Corona_model extends CI_Model
{
	public function get_rekap()
	{
		$output[] = ['no','desa','kecamatan','total'];
		$tmp = $this->db->query('SELECT desa.nama,desa.kecamatan,count(desa_id) AS total FROM corona INNER JOIN desa ON(desa.id=corona.desa_id) group by desa_id ORDER BY desa_id DESC')->result_array();
		if(!empty($tmp))
		{
			$i = 1;
			foreach ($tmp as $key => $value) 
			{
				$output[] = [
					$i,
					$value['nama'],
					$value['kecamatan'],
					$value['total'],
				];
				$i++;
			}
		}
		return $output;
	}

	public function get_data($desa_id = 0,$kec = '')
	{
		$where = '';
		// $data = [];
		$data[] = ['nik','nama','umur','jenis kelamin','rt','rw','desa','dari','tgl kedatangan','hp','demam','Batuk Pilek Sakit Tenggorokan','Pernah Kontak dg Penderita Covid'];
		if(!empty($desa_id))
		{
			$where = ' WHERE desa_id = '.$desa_id.' AND status = 1';
			$output = $this->db->query('SELECT corona.nik,corona.nama,corona.umur,case jk WHEN 1 then "laki-laki" WHEN 2 then "Perempuan" END AS kelamin,corona.rt,corona.rw,desa.nama AS desa,corona.dari,corona.tgl AS tgl_kedatangan,corona.hp,corona.demam,corona.bpst AS `Batuk Pilek Sakit Tenggorokan`,corona.pkdpc AS `pernah kontak dg penderita covid` FROM corona INNER JOIN desa ON(desa.id=corona.desa_id) '.$where.' ORDER BY corona.desa_id ASC')->result_array();
		}else{
			if(!empty($kec))
			{
				$where = " WHERE kecamatan = ? AND status = 1 ";
				$output = $this->db->query('SELECT corona.nik,corona.nama,corona.umur,case jk WHEN 1 then "laki-laki" WHEN 2 then "Perempuan" END AS kelamin,corona.rt,corona.rw,desa.nama AS desa,corona.dari,corona.tgl AS tgl_kedatangan,corona.hp,corona.demam,corona.bpst AS `Batuk Pilek Sakit Tenggorokan`,corona.pkdpc AS `pernah kontak dg penderita covid` FROM corona INNER JOIN desa ON(desa.id=corona.desa_id) '.$where.' ORDER BY corona.desa_id ASC',$kec)->result_array();
			}else{
				$output = $this->db->query('SELECT corona.nik,corona.nama,corona.umur,case jk WHEN 1 then "laki-laki" WHEN 2 then "Perempuan" END AS kelamin,corona.rt,corona.rw,desa.nama AS desa,corona.dari,corona.tgl AS tgl_kedatangan,corona.hp,corona.demam,corona.bpst AS `Batuk Pilek Sakit Tenggorokan`,corona.pkdpc AS `pernah kontak dg penderita covid` FROM corona INNER JOIN desa ON(desa.id=corona.desa_id) WHERE status = 1 ORDER BY corona.desa_id ASC')->result_array();
			}
		}
		if(!empty($output))
		{
			foreach ($output as $key => $value) 
			{
				$value['nik'] = "'".$value['nik'];
				$data[] = $value;
			}
		}
		return $data;
	}
	public function get_posko($desa_id = 0)
	{
		if(!empty($desa_id))
		{
			return $this->db->get_where('corona_posko',['desa_id'=>$desa_id])->row_array();
		}
	}
}