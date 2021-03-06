<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes_model extends CI_Model{
	public function kategori_usaha()
	{
		return 
		[
			'1'=>'JASA KEUANGAN',
			'2'=>'JASA NON KEUANGAN',
			'3'=>'BROKERING',
			'4'=>'PERTANIAN',
			'5'=>'PETERNAKAN',
			'6'=>'PERDAGANGAN',
		];
	}
	public function tingkat_pemeringkatan()
	{
		return
		[
			'1'=>'DASAR',
			'2'=>'TUMBUH',
			'3'=>'BERKEMBANG',
			'4'=>'MAJU'
		];
	}

	public function get_usaha($bumdes_id = 0)
	{
		if(!empty($bumdes_id))
		{
			return $this->db->get_where('bumdes_usaha',['bumdes_id'=>$bumdes_id])->row_array();
		}
	}

	public function get_dana_kat()
	{
		$this->db->select('id,title');
		$kat = $this->db->get('bumdes_dana_kat')->result_array();
		$kategori = [];
		foreach($kat AS $key => $value)
		{
			$kategori[$value['id']] = $value['title'];
		}
		$this->db->select('id,bumdes_dana_kat_id, value');
		$dana = $this->db->get('bumdes_dana')->result_array();
		$data = [];
		$i = 0;
		foreach($dana AS $key => $value)
		{
			$data[$i]['id'] = $value['id'];
			$data[$i]['value'] = $value['value'];
			$data[$i]['kat'] = @$kategori[$value['bumdes_dana_kat_id']];
			$data[$i]['kat_id'] = @intval($value['bumdes_dana_kat_id']);
			$i ++;
		}
		$data_list = [];
		foreach($data AS $key => $value)
		{
			if(!empty($value['kat']))
			{
				$data_list[$value['kat']][] = $value;
			}else{
				$data_list['lainnya'][] = $value;
			}
		}

		return $data_list;
	}

	public function get_bumdes_id($desa_id = 0)
	{
		if(!empty($desa_id))
		{
			$this->db->select('id');
			return $this->db->get_where('bumdes',['desa_id'=>$desa_id])->row_array()['id'];
		}
	}

	public function get_kelembagaan($id = 0)
	{
		$data = [];
		if(!empty($id))
		{
			$data = $this->db->query('SELECT * FROM bumdes_kelembagaan WHERE bumdes_id = ? ORDER BY id DESC', $id)->row_array();
		}
		return $data;
	}

	public function get_pengurus($id = 0)
	{
		$data = [];
		if(!empty($id))
		{
			$data = $this->db->query('SELECT * FROM bumdes_pengurus WHERE bumdes_id = ? ', $id)->result_array();
		}
		return $data;
	}

	public function get_bumdes($id = 0)
	{
		if(!empty($id))
		{
			return $this->db->get_where('bumdes',['id'=>$id])->row_array();
		}
	}

	public function termin()
	{
		return ['0'=>'None','1'=>'termin 1','2'=>'termin 2','3'=>'termin 3'];
	}

	public function get_alamat($alamat = '')
	{
		if(!empty($alamat))
		{
			$alamat = explode("\n",$alamat);
			$alamat_array = [];
			foreach ($alamat as $key => $value) 
			{
				$tmp_alamat = explode(':',$value);
				$alamat_array[@$tmp_alamat[0]] = @$tmp_alamat[1];	
			}
			return $alamat_array;
		}
	}

	public function get_bumdesma($id)
	{
		if(!empty($id))
		{
			return $this->db->get_where('bumdesma',['id'=>$id])->row_array();
		}
	}

	public function update_indikator_usaha($data = array(), $name = '')
	{
		if(!empty($data) && !empty($name))
		{
			$this->db->update('bumdes_indikator_usaha', $data, "name = '$name'");
		}
	}

	public function update_simpan_pinjam($data = array(), $name = '')
	{
		if(!empty($data) && !empty($name))
		{
			$this->db->update('bumdes_simpan_pinjam', $data, "name = '$name'");
		}	
	}

	public function get_product($id = 0)
	{
		return $this->db->get_where('bumdes_product',['id'=>$id])->row_array();
	}
	public function get_product_cat($id = 0)
	{
		return $this->db->get_where('bumdes_product_cat',['id'=>$id])->row_array();
	}

	public function get_indikator_usaha()
	{
		$data = $this->db->query('SELECT i.value,d.nama,d.kecamatan FROM bumdes_indikator_usaha AS i INNER JOIN desa AS d ON(i.desa_id = d.id)')->result_array();
		$output = [];
		$output[] = [
			'DESA',
			'KECAMATAN',
			'UNIT_USAHA',
			'TAHUN_2015',
			'TAHUN_2016',
			'TAHUN_2017',
			'TAHUN_2018',
			'TAHUN_2019',
			'BANKEU_PEMERINTAH_PUSAT',
			'BANKEU_PROVINSI',
			'BANKEU_KABUPATEN',
			'INVESTASI',
			'SWASTA',
			'ASET_TAHUN_TERAKHIR',
			'OMSET_PERTAHUN',
			'KEUNTUNGAN_PERTAHUN',
			'HUTANG_PIHAK_KE_3',
		];
		if(!empty($data))
		{
			foreach ($data as $key => $value) 
			{
				$data_value = json_decode($value['value'],1);
				unset($value['value']);
				if(!empty($data_value))
				{
					foreach ($data_value as $dkey => $dvalue)
					{
						$value[$dkey] = $dvalue;
					}
				}
				$output[] = $value;
			}
		}
		return $output;
	}
}