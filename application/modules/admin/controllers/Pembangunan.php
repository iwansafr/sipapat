<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pembangunan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pembangunan_model');
		$this->load->model('pengguna_model');
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function detail($id=0)
	{
		$pembangunan = $this->pembangunan_model->get_pembangunan($id);
		$sumber_dana = $this->pembangunan_model->sumber_dana();
		$peserta = $this->pembangunan_model->peserta();
		$bidang = $this->pembangunan_model->bidang();
		$desa = $this->sipapat_model->get_desa($pembangunan['desa_id']);
		$this->esg_model->set_nav_title('detail pembangunan '.$pembangunan['item']);
		$this->load->view('index',['data'=>$pembangunan,'desa'=>$desa,'sumber_dana'=>$sumber_dana,'bidang'=>$bidang,'peserta'=>$peserta]);
	}

	public function desa($type = '')
	{
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		$bidang    = $this->pembangunan_model->bidang();
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa($kec)]);
	}
	public function kecamatan($type = '')
	{
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		$bidang    = $this->pembangunan_model->bidang();
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan(),'view'=>$view]);
	}
	public function test()
	{
		
	}
	public function clear_desa($type = '')
	{
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
		$this->load->view('pembangunan/desa', ['view'=>$view,'desa_option'=>$this->pengguna_model->get_desa()]);
	}

	public function index()
	{
		$view = false;
		$this->load->view('index',['view'=>$view]);
	}
	public function list($type = '')
	{
		$sumber    = $this->pembangunan_model->sumber_dana();
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;

		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = @intval($this->input->get('desa_id'));
		}
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
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
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'bidang_id'=>$bidang_id,'desa_id'=>$desa_id,'desa_id_get'=>$desa_id_get]);
	}
	public function clear_list($type = '')
	{
		$sumber    = $this->pembangunan_model->sumber_dana();
		$bidang    = $this->pembangunan_model->bidang();
		$bidang_id = 0;
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = @intval($this->input->get('desa_id'));
		}
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$view      = $type;
				$bidang_id = $key;
			}
		}
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
		$this->load->view('pembangunan/index',['view'=>$view,'sumber'=>$sumber,'bidang_id'=>$bidang_id,'bidang'=>$bidang,'desa_id'=>$desa_id,'desa_id_get'=>$desa_id_get]);
	}
	public function buat()
	{
		$this->esg_model->set_nav_title('buat laporan pembangunan');
		$this->load->view('index');
	}
	public function edit($type = '')
	{
		switch($type)
		{
			case 'fisik':
				$view = $type;
			break;
			case 'non-fisik':
				$view = $type;
			break;
			default:
				$view = false;
			break;
		}

		$sumber = $this->pembangunan_model->sumber_dana();
		$bidang = $this->pembangunan_model->bidang();
		$desa_id = $this->sipapat_model->get_desa_id();
		$peserta = $this->pembangunan_model->peserta();
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'desa_id'=>$desa_id,'peserta'=>$peserta]);
	}
	public function edit_gambar()
	{
		$this->load->view('index');
	}
	public function pdf_detail($id = 0)
	{
		if(!empty($id))
		{
			$jenis          = ['Non Fisik','Fisik'];
			$pembangunan    = $this->pembangunan_model->get_pembangunan($id);
			$tahap          = $this->pembangunan_model->tahap();
			$sumber_dana    = $this->pembangunan_model->sumber_dana();
			$sumber_dana[0] = 'Tidak Ada';
			$peserta        = $this->pembangunan_model->peserta();
			$bidang         = $this->pembangunan_model->bidang();
			$desa           = $this->sipapat_model->get_desa($pembangunan['desa_id']);
			$image          = $this->sipapat_model->get_image_kab();

			$teks1 = 'PEMERINTAH KABUPATEN PATI';
			$teks2 = 'KECAMATAN '.@$desa['kecamatan'];
			$teks3 = 'DESA '.$desa['nama'];
			$teks4 = 'Alamat Kantor Kepala Desa '.strtolower(@$desa['nama']).' '.substr(@$desa['alamat'],0,20).' Kec. '.strtolower(@$desa['kecamatan']).' kab. Pati';
			$teks5 = ': '.@$desa['telepon'];
			$teks6 = ': '.@$desa['email'];
			$teks7 = ': '.@$desa['kode_pos'];
			$teks8 = ': '.@$desa['website'];

			$this->load->library('pdf');
			$pdf = new FPDF('P','mm','A4');
	    // membuat halaman baru
	    $pdf->AddPage();
	    // setting jenis font yang akan digunakan
	    $pdf->SetFont('Arial','B',7);
	    // mencetak string 
	    $pdf->Image($image,10,10,40,30);
	    $pdf->Cell(25);
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(0,5,$teks1,0,1,'C');
			$pdf->Cell(25);
			$pdf->Cell(0,5,$teks2,0,1,'C');
			$pdf->Cell(25);
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(0,5,$teks3,0,1,'C');
			$pdf->Cell(38);
			$pdf->SetFont('Times','','13');
			// $pdf->MultiCell(0,5,$teks4,0,1,false);
			$pdf->Cell(0,5,$teks4,0,1,'L');
			$pdf->Cell(38);
			$pdf->Cell(20,5,'Telepon',0,0,'L');
			$pdf->Cell(30,5,$teks5,0,0,'L');
			$pdf->Cell(20);
			$pdf->Cell(15,5,'Email',0,0,'L');
			$pdf->Cell(60,5,$teks6,0,1,'L');
			$pdf->Cell(38);
			$pdf->Cell(20,5,'Kode Pos',0,0,'L');
			$pdf->Cell(30,5,$teks7,0,0,'L');
			$pdf->Cell(20);
			$pdf->Cell(15,5,'Website',0,0,'L');
			$pdf->Cell(60,5,$teks8,0,1,'L');
			$pdf->SetLineWidth(1);
			$pdf->Line(10,45,200,45);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,46,200,46);
			$pdf->Ln(10);

			if(!empty($pembangunan))
			{
				unset($pembangunan['id']);
				unset($pembangunan['user_id']);
				unset($pembangunan['desa_id']);
				unset($pembangunan['created']);
				unset($pembangunan['updated']);
				$doc = [0,40,50,80,100];

				foreach ($pembangunan as $key => $value) 
				{

					if($key=='peserta')
					{
						if(!empty($value))
						{
							$value = @$peserta[$value];
						}
					}

					if($key=='tahap')
					{
						if(!empty($value))
						{
							$value = $tahap[$value];
						}
					}

					if($key=='jenis')
					{
						$value = $jenis[$value];
					}

					if($key=='bidang')
					{
						if(!empty($value))
						{
							$value = $bidang[$value];
						}
					}

					if($key=='anggaran')
					{
						if(!empty($value))
						{
							$value = money($value);
						}
					}

					if($key=='realisasi')
					{
						if(!empty($value))
						{
							$value = money($value);
						}
					}

					if($key=='from_date')
					{
						$key = 'dari tanggal';
						$value = content_date($value);
					}

					if($key=='to_date')
					{
						$key = 'sampai tanggal';
						$value = content_date($value);
					}

					if($key=='date')
					{
						$key = 'tanggal';
						$value = content_date($value);
					}

					if($key == 'sumber_dana')
					{
						$value = $sumber_dana[$value];
					}
					if($key == 'sumber_dana_alt')
					{
						$key = 'sumber dana kedua';
						$value = $sumber_dana[$value];
					}
					if(preg_match('~doc~', $key))
					{
						$pdf->Cell(38);
						$pdf->Cell(37,5, $key, 0,0, 'L');
						if(!empty($value))
						{
							$value = image_module('pembangunan',$id.'/'.$value);
							$image_format = strtolower(pathinfo($value, PATHINFO_EXTENSION));
							if($image_format !='png')
							{
								$pdf->Cell(30,5,':',0,0);
								$pdf->Image(@$value, null,null,50,50,$image_format);
							}
							$pdf->Ln(10);
						}else{
							$pdf->Cell(30,5, ': '.$value,0,1,'L');
						}
					}else{
						if($key=='lokasi' || $key == 'vol')
						{
							$pdf->Cell(38);
							// $pdf->MultiCell(31,5, $key, 1,'R', false);
							$pdf->Cell(37,5, $key, 0,0, 'L');
							$pdf->Cell(2,5, ':', 0,0, 'L');
							$pdf->MultiCell(30,5,$value,0,'L',false);
						}else{
							$pdf->Cell(38);
							$pdf->Cell(37,5, $key, 0,0, 'L');
							$pdf->Cell(30,5, ': '.$value,0,1,'L');
						}
					}
				}
			}
	    
	    $pdf->Output('Detail_LAPORAN.pdf','I');
		}
	}

	public function excel($type = '')
	{
		$jenis = ['Non Fisik','Fisik'];
		$sumber = $this->pembangunan_model->sumber_dana();
		$sumber[0] = 'TIDAK ADA';
		$bidang = $this->pembangunan_model->bidang();
		$tahap = $this->pembangunan_model->tahap();
		$tahap[0] = '';
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
		}else{
			$desa_id = @intval($this->input->get('desa_id'));
		}
		foreach ($bidang as $key => $value) 
		{
			if(strtolower($value) == str_replace('_',' ',$type))
			{
				$bidang_id = $key;
			}
		}
		$where = '';
		if(!empty($desa_id))
		{
			$where = ' AND pembangunan.desa_id = '.$desa_id;
		}else if(!empty($_GET['kec'])){
			$where =  " AND desa.kecamatan = '".@$_GET['kec']."'";
		}
		$data = $this->db->query
		('
			SELECT 
				pembangunan.*,desa.nama AS nama_desa
			FROM 
				pembangunan
			INNER JOIN 
				desa 
			WHERE 
				pembangunan.desa_id = desa.id
			AND 
				bidang = ?
		'.$where, $bidang_id)->result_array();

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
		->setCellValue('B1',strtoupper('Jenis'))
		->setCellValue('C1',strtoupper('nama desa'))
		->setCellValue('D1',strtoupper('item'))
		->setCellValue('E1',strtoupper('lokasi'))
		->setCellValue('F1',strtoupper('koordinat'))
		->setCellValue('G1',strtoupper('vol'))
		->setCellValue('H1',strtoupper('tgl mulai'))
		->setCellValue('I1',strtoupper('tgl'))
		->setCellValue('J1',strtoupper('tgl selesai'))
		->setCellValue('K1',strtoupper('sumber dana'))
		->setCellValue('L1',strtoupper('sumber dana kedua'))
		->setCellValue('M1',strtoupper('peserta'))
		->setCellValue('N1',strtoupper('jml_peserta'))
		->setCellValue('O1',strtoupper('bidang'))
		->setCellValue('P1',strtoupper('anggaran'))
		->setCellValue('Q1',strtoupper('realisasi'))
		->setCellValue('R1',strtoupper('tahap'))
		->setCellValue('Q1', strtoupper('th_anggaran'));
		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i, $jenis[$value['jenis']])
			->setCellValue('C'.$i, $value['nama_desa'])
			->setCellValue('D'.$i, $value['item'])
			->setCellValue('E'.$i, $value['lokasi'])
			->setCellValue('F'.$i, $value['koordinat'])
			->setCellValue('G'.$i, $value['vol'])
			->setCellValue('H'.$i, $value['from_date'])
			->setCellValue('I'.$i, $value['date'])
			->setCellValue('J'.$i, $value['to_date'])
			->setCellValue('K'.$i, $sumber[$value['sumber_dana']])
			->setCellValue('L'.$i, $sumber[$value['sumber_dana_alt']])
			->setCellValue('M'.$i, $value['peserta'])
			->setCellValue('N'.$i, $value['jml_peserta'])
			->setCellValue('O'.$i, $bidang[$value['bidang']])
			->setCellValue('P'.$i, $value['anggaran'])
			->setCellValue('Q'.$i, $value['realisasi'])
			->setCellValue('R'.$i, $tahap[$value['tahap']])
			->setCellValue('Q'.$i, $value['th_anggaran']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data perangkat '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Desa.xlsx"');
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

}