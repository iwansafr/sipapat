<?php defined('BASEPATH') OR exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Desa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Desa');
		$this->load->view('index', ['id'=>$id]);
	}

	public function list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function list_report()
	{
		$this->load->library('table');
		$data['desa'] = $this->db->get('desa')->result_array();
		$this->load->view('desa/list_report', $data);
	}

	// Export ke excel
	public function excel()
	{
		// Create new Spreadsheet object
		$data['desa'] = $this->db->get('desa')->result_array();
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
		->setCellValue('A1','no')
		->setCellValue('B1','kode')
		->setCellValue('C1','nama desa')
		->setCellValue('D1','kecamatan')
		->setCellValue('E1','kabupaten')
		->setCellValue('F1','provinsi')
		->setCellValue('G1','kode pos')
		->setCellValue('H1','nomor telepon')
		->setCellValue('I1','email')
		->setCellValue('J1','website')
		->setCellValue('K1','alamat balai desa')
		;

		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data['desa'] as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i,$value['kode'])
			->setCellValue('C'.$i,$value['nama'])
			->setCellValue('D'.$i,$value['kecamatan'])
			->setCellValue('E'.$i,$value['kabupaten'])
			->setCellValue('F'.$i,$value['provinsi'])
			->setCellValue('G'.$i,$value['kode_pos'])
			->setCellValue('H'.$i,$value['telepon'])
			->setCellValue('I'.$i,$value['email'])
			->setCellValue('J'.$i,$value['website'])
			->setCellValue('K'.$i,$value['alamat']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data desa '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="data desa.xlsx"');
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

	public function pdf()
	{
		$this->load->library('pdf');
		$pdf = new FPDF('L','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',7);
    // mencetak string 
    $pdf->Cell(200,10,'SIPAPAT',0,1,'C');
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(200,10,'DATA DESA',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',7);

		$pdf->Cell(8,6,'no',1,0);
		$pdf->Cell(12,6,'kode',1,0);
		$pdf->Cell(25,6,'nama desa',1,0);
		$pdf->Cell(25,6,'kecamatan',1,0);
		$pdf->Cell(25,6,'kabupaten',1,0);
		$pdf->Cell(25,6,'provinsi',1,0);
		$pdf->Cell(20,6,'kode pos',1,0);
		$pdf->Cell(25,6,'nomor telepon',1,0);
		$pdf->Cell(35,6,'email',1,0);
		$pdf->Cell(35,6,'website',1,0);
		$pdf->Cell(45,6,'alamat balai desa',1,1);

    $pdf->SetFont('Arial','',7);
    $desa = $this->db->get('desa')->result_array();
    $i = 1;
    foreach ($desa as $key => $value)
    {
    	$pdf->Cell(8,6,$i,1,0);
			$pdf->Cell(12,6,$value['kode'],1,0);
			$pdf->Cell(25,6,$value['nama'],1,0);
			$pdf->Cell(25,6,$value['kecamatan'],1,0);
			$pdf->Cell(25,6,$value['kabupaten'],1,0);
			$pdf->Cell(25,6,$value['provinsi'],1,0);
			$pdf->Cell(20,6,$value['kode_pos'],1,0);
			$pdf->Cell(25,6,$value['telepon'],1,0);
			$pdf->Cell(35,6,$value['email'],1,0);
			$pdf->Cell(35,6,$value['website'],1,0);
			$pdf->Cell(45,6,$value['alamat'],1,1);

      $i++;
    }
    $pdf->Output();
	}

	public function clear_list()
	{
		$this->load->view('desa/list');
	}
}