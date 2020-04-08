<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('filter');
filter_desa(base_url('admin/corona/excel_list/'), 'ODP', $desa_option);