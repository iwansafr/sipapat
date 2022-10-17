<?php defined('BASEPATH') or exit('No direct script access allowed');

class Statistik_model extends CI_Model
{

    public function getIdStatistikDesa($desa_id = 0)
    {
        if(!empty($desa_id))
        {
            $this->db->select('id');
            $this->db->where('desa_id',$desa_id);
            $output = $this->db->get('statistik_penduduk')->result_array();
            if(empty($output))
            {
                $this->db->insert('statistik_penduduk',[
                    'desa_id' => $desa_id,
                ]);
            }else{
                return $output;
            }
        }
    }
}