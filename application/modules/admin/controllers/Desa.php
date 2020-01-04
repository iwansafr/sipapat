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
		$this->load->model('sipapat_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function kecamatan()
	{
		$this->load->helper('filter');
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}

	public function edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		if(empty($sipapat_config))
		{
			$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		}else{
			$this->esg->add_js([base_url('assets/desa/script.js')]);
		}
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function edit_api()
	{
		if(empty($sipapat_config))
		{
			$this->esg->add_js([base_url('assets/sipapatconfig/script.js')]);
		}else{
			$this->esg->add_js([base_url('assets/desa/script.js')]);
		}
		$this->load->view('index');
	}

	public function rekening_list()
	{
		$this->load->view('index');
	}
	public function rekening_list_clear()
	{
		$this->load->view('desa/rekening_list');
	}

	public function rekening_edit()
	{
		$this->load->view('index');
	}
	public function rekening()
	{
		$view = 'index';
		if(@$_GET['s']=='print' || @$_GET['s']=='download')
		{
			$view = 'desa/rekening';
			$this->load->view('templates/AdminLTE/meta');
		}
		$this->load->view($view);
		if(@$_GET['s']=='print')
		{
			?>
			<script type="text/javascript">
				window.print();
			</script>
			<?php
		}
	}

	public function rekening_kecamatan_list()
	{
		$this->load->helper('filter');
		$this->load->view('index',['districts'=>$this->sipapat_model->get_districts()]);
	}
	public function download_rekening_excel()
	{
		$district_id = @intval($_GET['district_id']);
		$data = $this->sipapat_model->get_rekening_list();
		if(!empty($data))
		{
			$data_table  = [];
			$data_table[0][]= 'no';
			$data_table[0][]= 'Nama Bank';
			$data_table[0][]= 'Nama Pemilik Rekening';
			$data_table[0][]= 'Nomor Rekening';
			$data_table[0][]= 'Detil Nama Cabang Bank';
			$data_table[0][]= 'Nama Desa';
			$data_table[0][]= 'NPWP';
			$data_table[0][]= 'Alamat';
			$data_table[0][]= 'Kode Pos';
			
			$i = 1;
			foreach ($data as $key => $value) 
			{
				$tmp_data                           = [];
				$tmp_data['no']                     = $i;
				$tmp_data['Nama Bank']              = $value['bank'];
				$tmp_data['Nama Pemilik Rekening']  = $value['nama'];
				$tmp_data['Nomor Rekening']         = $value['no_rek'];
				$tmp_data['Detil Nama Cabang Bank'] = $value['bank'];
				$tmp_data['Nama Desa']              = $value['desa'];
				$tmp_data['NPWP']                   = $value['no_npwp'];
				$tmp_data['Alamat']                 = $value['alamat'];
				$tmp_data['Kode Pos']               = $value['kode_pos'];
				$data_table[] = $tmp_data;
				$i++;
			}
			$this->load->library('table');
			// header("Content-type: application/vnd-ms-excel");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition: attachment; filename=Data Rekening Desa Kabupaten.xls");

			echo $this->table->generate($data_table);
		}
	}

	public function rekening_pdf()
	{
		$sipapatconfig = $this->esg->get_esg('sipapat_config');
		if(!empty($sipapatconfig))
		{
			$kabupaten = $this->sipapat_model->get_regency($sipapatconfig['regency_id']);
			if(!empty($kabupaten))
			{
				$kabupaten = $kabupaten['name'];
			}
			if(is_desa())
			{
				$desa_id = $this->sipapat_model->get_desa_id();
			}else{
				$desa_id = @intval($_GET['desa_id']);
			}

			if(!empty($desa_id))
			{
				$data = $this->sipapat_model->get_rekening($desa_id);
				$desa = $this->sipapat_model->get_desa($desa_id);
			}else{
				$district_id = @intval($_GET['district_id']);
				$data = $this->sipapat_model->get_rekening_list($district_id);
			}

			$this->load->library('pdf');
			$pdf = new FPDF('L','mm','Legal');
	    // membuat halaman baru
	    $pdf->AddPage();
	    // setting jenis font yang akan digunakan
	    $pdf->SetFont('Arial','B',7);
	    // mencetak string 
			$pdf->SetFont('Times','B','12');
			$pdf->Cell(0,0,'DAFTAR PENDATAAN DATA REKENING KAS DESA',0,1,'C');
			$pdf->Cell(0,20,$kabupaten,0,1,'C');
			$pdf->SetFont('Times','B','9');
			$pdf->Cell(10,5,'No',1,0,'C');
			$pdf->Cell(35,5,'Nama Bank',1,0,'C');
			// $pdf->MultiCell(30,8,'Nama Pemilik Rekening',1,'C',false);
			$pdf->Cell(55,5,'Nama Pemilik Rekening',1,0,'C');
			$pdf->Cell(35,5,'Nomor Rekening',1,0,'C');
			$pdf->Cell(45,5,'Detil Nama Cabang Bank',1,0,'C');
			$pdf->Cell(35,5,'Nama Desa',1,0,'C');
			$pdf->Cell(35,5,'NPWP',1,0,'C');
			$pdf->Cell(60,5,'Alamat',1,0,'C');
			$pdf->Cell(25,5,'Kode Pos',1,1,'C');
			$pdf->Cell(10,5,'(1)',1,0,'C');
			$pdf->Cell(35,5,'(2)',1,0,'C');
			$pdf->Cell(55,5,'(3)',1,0,'C');
			$pdf->Cell(35,5,'(4)',1,0,'C');
			$pdf->Cell(45,5,'(5)',1,0,'C');
			$pdf->Cell(35,5,'(6)',1,0,'C');
			$pdf->Cell(35,5,'(7)',1,0,'C');
			$pdf->Cell(60,5,'(8)',1,0,'C');
			$pdf->Cell(25,5,'(9)',1,1,'C');
			$pdf->SetFont('Times','','8');
			if(!empty($desa_id))
			{
				$detail_bank = !empty($data['bank_detail']) ? $data['bank_detail'] : $data['bank'];
				$pdf->Cell(10,5,'1',1,0,'C');
				$pdf->Cell(35,5,ucwords(strtolower($data['bank'])),1,0,'C');
				$pdf->Cell(55,5,ucwords(strtolower($data['nama'])),1,0,'C');
				$pdf->Cell(35,5,ucwords(strtolower($data['no_rek'])),1,0,'C');
				$pdf->Cell(45,5,ucwords(strtolower($detail_bank)),1,0,'C');
				$pdf->Cell(35,5,ucwords(strtolower($desa['nama'])),1,0,'C');
				$pdf->Cell(35,5,ucwords(strtolower($data['no_npwp'])),1,0,'C');
				$pdf->Cell(60,5,ucwords(strtolower($data['alamat'])),1,0,'C');
				$pdf->Cell(25,5,ucwords(strtolower($desa['kode_pos'])),1,1,'C');
			}else{
				if(!empty($data))
				{
					$i = 1;
					foreach ($data as $key => $value) 
					{
						$detail_bank = !empty($value['bank_detail']) ? $value['bank_detail'] : $value['bank'];
						$pdf->Cell(10,5,$i,1,0,'C');
						$pdf->Cell(35,5,ucwords(strtolower($value['bank'])),1,0,'C');
						$pdf->Cell(55,5,ucwords(strtolower($value['nama'])),1,0,'C');
						$pdf->Cell(35,5,ucwords(strtolower($value['no_rek'])),1,0,'C');
						$pdf->Cell(45,5,ucwords(strtolower($detail_bank)),1,0,'C');
						$pdf->Cell(35,5,ucwords(strtolower($value['desa'])),1,0,'C');
						$pdf->Cell(35,5,ucwords(strtolower($value['no_npwp'])),1,0,'C');
						$pdf->Cell(60,5,ucwords(strtolower($value['alamat'])),1,0,'C');
						$pdf->Cell(25,5,ucwords(strtolower($value['kode_pos'])),1,1,'C');
						$i++;
					}
				}
			}
			$pdf->Cell(255);
			$pdf->Cell(35,25,'Kepala BPKAD '.str_replace('UPATEN','',$kabupaten),0,1,'L');
			$pdf->Cell(255);
			$pdf->Cell(35,5,'.............................................',0,1,'L');
			$pdf->Cell(255);
			$pdf->Cell(35,5,'NIP.',0,1,'L');
			$pdf->Output('Rekening_DESA.pdf','I');
		}
	}

	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Desa');
		$data = $this->sipapat_model->get_desa($id);
		$image = $this->sipapat_model->get_image_kab();

		$view = 'index';
		if(@$_GET['s']=='print' || @$_GET['s']=='download')
		{
			// $data_meta = array(
			// 			'title' => 'sipapat',
			// 			'keyword' => 'media nusa perkasa',
			// 			'description' => 'sistem informasi terpadu',
			// 			'developer' => 'esoftgreat',
			// 			'author' => 'sipapat',
			// 			'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
			// 			'phone' => '6285290335332',
			// 			'icon' => base_url('images/icon.png'),
			// 		);
			// $this->esg->set_esg('meta', $data_meta);
			$view = 'desa/detail';
			$this->load->view('templates/AdminLTE/meta');
		}
		$this->load->view($view, 
			[
				'id'=>$id,
				'data'=>$data,
				'image'=>$image
			]
		);
		if(@$_GET['s']=='print')
		{
			?>
			<script type="text/javascript">
				window.print();
			</script>
			<?php
		}
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
		if(!empty($_GET['kec']))
		{
			$this->db->where(['kecamatan'=>$_GET['kec']]);
		}
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

		// Redirect output to a client's web browser (Xlsx)
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

	public function pdf_detail($id = 0)
	{
		if(!empty($id))
		{
			$this->esg_model->set_nav_title('Detail Desa');
			$data = $this->sipapat_model->get_desa($id);
			$image = $this->sipapat_model->get_image_kab();

			$teks1 = 'PEMERINTAH KABUPATEN PATI';
			$teks2 = 'KECAMATAN '.@$data['kecamatan'];
			$teks3 = 'DESA '.$data['nama'];
			$teks4 = 'Alamat Kantor Kepala Desa '.strtolower(@$data['nama']).' '.substr(@$data['alamat'],0,20).' Kec. '.strtolower(@$data['kecamatan']).' kab. Pati';
			$teks5 = ': '.@$data['telepon'];
			$teks6 = ': '.@$data['email'];
			$teks7 = ': '.@$data['kode_pos'];
			$teks8 = ': '.@$data['website'];

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

			if(!empty($data))
			{
				unset($data['id']);
				unset($data['created']);
				unset($data['updated']);
				unset($data['ttd_img']);
				unset($data['village_id']);
				unset($data['district_id']);
				unset($data['regency_id']);
				unset($data['province_id']);
				foreach ($data as $key => $value) 
				{
					$pdf->Cell(38);
					$pdf->Cell(20,5, $key, 0,0, 'L');
					$pdf->Cell(30,5, ': '.$value,0,1,'L');
				}
			}
	    
	    $pdf->Output('Detail_DESA.pdf','I');
		}
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
    if(!empty($_GET['kec']))
		{
			$this->db->where(['kecamatan'=>$_GET['kec']]);
		}
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