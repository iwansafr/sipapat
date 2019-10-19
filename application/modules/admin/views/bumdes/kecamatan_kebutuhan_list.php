<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('filter');
filter_kecamatan(base_url('admin/bumdes/desa_kebutuhan_list'), $kec_option);