<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_model extends CI_Model
{
	public function kategori()
	{
		return ['1'=>'perikanan','2'=>'pertanian','3'=>'peternakan','4'=>'perkebunan','5'=>'home indsutri','6'=>'perdagangan','7'=>'wisata','8'=>'jasa','9'=>'seni budaya'];
	}
	public function satuan()
	{
		return ['0'=>'nihil','1'=>'Ton','2'=>'Kg','3'=>'Kw','4'=>'ekor','5'=>'lembar','6'=>'liter','7'=>'butir','8'=>'buah','9'=>'unit'];
	}
	public function waktu()
	{
		return ['1'=>'januari-desember','2'=>'setiap hari','3'=>'setiap minggu'];
	}
	public function get_potensi($id = 0)
	{
		if(!empty($id))
		{
			return $this->db->query('SELECT potensi_desa.*,desa.nama AS nama_desa, user.username FROM potensi_desa INNER JOIN desa on(desa.id=potensi_desa.desa_id) INNER JOIN user ON(user.id=potensi_desa.user_id) WHERE potensi_desa.id = ?',@intval($id))->row_array();
		}
	}
}