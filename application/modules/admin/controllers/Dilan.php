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
				$this->esg->add_script
				(
					'	$(document).ready(function(){
							$.ajax({
								type:"post",
								data: {file:"'.$file.'"},
						    url: _URL+"admin/dilan/insert",
						    beforeSend: function(){
									var elem = document.getElementById("dilan_pro");
									var width = 1;
									var id = setInterval(frame,100);
									function frame(){
										if(width>=100){
											clearInterval(id);
										}else{
											width = width+1;
											elem.style.width = width + "%";
											var show = width;
											elem.innerHTML = show + " % menyiapkan data";
										}
									}
						    },
						    success:function(result){
						    	if(result.status)
						    	{
										var elem = document.getElementById("dilan_success_pro");
										var width = 1;
										var id = setInterval(frame,100);
										function frame(){
											if(width>=100){
												clearInterval(id);
											}else{
												width = width+1;
												elem.style.width = width + "%";
												var show = width;
												elem.innerHTML = show + " % data berhasil di upload";
											}
										}
						    	}
						    },
						    error:function(){
						    	console.log("error");
						    }
						  });
						});
					'
				);
			}
		}

		$this->load->view('index');
	}
	public function insert()
	{
		if(!empty($_POST['file']))
		{
			$file = $_POST['file'];
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
		    		$data[$i][$title[$j]] = $cell->getValue();
		    	}
		    	// $data[$i][] = $cell->getValue();
	    		$j++;
		    }
		    $i++;
			}
			echo output_json(['status'=>1]);
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}
}