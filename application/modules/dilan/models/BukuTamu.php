<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BukuTamu extends CI_Model
{
    public function keperluan()
    {
        return [1 => 'Rapat', 2 => 'Penawaran', 3 => 'Konsultasi', 4 => 'Mengantar Barang / Paket', 5 => 'Kunjungan'];
    }
    public function save($data = array())
    {
        if(is_array($data)){
            if (!empty($data['nama'])
                && !empty($data['hp'])
                && !empty($data['alamat'])
                && !empty($data['asal_instansi'])
                && !empty($data['jk'])
                && !empty($data['desa_id'])
                && !empty($data['perangkat_desa_id'])
                && !empty($data['keperluan'])
            ) {
                $post = [
                    'nama' => $data['nama'],
                    'hp' => $data['hp'],
                    'alamat' => $data['alamat'],
                    'asal_instansi' => $data['asal_instansi'],
                    'jk' => $data['jk'],
                    'desa_id' => $data['desa_id'],
                    'perangkat_desa_id' => $data['perangkat_desa_id'],
                    'keperluan' => $data['keperluan'],
                ];
                if($this->db->insert('buku_tamu', $post)){
                    return ['alert'=>'success','msg'=>'Data Berhasil Disimpan'];
                }
            }else{
                return ['alert'=>'danger','msg'=>'Data Belum Lengkap'];
            }
        }else{
            return ['alert'=>'danger','msg'=>'Data Bukan Array'];
        }
    }
}