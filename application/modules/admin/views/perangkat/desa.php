<?php defined('BASEPATH') OR exit('No direct script access allowed');
$kelompok = empty($group) ? 'Perangkat Desa' : $group;
$this->load->helper('filter');
filter_desa(base_url('admin/perangkat/'.$group), $kelompok, $desa_option);