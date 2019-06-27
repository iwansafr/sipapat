<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->view('index');
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
		$this->load->view('index',['view'=>$view,'sumber'=>$sumber,'bidang'=>$bidang,'bidang_id'=>$bidang_id,'desa_id'=>$desa_id]);
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
		$this->load->view('pembangunan/index',['view'=>$view,'sumber'=>$sumber,'bidang_id'=>$bidang_id,'bidang'=>$bidang,'desa_id'=>$desa_id]);
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
	public function excel($type = '')
	{
		$sumber = $this->pembangunan_model->sumber_dana();
		$bidang = $this->pembangunan_model->bidang();
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
		$where = !empty(@intval($_GET['desa_id'])) ? ' AND pembangunan.desa_id = '.$_GET['desa_id'] : '';
		$where = !empty(@$_GET['kec']) && empty(@intval($_GET['desa_id'])) ? " AND desa.kecamatan = '".$_GET['kec']."'" : $where;
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
		->setCellValue('B1','nama desa')
		->setCellValue('C1','item')
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
}