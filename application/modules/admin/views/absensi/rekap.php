<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->library('table');
// header("Content-type: application/vnd-ms-excel");
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header("Content-Disposition: attachment; filename=Data Perangkat.xls");

echo $this->table->generate($data);