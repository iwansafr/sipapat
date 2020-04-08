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

	public function get_data()
	{
		$data = $this->db->query('SELECT corona.nama,corona.umur,corona.jk AS jenis_kelamin,corona.rt,corona.rw,desa.nama AS desa,corona.dari,corona.tgl AS tgl_kedatangan,corona.hp,corona.demam,corona.bpst AS `Batuk Pilek Sakit Tenggorokan`,corona.pkdpc AS `pernah kontak dg penderita covid` FROM corona INNER JOIN desa ON(desa.id=corona.desa_id) ORDER BY corona.desa_id ASC');
		return $data;
	}
}