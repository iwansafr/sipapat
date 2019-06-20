<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Perangkat extends CI_Controller
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
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function excel($kelompok = '')
	{
		$jabatan = $this->pengguna_model->jabatan();
		$pengguna = $this->pengguna_model->get_pengguna();
		$kelamin = ['Perempuan','Laki-laki'];
		$agama = 
			[
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
		$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		$pendidikan_terakhir = 
			[
				'1'=>strtoupper('akademi/diploma iii/s.muda'),
				'2'=>strtoupper('belum tamat sd/sederajat'),
				'3'=>strtoupper('diploma i/ii'),
				'4'=>strtoupper('diploma iv/strata i'),
				'5'=>strtoupper('slta/sederajat'),
				'6'=>strtoupper('sltp/sederajat'),
				'7'=>strtoupper('strata ii'),
				'8'=>strtoupper('strata iii'),
				'9'=>strtoupper('tamat sd/sederajat'),
				'10'=>strtoupper('tidak/belum sekolah')
			];
		$kelompok = empty($kelompok) ? 'perangkat': $kelompok;
		$module = ['1'=>'','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$kelompok = array_keys($module_title,$kelompok);
		$kelompok = $kelompok[0];
		$jabatan = $jabatan[$kelompok];
		$desa_id = empty($_GET['desa_id']) && is_desa() ? $pengguna['desa_id'] : @intval($_GET['desa_id']);
		$where = !empty(@intval($desa_id)) ? ' AND perangkat_desa.desa_id = '.$desa_id : '';
		$where = !empty(@$_GET['kec']) && empty(@intval($desa_id)) ? " AND desa.kecamatan = '".$_GET['kec']."'" : $where;
		$data = $this->db->query
		('
			SELECT 
				perangkat_desa.*,user.username,desa.nama AS nama_desa
			FROM 
				perangkat_desa
			INNER JOIN 
				desa 
			INNER JOIN 
				user 
			WHERE 
				perangkat_desa.user_id = user.id
			AND 
				perangkat_desa.desa_id = desa.id
			AND 
				kelompok = ?
		'.$where, $kelompok)->result_array();
		// pr($data);
		// pr($this->db->last_query());die();
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
		->setCellValue('B1','username')
		->setCellValue('C1','nama desa')
		->setCellValue('D1','nama')
		->setCellValue('E1','tempat lahir')
		->setCellValue('F1','tgl lahir')
		->setCellValue('G1','kelamin')
		->setCellValue('H1','alamat')
		->setCellValue('I1','telepon')
		->setCellValue('J1','agama')
		->setCellValue('K1','status perkawinan')
		->setCellValue('L1','pendidikan terakhir')
		->setCellValue('M1','jamkes')
		->setCellValue('N1','jabatan')
		->setCellValue('O1','no sk')
		->setCellValue('P1','sk penetapan kembali')
		->setCellValue('Q1','tgl pelantikan')
		->setCellValue('R1','akhir masa jabatan')
		->setCellValue('S1','pelantik')
		->setCellValue('T1','bengkok')
		->setCellValue('U1','penghasilan')
		->setCellValue('V1','riwayat pendidikan')
		->setCellValue('W1','riwayat diklat');

		// Miscellaneous glyphs, UTF-8
		$i=2;
		$j = 1;
		foreach($data as $key => $value) 
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$j)
			->setCellValue('B'.$i,$value['username'])
			->setCellValue('C'.$i,$value['nama_desa'])
			->setCellValue('D'.$i,$value['nama'])
			->setCellValue('E'.$i,$value['tempat_lahir'])
			->setCellValue('F'.$i,$value['tgl_lahir'])
			->setCellValue('G'.$i,$kelamin[$value['kelamin']])
			->setCellValue('H'.$i,$value['alamat'])
			->setCellValue('I'.$i,$value['telepon'])
			->setCellValue('J'.$i,$agama[$value['agama']])
			->setCellValue('K'.$i,$status_perkawinan[$value['status_perkawinan']])
			->setCellValue('L'.$i,$pendidikan_terakhir[$value['pendidikan_terakhir']])
			->setCellValue('M'.$i,$value['jamkes'])
			->setCellValue('N'.$i,$jabatan[$value['jabatan']])
			->setCellValue('O'.$i,$value['no_sk'])
			->setCellValue('P'.$i,$value['sk_penetapan_kembali'])
			->setCellValue('Q'.$i,$value['tgl_pelantikan'])
			->setCellValue('R'.$i,$value['akhir_masa_jabatan'])
			->setCellValue('S'.$i,$value['pelantik'])
			->setCellValue('T'.$i,$value['bengkok'])
			->setCellValue('U'.$i,$value['penghasilan'])
			->setCellValue('V'.$i,$value['riwayat_pendidikan'])
			->setCellValue('W'.$i,$value['riwayat_diklat']);
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data perangkat '.date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="data perangkat.xlsx"');
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

	public function pdf($kelompok = 'perangkat')
	{
		$jabatan = $this->pengguna_model->jabatan();
		$pengguna = $this->pengguna_model->get_pengguna();
		$kelamin = ['Perempuan','Laki-laki'];
		$agama = 
			[
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
		$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		$pendidikan_terakhir = 
			[
				'1'=>strtoupper('akademi/diploma iii/s.muda'),
				'2'=>strtoupper('belum tamat sd/sederajat'),
				'3'=>strtoupper('diploma i/ii'),
				'4'=>strtoupper('diploma iv/strata i'),
				'5'=>strtoupper('slta/sederajat'),
				'6'=>strtoupper('sltp/sederajat'),
				'7'=>strtoupper('strata ii'),
				'8'=>strtoupper('strata iii'),
				'9'=>strtoupper('tamat sd/sederajat'),
				'10'=>strtoupper('tidak/belum sekolah')
			];
		$kelompok = empty($kelompok) ? 1: $kelompok;
		$module = ['1'=>'','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];

		$kelompok = array_keys($module_title,$kelompok);
		$kelompok = $kelompok[0];
		$jabatan = $jabatan[$kelompok];

		$this->load->library('pdf');
		$pdf = new FPDF('L','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',7);
    // mencetak string 
    $pdf->Cell(250,10,'SIPAPAT',0,1,'C');
    $pdf->SetFont('Arial','B',6);
    $pdf->Cell(250,10,'DATA '.$kelompok ,0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',7);

		$pdf->Cell(8,6,'no',1,0);
		$pdf->Cell(22,6,'nama desa',1,0);
		$pdf->Cell(45,6,'nama',1,0);
		$pdf->Cell(18,6,'tempat lahir',1,0);
		$pdf->Cell(18,6,'tgl lahir',1,0);
		$pdf->Cell(18,6,'kelamin',1,0);
		$pdf->Cell(18,6,'telepon',1,0);
		$pdf->Cell(18,6,'agama',1,0);
		$pdf->Cell(18,6,'status',1,0);
		$pdf->Cell(25,6,'pendidikan terakhir',1,0);
		$pdf->Cell(18,6,'jabatan',1,0);
		$pdf->Cell(30,6,'no sk',1,0);
		$pdf->Cell(20,6,'akhir m jabatan',1,1);

    $pdf->SetFont('Arial','',7);

    $desa_id = empty($_GET['desa_id']) && is_desa() ? $pengguna['desa_id'] : @intval($_GET['desa_id']);
		$where = !empty(@intval($desa_id)) ? ' AND perangkat_desa.desa_id = '.$desa_id : '';
		$where = !empty(@$_GET['kec']) && empty(@intval($desa_id)) ? " AND desa.kecamatan = '".$_GET['kec']."'" : $where;
    $data = $this->db->query
		('
			SELECT 
				perangkat_desa.*,user.username,desa.nama AS nama_desa
			FROM 
				perangkat_desa
			INNER JOIN 
				desa 
			INNER JOIN 
				user 
			WHERE 
				perangkat_desa.user_id = user.id
			AND 
				perangkat_desa.desa_id = desa.id
			AND 
				kelompok = ?
		'.$where, @intval($kelompok))->result_array();
		// pr($this->db->last_query());die();
    $i = 1;
    foreach ($data as $key => $value)
    {
    	$pdf->Cell(8,6,$i,1,0);
			$pdf->Cell(22,6,$value['nama_desa'],1,0);
			$pdf->Cell(45,6,$value['nama'],1,0);
			$pdf->Cell(18,6,$value['tempat_lahir'],1,0);
			$pdf->Cell(18,6,$value['tgl_lahir'],1,0);
			$pdf->Cell(18,6,$kelamin[$value['kelamin']],1,0);
			$pdf->Cell(18,6,$value['telepon'],1,0);
			$pdf->Cell(18,6,$agama[$value['agama']],1,0);
			$pdf->Cell(18,6,$status_perkawinan[$value['status_perkawinan']],1,0);
			$pdf->Cell(25,6,$pendidikan_terakhir[$value['pendidikan_terakhir']],1,0);
			$pdf->Cell(18,6,$jabatan[$value['jabatan']],1,0);
			$pdf->Cell(30,6,$value['no_sk'],1,0);
			$pdf->Cell(20,6,$value['akhir_masa_jabatan'],1,1);
      $i++;
    }
    $pdf->Output();
	}


	public function desa($group = '')
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option'=>$this->pengguna_model->get_desa($kec),'group'=>$group]);
	}

	public function kecamatan($group = '')
	{
		$this->load->view('index', ['kec_option'=>$this->pengguna_model->get_kecamatan(),'group'=>$group]);
	}

	public function edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function detail($id = 0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$module = ['1'=>'','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$module_title = ['1'=>'perangkat','2'=>'bpd','3'=>'lpmd','4'=>'pkk','5'=>'karang_taruna','6'=>'rt','7'=>'rw','8'=>'kpmd','9'=>'linmas'];
		$data = $this->db->query('SELECT * FROM perangkat_desa WHERE id = ?', $id)->row_array();
		$this->esg_model->set_nav_title('Detail '.$module_title[$data['kelompok']]);
		$kelamin = ['Perempuan','Laki-laki'];
		$agama = 
			[
				'1'=>'Islam',
				'2'=>'Kristen',
				'3'=>'Katholik',
				'4'=>'Hindu',
				'5'=>'Budha',
				'6'=>'Khonghucu',
				'7'=>'Kepercayaan thd Tuhan yang Maha Esa Lainnya'
			];
		$status_perkawinan = ['Belum Kawin','Cerai Hidup','Cerai Mati','Kawin'];
		$pendidikan_terakhir = 
			[
				'1'=>strtoupper('akademi/diploma iii/s.muda'),
				'2'=>strtoupper('belum tamat sd/sederajat'),
				'3'=>strtoupper('diploma i/ii'),
				'4'=>strtoupper('diploma iv/strata i'),
				'5'=>strtoupper('slta/sederajat'),
				'6'=>strtoupper('sltp/sederajat'),
				'7'=>strtoupper('strata ii'),
				'8'=>strtoupper('strata iii'),
				'9'=>strtoupper('tamat sd/sederajat'),
				'10'=>strtoupper('tidak/belum sekolah')
			];
		$view = 'index';
		if(@$_GET['s']=='print' || @$_GET['s']=='download')
		{
			$data_meta = array(
						'title' => 'sipapat',
						'keyword' => 'media nusa perkasa',
						'description' => 'sistem informasi terpadu',
						'developer' => 'esoftgreat',
						'author' => 'sipapat',
						'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
						'phone' => '6285290335332',
						'icon' => base_url('images/icon.png'),
					);
			$this->esg->set_esg('meta', $data_meta);
			$view = 'perangkat/detail';
			$this->load->view('templates/AdminLTE/meta');
		}
		$this->load->view($view, 
			[
				'id'=>$id,
				'jabatan'=>$jabatan,
				'pengguna'=>$pengguna,
				'data'=>$data,
				'kelamin'=>$kelamin,
				'agama'=>$agama,
				'status_perkawinan'=>$status_perkawinan,
				'pendidikan_terakhir'=>$pendidikan_terakhir,
				'module_title'=>$module_title,
				'kelompok'=>@intval($data['kelompok'])
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
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan]);
	}

	public function clear_list($task = '')
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->load->view('perangkat/index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task]);
	}

	public function bpd($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' BPD ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function lpmd($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' LPMD ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function pkk($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' PKK ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function karang_taruna($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' karang_taruna ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function rt($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' rt ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function rw($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' rw ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function kpmd($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' kpmd ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
	public function linmas($task = 'list', $id=0)
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$jabatan = $this->pengguna_model->jabatan();
		$this->esg_model->set_nav_title($task.' linmas ');
		$this->load->view('index', ['pengguna'=>$pengguna,'jabatan'=>$jabatan,'task'=>$task,'id'=>$id]);
	}
}