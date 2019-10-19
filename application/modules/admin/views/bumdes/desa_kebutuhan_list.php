<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('filter');

filter_desa(base_url('admin/bumdes/kebutuhan_list'), 'kebutuhan', $desa_option);