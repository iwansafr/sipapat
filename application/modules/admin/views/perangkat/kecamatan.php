<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('filter');
filter_kecamatan(base_url('admin/perangkat/desa/'.$group),$kec_option);
?>