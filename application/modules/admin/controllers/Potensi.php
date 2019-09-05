<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Potensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->model('sipapat_model');
		$this->load->model('potensi_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function edit()
	{
		$item = @intval($_GET['item']);
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		if(!empty($item))
		{
			$kategori=$kategori[$item];
		}
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
		$bulan = array_start_one($bulan);
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu,'bulan'=>$bulan]);
	}
	public function desa($view = '')
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index',['desa_option'=>$this->pengguna_model->get_desa($kec),'view'=>$view]);
	}
	public function kecamatan($view = '')
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan(),'view'=>$view]);
	}
	public function list()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}

	public function excel($view = '')
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$produk_desa = ['Tidak Ada', 'Ada'];
		$kat_item = 0;
		foreach ($kategori as $key => $value) 
		{
			$current_view = str_replace(' ', '_', $value);
			if($current_view == $view)
			{
				$kat_item = $key;
			}
		}
		$where = '';
		if(is_admin() || is_root())
		{
			if(!empty(@intval($_GET['desa_id'])))
			{
				$desa_id = @intval($_GET['desa_id']);
			}else{
				if(!empty($_GET['kec']))
				{
					$where = " WHERE desa.kecamatan = '".$_GET['kec']."'";
				}
			}
		}

		if(!empty($desa_id))
		{
			$where = ' WHERE desa_id = '.$desa_id;
		}

		if(!empty($kat_item))
		{
			if(!empty($where))
			{
				$where .= ' AND kategori = '.$kat_item;
			}else{
				$where = ' WHERE kategori = '.$kat_item;
			}
		}
		$data = $this->db->query(
			'
			SELECT potensi_desa.*,desa.nama AS nama_desa ,desa.kecamatan
			FROM potensi_desa 
			INNER JOIN desa
			ON (desa.id = potensi_desa.desa_id)
			'.$where
		)->result_array();

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
		->setCellValue('D1',strtoupper('kategori'))
		->setCellValue('E1',strtoupper('produk desa'))
		->setCellValue('F1',strtoupper('volume'))
		->setCellValue('G1',strtoupper('satuan'))
		->setCellValue('H1',strtoupper('waktu'))
		->setCellValue('I1',strtoupper('dari bulan'))
		->setCellValue('J1',strtoupper('sampai bulan'));
		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i, $value['nama_desa'])
			->setCellValue('C'.$i, $value['item'])
			->setCellValue('D'.$i, $kategori[$value['kategori']])
			->setCellValue('E'.$i, $produk_desa[$value['produk_desa']])
			->setCellValue('F'.$i, $value['volume'])
			->setCellValue('G'.$i, $satuan[$value['satuan']])
			->setCellValue('H'.$i, $waktu[$value['waktu']])
			->setCellValue('I'.$i, $value['from_month'])
			->setCellValue('J'.$i, $value['to_month']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data potensi desa '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="POTENSI DESA.xlsx"');
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

	public function clear_list()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('potensi/list',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}
	public function index()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$this->load->view('index',['desa_id'=>$desa_id,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu]);
	}

	public function clear_bidang($item = 0)
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$items =
		[
			'perikanan',
			'pertanian',
			'peternakan',
			'perkebunan',
			'home_industri',
			'perdagangan',
			'wisata',
			'jasa',
			'seni_budaya',
		];
		$items = array_start_one($items);
		$this->load->view("potensi/".$items[$item],["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>$item]);
	}

	public function perikanan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>1]);
	}
	public function pertanian() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>2]);
	}
	public function peternakan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>3]);
	}
	public function perkebunan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>4]);
	}
	public function home_industri() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>5]);
	}
	public function perdagangan() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>6]);
	}
	public function wisata() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>7]);
	}
	public function jasa() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>8]);
	}
	public function seni_budaya() 
	{
			$desa_id = $this->sipapat_model->get_desa_id();
			$kategori = $this->potensi_model->kategori();
			$satuan = $this->potensi_model->satuan();
			$waktu = $this->potensi_model->waktu();
			$this->load->view("index",["desa_id"=>$desa_id,"kategori"=>$kategori,"satuan"=>$satuan,"waktu"=>$waktu,'item'=>9]);
	}

	public function detail()
	{
		$id = @intval($_GET['id']);
		$kategori = $this->potensi_model->kategori();
		$satuan = $this->potensi_model->satuan();
		$waktu = $this->potensi_model->waktu();
		$data = $this->potensi_model->get_potensi($id);
		$bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','septemper','oktober','november','desember'];
		$bulan = array_start_one($bulan);
		$this->load->view('index', ['data'=>$data,'kategori'=>$kategori,'satuan'=>$satuan,'waktu'=>$waktu,'bulan'=>$bulan]);
	}
}