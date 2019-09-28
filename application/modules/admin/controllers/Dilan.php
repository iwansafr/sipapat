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
			// $file['desa_id'] = $_POST['desa_id'];
      $data = ['status'=>'success','data'=>$file];
      output_json($data);
		}else{
			$data = ['status'=>'error'];
			outpur_json($data);
		}
	}

	public function upload_modify()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc']);
			// $file['desa_id'] = $_POST['desa_id'];
      $data = ['status'=>'success','data'=>$file];
      output_json($data);
		}else{
			$data = ['status'=>'error'];
			outpur_json($data);
		}
	}

	public function detail($id = 0)
	{
		if(!empty($id))
		{
			$this->load->view('index');
		}
	}

	public function index()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc']);
			if($file)
			{
				$this->esg->add_js(base_url('assets/dilan/script.js'));
			}
		}
		$this->esg->add_js(base_url('assets/dilan/script.js'));
		$this->load->view('index');
	}

	public function modify()
	{
		if(!empty($_FILES['doc']['name']))
		{
			$file = $this->dilan_model->upload($_FILES['doc'], '_update');
			if($file)
			{
				$this->esg->add_js(base_url('assets/dilan/script.js'));
			}
		}
		$this->esg->add_js(base_url('assets/dilan/script.js'));
		$this->load->view('index');
	}

	public function edit()
	{
		$desa_id = 0;
		$desa = [];
		if(is_desa())
		{
			$desa_id = $this->sipapat_model->get_desa_id();
			$desa = $this->sipapat_model->get_desa($desa_id);
		}
		$this->load->view('index',['desa'=>$desa]);
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
			$desa_id = $this->sipapat_model->get_desa_id();
			foreach ($worksheet->getRowIterator() as $row) 
			{
		    $cellIterator = $row->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(FALSE);
		    $j = 1;
				$title[0] = 'desa_id';
		    foreach ($cellIterator as $cell)
		    {
		    	if($i==0)
		    	{
		    		// $data[$cell->getValue()] = [];
		    		$title[] = $cell->getValue();
		    		// $title[] = 'desa_id';
		    	}else{
		    		$data[$i]['desa_id'] = $desa_id;
						if($title[$j] == 'TGL_LHR'){
							if(preg_match('~-~',$cell->getValue()))
							{
								$data[$i][$title[$j]] = $cell->getValue();
							}else{
								$dt = new DateTime();
								$data[$i][$title[$j]] = date('Y-m-d', PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cell->getValue()));
							}
						}else{
							$data[$i][$title[$j]] = $cell->getValue();
						}
		    		
		    	}
		    	// $data[$i][] = $cell->getValue();
	    		$j++;
	    		// $data[$i]['desa_id'] = $desa_id;
		    }
				$i++;
			}
			if(!empty($data))
			{
				if($this->db->insert_batch('penduduk', $data))
				{
					echo output_json(['status'=>1]);
				}else{
					echo output_json(['status'=>0]);
				}
			}
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}

	public function update()
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
			$desa_id = $this->sipapat_model->get_desa_id();
			foreach ($worksheet->getRowIterator() as $row) 
			{
		    $cellIterator = $row->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(FALSE);
		    $j = 1;
				$title[0] = 'desa_id';
		    foreach ($cellIterator as $cell)
		    {
		    	if($i==0)
		    	{
		    		// $data[$cell->getValue()] = [];
		    		$title[] = $cell->getValue();
		    		// $title[] = 'desa_id';
		    	}else{
		    		$data[$i]['desa_id'] = $desa_id;
						if($title[$j] == 'TGL_LHR'){
							$dt = new DateTime();
							$data[$i][strtolower($title[$j])] = date('Y-m-d', PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cell->getValue()));
						}else{
							$data[$i][strtolower($title[$j])] = $cell->getValue();
						}
		    		
		    	}
		    	// $data[$i][] = $cell->getValue();
	    		$j++;
	    		// $data[$i]['desa_id'] = $desa_id;
		    }
				$i++;
			}
			if(!empty($data))
			{
				if($this->db->update_batch('penduduk', $data,'nik'))
				{
					echo output_json(['status'=>1]);
				}else{
					echo output_json(['status'=>0]);
				}
			}
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}

	public function download_template()
	{
		$data = $this->db->list_fields('penduduk');
		unset($data[0],$data[1],$data[26],$data[25],$data[27]);
		$alp = alphabet();
		$tot = count($data);
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
		$i = 0;
		$str = '$spreadsheet->setActiveSheetIndex(0)';
		foreach ($data as $key => $value)
		{
			$j = $i+1;
			$str .= '->setCellValue("'.$alp[$i].'1","'.strtoupper($value).'")';
			$i++;
		}
		$str .= ';';
		eval($str);
		$spreadsheet->getActiveSheet()->setTitle('template '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="data penduduk.xlsx"');
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

	public function surat_pengantar_form($id = 0, $ket_id = 0)
	{
		if(!empty($id))
		{
			$penduduk = $this->dilan_model->get_penduduk($id);
			$desa = $this->sipapat_model->get_desa($penduduk['desa_id']);
			$keterangan = [];
			if(!empty($ket_id))
			{
				$keterangan = $this->dilan_model->get_keterangan($ket_id);
				if(!empty($keterangan))
				{
					$keterangan = $keterangan[0];
				}
			}
			$this->load->view('index',['penduduk' => $penduduk,'desa'=>$desa,'keterangan'=>$keterangan]);
			if(!empty($_POST))
			{
				$last_id = $this->zea->get_insert_id();
				redirect(base_url('admin/dilan/surat_pengantar/'.$last_id));
			}
		}
	}

	public function surat_pengantar_choose_form($id = 0)
	{
		$data = [];
		$data['keterangan'] = $this->dilan_model->get_keterangan();
		$this->esg_model->set_nav_title('pilih form surat');
		$this->load->view('index',['data'=>$data,'id'=>$id]);
	}

	public function surat_pengantar_ket()
	{
		$this->load->view("index");
	}
	public function clear_surat_pengantar_ket()
	{
		$this->load->view('dilan/surat_pengantar_ket');
	}

	public function surat_pengantar($id = 0)
	{
		if(!empty($id))
		{
			$this->load->model('pengguna_model');
			$this->load->model('perangkat_model');

			$surat    = $this->dilan_model->get_surat($id);
			if(!empty($surat['penduduk_id']))
			{
				$penduduk = $this->dilan_model->get_penduduk($surat['penduduk_id']);
				$desa     = $this->sipapat_model->get_desa($penduduk['desa_id']);
				$agama    = $this->pengguna_model->agama();
				$kepdes   = [];
				if(!empty($desa['id']))
				{
					$kepdes   = $this->perangkat_model->kepala_desa($desa['id']);
				}

				$penduduk['agama'] = @$agama[$penduduk['agama']];
				// pr($surat);
				// pr($penduduk);
				// pr($desa);

				$image = $this->sipapat_model->get_image_kab();

				$teks1 = 'PEMERINTAH KABUPATEN PATI';
				$teks2 = 'KECAMATAN '.@$desa['kecamatan'];
				$teks3 = 'DESA '.$desa['nama'];
				// $teks4 = 'Alamat Kantor Kepala Desa '.strtolower(@$desa['nama']).' '.substr(@$desa['alamat'],0,20).' Kec. '.strtolower(@$desa['kecamatan']).' kab. '.$desa['kabupaten'];
				$teks4 = ': '.substr(@$desa['alamat'],0,20);
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
				// $pdf->Cell(0,5,$teks4,0,1,'L');
				$pdf->Cell(30,5,'Alamat Kantor',0,0,'L');
				$pdf->Cell(30,5,$teks4,0,0,'L');
				$pdf->Cell(10);
				$pdf->Cell(15,5,'Email',0,0,'L');
				$pdf->Cell(60,5,$teks6,0,1,'L');
				$pdf->Cell(38);
				$pdf->Cell(30,5,'Telepon',0,0,'L');
				$pdf->Cell(30,5,$teks5,0,0,'L');
				$pdf->Cell(10);
				$pdf->Cell(15,5,'Website',0,0,'L');
				$pdf->Cell(60,5,$teks8,0,1,'L');
				$pdf->Cell(38);
				$pdf->Cell(30,5,'Kode Pos',0,0,'L');
				$pdf->Cell(30,5,$teks7,0,1,'L');
				$pdf->SetLineWidth(1);
				$pdf->Line(10,45,200,45);
				$pdf->SetLineWidth(0);
				$pdf->Line(10,46,200,46);
				$pdf->Ln(10);

				$pdf->Cell(0,5,'No. Kode Desa : '.$desa['kode'],0,1,'L');
				$pdf->Cell(200,5,'SURAT KETERANGAN/PENGANTAR',0,1,'C');
				$pdf->SetLineWidth(0);
				$pdf->Line(70,60,150,60);
				$pdf->Ln(1);
				$pdf->Cell(200,5,'Nomor: '.$surat['nomor'],0,1,'C');
				$pdf->Ln(5);
				$pdf->Cell(150,5,'Yang bertanda tangan di bawah ini, menerangkan bahwa : ',0,1,'C');
				$pdf->Cell(60,5,'1. Nama',0,0,'L');
				$pdf->Cell(0,5,': '.$penduduk['nama'],0,1,'L');
				$pdf->Cell(60,5,'2. Tempat, tanggal lahir',0,0,'L');
				$pdf->Cell(0,5,': '.$penduduk['tmpt_lhr'].', '.content_date($penduduk['tgl_lhr']),0,1,'L');
				$pdf->Cell(60,5,'3. Kewarganegaraan/ Agama',0,0,'L');
				$pdf->Cell(0,5,': Indonesia/ '.$penduduk['agama'],0,1,'L');
				$pdf->Cell(60,5,'4. Pekerjaan',0,0,'L');
				$pdf->Cell(0,5,': '.$penduduk['pekerjaan'],0,1,'L');
				$pdf->Cell(60,5,'5. Tempat Tinggal',0,0,'L');
				$pdf->Cell(0,5,': '.$penduduk['alamat'].' RT '.$penduduk['no_rt'].' RW '.$penduduk['no_rw'],0,1,'L');
				$pdf->Cell(5);
				$pdf->Cell(55,5,'Kabupaten',0,0,'L');
				$pdf->Cell(40,5,': '.$desa['kabupaten'],0,0,'L');
				$pdf->Cell(5);
				$pdf->Cell(17,5,'Provinsi',0,0,'L');
				$pdf->Cell(0,5,': '.$desa['provinsi'],0,1,'L');
				$pdf->Cell(60,5,'6. Surat Bukti',0,0,'L');
				$pdf->Cell(52,5,': KTP : '.$penduduk['nik'],0,0,'L');
				// $pdf->Cell(5);
				$pdf->Cell(10,5,'KK',0,0,'R');
				$pdf->Cell(0,5,': '.$penduduk['no_kk'],0,1,'L');
				// $pdf->Cell(5);
				$pdf->Cell(60,5,'7. Keperluan',0,0,'L');
				$pdf->Cell(2,5,': ',0,0,'L');
				$pdf->MultiCell(0,5,strtolower($surat['keperluan']),0,'L',false);
				$pdf->Cell(60,5,'8. Berlaku Mulai',0,0,'L');
				$pdf->Cell(0,5,': '.content_date($surat['berlaku_mulai']).' s/d '.content_date($surat['berlaku_sampai']),0,1,'L');
				$pdf->Cell(60,5,'9. Keterangan lain-lain *)',0,0,'L');
				$pdf->Cell(2,5,': ',0,0,'L');
				$pdf->MultiCell(0,5,strtolower($surat['keterangan']),0,'L',false);

				$ln_kep = strlen($surat['keperluan']);
				$ln_ket = strlen($surat['keterangan']);
				// $pdf->cell(2,5, $ln_kep);
				// $pdf->cell(50);
				// $pdf->cell(2,5, $ln_ket);
				$pdf->Ln(5);
				$pdf->Cell(150,5,'Demikian untuk menjadikan maklum bagi yang berkepentingan',0,1,'C');
				// $pdf->Cell(50);
				// $pdf->Cell(18,5,'Nomor',0,0,'L');
				// $pdf->Cell(50,5,': '.$surat['nomor'],0,1,'L');
				$pdf->Cell(50);
				$pdf->Cell(18,5,'Tanggal',0,0,'L');
				$pdf->Cell(50,5,': '.content_date($surat['tgl']),0,1,'L');
				
				$pdf->Ln(10);

				$pdf->Cell(190,5,'Mengetahui',0,1,'C');
				$pdf->Cell(65,5,'Tandatangan Pemegang',0,0,'C');
				$pdf->Cell(60,5,'Camat '.$desa['kecamatan'],0,0,'C');
				$pdf->Cell(60,5,'Kepala Desa '.$desa['nama'],0,0,'C');
				if(!empty($desa['ttd_img']))
				{
					$pdf->Image(image_module('desa',$desa['id'].'/'.$desa['ttd_img']),135,165,40,30);
				}
				$pdf->Ln(30);
		    
		    $pdf->Cell(65,5,$penduduk['nama'],0,0,'C');
		    $line_len = 107 + $ln_ket;
				$pdf->SetLineWidth(0);
				// $pdf->Line(61,$line_len,24,$line_len);
		    $pdf->Cell(60,5,'................................',0,0,'C');
				$pdf->SetLineWidth(0);
				// $pdf->Line(123,$line_len,87,$line_len);
		    $pdf->Cell(60,5,@$kepdes['nama'],0,1,'C');
				$pdf->SetLineWidth(0);
				// $pdf->Line(183,$line_len,147,$line_len);
				$pdf->Ln(1);
				$pdf->Cell(65);
		    $pdf->Cell(60,5,'NIP. .........................',0,0,'C');
		    $pdf->Cell(60,5,'NIP. '.@$kepdes['nik'],0,1,'C');
		    $pdf->Output('Surat_Keterangan_Pengantar.pdf','I');
			}
		}
	}

	public function surat_list()
	{
		$this->load->view('index');
	}

	public function clear_surat_list()
	{
		$this->load->view('dilan/surat_list');
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