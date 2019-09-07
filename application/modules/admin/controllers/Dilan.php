<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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
	public function upload()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc']);
      $data = ['status'=>'success','data'=>$file];
      output_json($data);
		}else{
			$data = ['status'=>'error'];
			outpur_json($data);
		}
	}
	public function index()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc']);
			// $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			// $reader->setReadDataOnly(TRUE);

			// $spreadsheet = $reader->load($file);
			// $worksheet = $spreadsheet->getActiveSheet();
			// $data = array();
			// $title = array();
			// $i = 0;
			// foreach ($worksheet->getRowIterator() as $row) 
			// {
		 //    $cellIterator = $row->getCellIterator();
		 //    $cellIterator->setIterateOnlyExistingCells(FALSE);
		 //    $j = 0;
		 //    foreach ($cellIterator as $cell)
		 //    {
		 //    	if($i==0)
		 //    	{
		 //    		// $data[$cell->getValue()] = [];
		 //    		$title[] = $cell->getValue();
		 //    	}else{
		 //    		$data[$i][$title[$j]] = $cell->getValue();
		 //    	}
		 //    	// $data[$i][] = $cell->getValue();
	  //   		$j++;
		 //    }
		 //    $i++;
			// }
			if($file)
			{
				$this->esg->add_js(base_url('assets/dilan/script.js'));
			}
		}
		$this->esg->add_js(base_url('assets/dilan/script.js'));
		$this->load->view('index');
	}
	public function insert()
	{
		if(!empty($_POST['file']))
		{
			$file = $_POST['file'];
			$file = FCPATH.'images/modules/dilan/'.$file;
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$reader->setReadDataOnly(TRUE);

			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = array();
			$title = array();
			$i = 0;
			foreach ($worksheet->getRowIterator() as $row) 
			{
		    $cellIterator = $row->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(FALSE);
		    $j = 0;
		    foreach ($cellIterator as $cell)
		    {
		    	if($i==0)
		    	{
		    		// $data[$cell->getValue()] = [];
		    		$title[] = $cell->getValue();
		    	}else{
						if($title[$j] == 'TGL_LHR'){
							$dt = new DateTime();
							$data[$i][$title[$j]] = date('Y-m-d', PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cell->getValue()));
						}else{
							$data[$i][$title[$j]] = $cell->getValue();
						}
		    		
		    	}
		    	// $data[$i][] = $cell->getValue();
	    		$j++;
		    }
				$i++;
			}
			if(!empty($data))
			{
				$this->db->insert_batch('penduduk', $data);
			}
			echo output_json(['status'=>1]);
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}
	public function form()
	{
		if(is_root())
		{
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
		$this->load->view('index');
	}

	public function surat_pengantar_form($id = 0)
	{
		if(!empty($id))
		{
			$this->load->view('index');
		}

	}

	public function list()
	{
		$this->load->view('index');
	}

	public function clear_list()
	{
		$this->load->view('dilan/list');
	}
}