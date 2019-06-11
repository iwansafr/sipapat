<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Dilan extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('dilan_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc']);
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
			$reader->setReadDataOnly(TRUE);

			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			pr($worksheet);

		}
		$this->load->view('index');
	}
}