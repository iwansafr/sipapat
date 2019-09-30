<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Perdes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('perdes_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function excel()
	{
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = @intval($this->input->get('desa_id'));
		}
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$where = '';
		if(!empty($desa_id))
		{
			$where = ' AND perdes.desa_id = '.$desa_id;
		}else if(!empty($_GET['kec'])){
			$where =  " AND desa.kecamatan = '".@$_GET['kec']."'";
		}
		$data = $this->db->query
		('
			SELECT 
				perdes.*,desa.nama AS nama_desa
			FROM 
				perdes
			INNER JOIN 
				desa 
			WHERE 
				perdes.desa_id = desa.id
		'.$where)->result_array();

		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('esoftgreat - software development')
		->setLastModifiedBy('esoftgreat - software development')
		->setTitle('Office 2007 XLSX Test Document')
		->setSubject('Office 2007 XLSX Test Document')
		->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		->setKeywords('office 2007 openxml php')
		->setCategory('Test result file');

		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1',strtoupper('no'))
		->setCellValue('B1',strtoupper('nama desa'))
		->setCellValue('C1',strtoupper('item'))
		->setCellValue('D1',strtoupper('no perdes'))
		->setCellValue('E1',strtoupper('tgl penetapan'))
		->setCellValue('F1',strtoupper('tgl pelaksanaan'))
		->setCellValue('G1',strtoupper('progress'));
		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i, $value['nama_desa'])
			->setCellValue('C'.$i, $perdes_options[$value['item']])
			->setCellValue('D'.$i, $value['no'])
			->setCellValue('E'.$i, $value['tgl_penetapan'])
			->setCellValue('F'.$i, $value['tgl_pelaksanaan']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data perdes '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="data perdes.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}	
	public function kecamatan()
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}
	public function index()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$desa_id_get = '';
		if(!empty($_GET))
		{
			$desa_id_get = [];
			foreach($_GET AS $key => $value)
			{
				$desa_id_get[] = $key.'='.str_replace(' ','+',$value);
			}
			if(!empty($desa_id_get))
			{
				$desa_id_get = '?'.implode('&', $desa_id_get);
			}
		}
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'desa_id_get'=>$desa_id_get]);
	}
	
	public function rpjmds()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>'1']);
	}

	public function rkp_desa()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>'2']);
	}

	public function apbdes()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>'3']);
	}

	public function perdes_kewenangan()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>'4']);
	}

	public function perdes_aset()
	{
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id = $this->sipapat_model->get_desa_id();
		$this->load->view('index',['perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>'5']);
	}



	public function edit()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$perdes = $this->perdes_model->get_perdes(@intval($_GET['id']));
		$this->load->view('index',['perdes'=>$perdes,'perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id]);
	}

	public function detail()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$perdes = $this->perdes_model->get_perdes(@intval($_GET['id']));
		$this->load->view('index',['perdes'=>$perdes,'perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id]);
	}

	public function clear_list($item = '')
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$perdes_options = $this->perdes_model->perdes_item();
		$perdes_progress = $this->perdes_model->perdes_progress();
		$desa_id_get = '';
		if(!empty($_GET))
		{
			$desa_id_get = [];
			foreach($_GET AS $key => $value)
			{
				$desa_id_get[] = $key.'='.str_replace(' ','+',$value);
			}
			if(!empty($desa_id_get))
			{
				$desa_id_get = '?'.implode('&', $desa_id_get);
			}
		}
		$this->load->view('perdes/index',['desa_id_get'=>$desa_id_get,'perdes_options'=>$perdes_options,'perdes_progress'=>$perdes_progress,'desa_id'=>$desa_id,'item'=>$item]);
	}
}