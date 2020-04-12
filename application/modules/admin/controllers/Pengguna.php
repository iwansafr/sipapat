<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Pengguna extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->esg->set_esg('pengguna', $pengguna);
	}
	public function index()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->esg->set_esg('pengguna', $pengguna);
		$this->load->view('index');
	}

	public function edit()
	{
		$this->esg->add_js([base_url('assets/pengguna/script.js')]);
		$this->load->view('index');
		$this->pengguna_model->save();
	}

	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Pengguna');

		$this->load->view('index', ['id'=>$id]);
	}

	public function list()
	{
		$this->pengguna_model->delete();
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->esg->set_esg('pengguna', $pengguna);
		$this->load->view('index');
	}

	public function kecamatan_list()
	{
		$this->load->view('index');
	}

	public function excel()
	{
		$data = $this->db->query('SELECT user_desa.nama,user_desa.phone,user_role.title,user.username,user.email,desa.nama AS desa,user.created FROM user_desa INNER JOIN desa INNER JOIN user INNER JOIN user_role WHERE user.id=user_desa.user_id AND user.user_role_id = user_role.id AND user_desa.desa_id = desa.id')->result_array();
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
		->setCellValue('B1','nama')
		->setCellValue('C1','username')
		->setCellValue('D1','email')
		->setCellValue('E1','phone')
		->setCellValue('F1','group')
		->setCellValue('G1','desa')
		->setCellValue('H1','terdaftar');

		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i,$value['nama'])
			->setCellValue('C'.$i,$value['username'])
			->setCellValue('D'.$i,$value['email'])
			->setCellValue('E'.$i,$value['phone'])
			->setCellValue('F'.$i,$value['title'])
			->setCellValue('G'.$i,$value['desa'])
			->setCellValue('H'.$i,$value['created']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data pengguna '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="data pengguna.xlsx"');
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
		$pdf = new FPDF('P','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',7);
    // mencetak string 
    $pdf->Cell(200,10,'SIPAPAT',0,1,'C');
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(200,10,'DATA PENGGUNA',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',7);

		$pdf->Cell(8,6,'no',1,0);
		$pdf->Cell(12,6,'nama',1,0);
		$pdf->Cell(25,6,'username',1,0);
		$pdf->Cell(40,6,'email',1,0);
		$pdf->Cell(25,6,'phone',1,0);
		$pdf->Cell(25,6,'group',1,0);
		$pdf->Cell(20,6,'desa',1,0);
		$pdf->Cell(25,6,'terdaftar',1,1);

    $pdf->SetFont('Arial','',7);
    $data = $this->db->query('SELECT user_desa.nama,user_desa.phone,user_role.title,user.username,user.email,desa.nama AS desa,user.created FROM user_desa INNER JOIN desa INNER JOIN user INNER JOIN user_role WHERE user.id=user_desa.user_id AND user.user_role_id = user_role.id AND user_desa.desa_id = desa.id')->result_array();
    $i = 1;
    foreach ($data as $key => $value)
    {
    	$pdf->Cell(8,6,$i,1,0);
			$pdf->Cell(12,6,$value['nama'],1,0);
			$pdf->Cell(25,6,$value['username'],1,0);
			$pdf->Cell(40,6,$value['email'],1,0);
			$pdf->Cell(25,6,$value['phone'],1,0);
			$pdf->Cell(25,6,$value['title'],1,0);
			$pdf->Cell(20,6,$value['desa'],1,0);
			$pdf->Cell(25,6,$value['created'],1,1);
      $i++;
    }
    $pdf->Output();
	}

	public function clear_list()
	{
		$this->load->view('pengguna/list');
	}
	public function clear_kec_list()
	{
		$this->load->view('pengguna/kecamatan_list',$this->esg->get_esg());
	}

	public function all()
	{
		$this->load->view('index');
	}
	public function clear_all()
	{
		$this->load->view('pengguna/all');
	}
}