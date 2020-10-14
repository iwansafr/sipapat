<?php defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Dilan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->model('dilan_model');
		$this->load->model('indonesia_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		ini_set('display_errors', 1);
		$this->esg_model->init();
	}

	public function config()
	{
		$this->load->view('index');
	}

	public function clear_penduduk($id=0)
	{
		$message = ['status'=>'danger','msg'=>'Data Penduduk gagal dihapus'];
		if($this->db->delete('penduduk',['desa_id'=>$id]))
		{
			$message = ['status'=>'success','msg'=>'Data Penduduk berhasil dihapus'];
		}
		$this->load->view('index',$message);
	}

	public function detail_desa()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$penduduk = $this->dilan_model->total_penduduk($desa_id);

		$data = ['penduduk' => $penduduk];
		$this->esg->add_js(base_url('templates/AdminLTE/bower_components/chart.js/Chart.js'));
		$this->load->view('index', $data);
	}

	public function upload()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->dilan_model->upload($_FILES['doc']);
			// $file['desa_id'] = $_POST['desa_id'];
			$data = ['status' => 'success', 'data' => $file];
			output_json($data);
		} else {
			$data = ['status' => 'error'];
			output_json($data);
		}
	}

	public function upload_modify()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->dilan_model->upload($_FILES['doc']);
			// $file['desa_id'] = $_POST['desa_id'];
			$data = ['status' => 'success', 'data' => $file];
			output_json($data);
		} else {
			$data = ['status' => 'error'];
			outpur_json($data);
		}
	}

	public function detail($id = 0)
	{
		if (!empty($id)) {
			$this->load->view('index', ['id' => $id]);
		}
	}

	public function index()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->dilan_model->upload($_FILES['doc']);
			if ($file) {
				$this->esg->add_js(base_url('assets/dilan/script.js'.time()));
			}
		}
		$this->esg->add_js(base_url('assets/dilan/script.js?'.time()));
		$this->load->view('index');
	}

	public function modify()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->dilan_model->upload($_FILES['doc'], '_update');
			if ($file) {
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
		if (is_desa()) {
			$desa_id = $this->sipapat_model->get_desa_id();
			$desa = $this->sipapat_model->get_desa($desa_id);
		}
		$this->load->view('index', ['desa' => $desa]);
	}

	public function insert()
	{
		if (!empty($_POST['file'])) {
			$file = $_POST['file'];
			$file = FCPATH . 'images/modules/dilan/' . $file;
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$reader->setReadDataOnly(TRUE);

			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = array();
			$title = array();
			$i = 0;
			$desa_id = $this->sipapat_model->get_desa_id();
			foreach ($worksheet->getRowIterator() as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE);
				$j = 1;
				$title[0] = 'desa_id';
				foreach ($cellIterator as $cell) {
					$cell_value = $cell->getValue();
					if ($i == 0) {
						// $data[$cell->getValue()] = [];
						$title[] = $cell_value;
						// $title[] = 'desa_id';
					} else {
						$data[$i]['desa_id'] = $desa_id;
						if ($title[$j] == 'TGL_LHR') {
							if (preg_match('~-~', $cell_value)) {
								$data[$i][$title[$j]] = $cell_value;
							} else {
								$dt = new DateTime();
								$data[$i][$title[$j]] = date('Y-m-d', PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cell_value));
								// $data[$i][$title[$j]] = date('Y-m-d', strtotime($cell_value));
							}
						} else {
							$data[$i][$title[$j]] = $cell_value;
						}
					}
					// $data[$i][] = $cell->getValue();
					$j++;
					// $data[$i]['desa_id'] = $desa_id;
				}
				// if($i>0)
				// {
				// 	if($data[$i]['NIK']==0){
				// 		unset($data[$i]);
				// 	}
				// }
				$i++;
			}
			$output = [];
			if (!empty($data)) {
				foreach ($data as $key => $value) 
				{
					if($this->db->insert('penduduk',$value)){
						$output[] = ['status' => 1, 'value'=>$value];
					}else{
						$output[] = ['status' => 0, 'value'=>$value];
					}
				}
				// if ($output = $this->db->insert_batch('penduduk', $data)) {
				// 	echo output_json(['status' => 1]);
				// } else {
				// 	// echo output_json(['status' => 0]);
				// }
			}
			echo output_json($output);
			// echo output_json(array('status'=>0,'data'=>$output,'query'=>$this->db->last_query()));
		}
	}

	public function update()
	{
		if (!empty($_POST['file'])) {
			$file = $_POST['file'];
			$file = FCPATH . 'images/modules/dilan/' . $file;
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$reader->setReadDataOnly(TRUE);

			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = array();
			$title = array();
			$i = 0;
			$desa_id = $this->sipapat_model->get_desa_id();
			foreach ($worksheet->getRowIterator() as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE);
				$j = 1;
				$title[0] = 'desa_id';
				foreach ($cellIterator as $cell) {
					if ($i == 0) {
						// $data[$cell->getValue()] = [];
						$title[] = $cell->getValue();
						// $title[] = 'desa_id';
					} else {
						$data[$i]['desa_id'] = $desa_id;
						if ($title[$j] == 'TGL_LHR') {
							$dt = new DateTime();
							$data[$i][strtolower($title[$j])] = date('Y-m-d', PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cell->getValue()));
						} else {
							$data[$i][strtolower($title[$j])] = $cell->getValue();
						}
					}
					// $data[$i][] = $cell->getValue();
					$j++;
					// $data[$i]['desa_id'] = $desa_id;
				}
				$i++;
			}
			if (!empty($data)) {
				if ($this->db->update_batch('penduduk', $data, 'nik')) {
					echo output_json(['status' => 1]);
				} else {
					echo output_json(['status' => 0]);
				}
			}
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}

	public function download_template()
	{
		$data = $this->db->list_fields('penduduk');
		unset($data[0], $data[1], $data[26], $data[25], $data[27]);
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
		foreach ($data as $key => $value) {
			$j = $i + 1;
			$str .= '->setCellValue("' . $alp[$i] . '1","' . strtoupper($value) . '")';
			$i++;
		}
		$str .= ';';
		eval($str);
		$spreadsheet->getActiveSheet()->setTitle('template ' . date('d-m-Y H'));

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

	public function download_excel()
	{
		$get = $this->input->get();
		$column = $this->db->list_fields('penduduk');
		$data_table = [];
		if (!empty($get['desa_id'])) {
			unset($column[0], $column[1], $column[27], $column[28], $column[26]);
			$data = $column;
			$column = implode(',', $column);
			$this->db->select($column);
			$this->db->from('penduduk');
			if (!empty($get['sort_by'])) {
				$this->db->order_by(@$get['sort_by'], @$get['type']);
				unset($get['sort_by'], $get['type']);
			}
			if (!empty($get['keyword'])) {
				$fields = ['no_kk', 'nik', 'nama', 'alamat'];
				$keyword = $get['keyword'];
				$search = '';
				foreach ($fields as $key => $value) {
					$search .= "$value LIKE '%$keyword%' OR ";
				}
				$search = '( ' . substr($search, 0, -3) . ')';
				$this->db->where($search);
				unset($get['keyword']);
			}
			foreach ($get as $key => $value) {
				$this->db->where([$key => $value]);
			}
			$data_table[] = $data;
			$data = $this->db->get()->result_array();
			if (!empty($data)) {
				$jk = ['1' => 'LAKI-LAKI', '2' => 'PEREMPUAN'];
				$gdr = $this->dilan_model->golongan_darah();
				$agama = $this->dilan_model->agama();
				$status = $this->dilan_model->status();
				$shdk = $this->dilan_model->shdk();
				$pnydng_cct = $this->dilan_model->cacat();
				$pddk_akhir = $this->dilan_model->pendidikan();
				$pekerjaan = $this->dilan_model->pekerjaan();
				foreach ($data as $key => $value) {
					$value['no_kk'] = "'" . @$value['no_kk'];
					$value['nik'] = "'" . @$value['nik'];
					$value['jk'] = @$jk[$value['jk']];
					$value['gdr'] = @$gdr[$value['gdr']];
					$value['agama'] = @$agama[$value['agama']];
					$value['status'] = @$status[$value['status']];
					$value['shdk'] = @$shdk[$value['shdk']];
					$value['pnydng_cct'] = @$pnydng_cct[$value['pnydng_cct']];
					$value['pddk_akhir'] = @$pddk_akhir[$value['pddk_akhir']];
					$value['pekerjaan'] = @$pekerjaan[$value['pekerjaan']];
					$data_table[] = $value;
				}
			}
		}
		$this->load->view(
			'admin/dilan/download_excel',
			[
				'data_table' => $data_table,
			]
		);
	}

	public function form()
	{
		if (is_root()) {
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
		$this->load->view('index');
	}

	public function surat_pengantar_form($id = 0, $ket_id = 0)
	{
		if (!empty($id)) {
			$penduduk = $this->dilan_model->get_penduduk($id);
			$pekerjaan = $this->dilan_model->pekerjaan();
			$desa = $this->sipapat_model->get_desa($penduduk['desa_id']);
			$keterangan = [];
			if (!empty($ket_id)) {
				$keterangan = $this->dilan_model->get_keterangan($ket_id);
				if (!empty($keterangan)) {
					$keterangan = $keterangan[$ket_id];
				}
			}
			$this->load->view('index', ['penduduk' => $penduduk, 'desa' => $desa, 'keterangan' => $keterangan, 'pekerjaan' => $pekerjaan, 'kelamin' => $this->dilan_model->kelamin()]);
			if (!empty($_POST)) {
				$last_id = $this->zea->get_insert_id();
				redirect(base_url('admin/dilan/surat_pengantar/' . $last_id));
			}
		}
	}

	public function surat_pengantar_choose_form($id = 0)
	{
		$data = [];
		$data['keterangan'] = $this->dilan_model->get_keterangan();
		$this->esg_model->set_nav_title('pilih form surat');
		$this->load->view('index', ['data' => $data, 'id' => $id]);
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
		if (!empty($id)) {
			$this->load->model('pengguna_model');
			$this->load->model('perangkat_model');

			$surat    = $this->dilan_model->get_surat($id);
			if (!empty($surat['penduduk_id'])) {
				$penduduk = $this->dilan_model->get_penduduk($surat['penduduk_id']);
				$pekerjaan = $this->dilan_model->pekerjaan();
				$desa     = $this->sipapat_model->get_desa($penduduk['desa_id']);
				$agama    = $this->pengguna_model->agama();
				$user     = $this->session->userdata(base_url() . '_logged_in');
				if (empty($user)) {
					$user = $this->db->get_where('user_desa', ['desa_id' => $desa['id']])->row_array();
					$user['id'] = $user['user_id'];
				}
				$config   = $this->dilan_model->get_config($desa['id'] . '_' . $user['id']);
				$kepdes   = [];
				if (!empty($desa['id'])) {
					$kepdes   = $this->perangkat_model->kepala_desa($desa['id']);
				}

				$penduduk['agama'] = @$agama[$penduduk['agama']];
				// pr($surat);
				// pr($penduduk);
				// pr($desa);

				$image = $this->sipapat_model->get_image_kab();
				if (!curl($image)) {
					msg('Load Halaman Gagal', 'danger');
					die();
				}

				$teks1 = 'PEMERINTAH KABUPATEN PATI';
				$teks2 = 'KECAMATAN ' . @$desa['kecamatan'];
				$teks3 = 'DESA ' . $desa['nama'];
				// $teks4 = 'Alamat Kantor Kepala Desa '.strtolower(@$desa['nama']).' '.substr(@$desa['alamat'],0,20).' Kec. '.strtolower(@$desa['kecamatan']).' kab. '.$desa['kabupaten'];
				$teks4 = ': ' . substr(@$desa['alamat'], 0, 25);
				$teks5 = ': ' . @$desa['telepon'];
				$teks6 = ': ' . @$desa['email'];
				$teks7 = ': ' . @$desa['kode_pos'];
				$teks8 = ': ' . @$desa['website'];

				$this->load->library('pdf');
				$pdf = new FPDF('P', 'mm', 'A4');
				// membuat halaman baru
				$pdf->AddPage();
				// setting jenis font yang akan digunakan
				$pdf->SetFont('Arial', 'B', 7);
				// mencetak string 
				$pdf->Image($image, 0, 10, 40, 30);
				$pdf->Cell(25);
				$pdf->SetFont('Times', 'B', '15');
				$pdf->Cell(0, 5, $teks1, 0, 1, 'C');
				$pdf->Cell(25);
				$pdf->Cell(0, 5, $teks2, 0, 1, 'C');
				$pdf->Cell(25);
				$pdf->SetFont('Times', 'B', '15');
				$pdf->Cell(0, 5, $teks3, 0, 1, 'C');
				$pdf->Cell(22);
				$pdf->SetFont('Times', '', '13');
				// $pdf->MultiCell(0,5,$teks4,0,1,false);
				// $pdf->Cell(0,5,$teks4,0,1,'L');

				/*form lama*/
				$pdf->Cell(30, 5, 'Alamat Kantor', 0, 0, 'L');
				$pdf->Cell(60, 5, $teks4, 0, 0, 'L');
				$pdf->Cell(20);
				$pdf->Cell(20, 5, 'Telepon', 0, 0, 'L');
				$pdf->Cell(30, 5, $teks5, 0, 1, 'L');
				$pdf->Cell(22);
				$pdf->Cell(30, 5, 'Email', 0, 0, 'L');
				$pdf->Cell(60, 5, $teks6, 0, 0, 'L');
				$pdf->Cell(20);
				$pdf->Cell(20, 5, 'Kode Pos', 0, 0, 'L');
				$pdf->Cell(30, 5, $teks7, 0, 1, 'L');
				$pdf->Cell(22);
				$pdf->Cell(30, 5, 'Website', 0, 0, 'L');
				$pdf->Cell(60, 5, $teks8, 0, 1, 'L');
				/*form lama */

				// $pdf->Cell(0,0,'',0,1,'C');
				// $pdf->Cell(22);
				// $pdf->MultiCell(0,5,ucwords(strtolower($desa['alamat'].' Email: '.$desa['email'].' Kode Pos: '.$desa['kode_pos'])),0,'C',false);
				// $pdf->Cell(22);
				// $pdf->Cell(0,5,' Website: '.$desa['website'],0,1,'C');

				$pdf->SetLineWidth(1);
				$pdf->Line(10, 45, 200, 45);
				$pdf->SetLineWidth(0);
				$pdf->Line(10, 46, 200, 46);
				$pdf->Ln(10);

				$pdf->Cell(0, 5, 'No. Kode Desa : ' . $desa['kode'], 0, 1, 'L');
				$pdf->Ln(10);
				$pdf->Cell(200, 5, 'SURAT KETERANGAN/PENGANTAR', 0, 1, 'C');
				$pdf->SetLineWidth(0);
				$pdf->Line(70, 70, 150, 70);
				$pdf->Ln(1);
				$pdf->Cell(200, 5, 'Nomor: ' . $surat['nomor'], 0, 1, 'C');
				$pdf->Ln(10);
				$pdf->Cell(150, 5, 'Yang bertanda tangan di bawah ini, menerangkan bahwa : ', 0, 1, 'C');
				$pdf->Ln(5);
				$pdf->Cell(60, 5, '1. Nama', 0, 0, 'L');
				$pdf->Cell(0, 5, ': ' . ucfirst(strtolower($penduduk['nama'])), 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '2. Tempat, tanggal lahir', 0, 0, 'L');
				$pdf->Cell(0, 5, ': ' . ucfirst(strtolower($penduduk['tmpt_lhr'])) . ', ' . content_date($penduduk['tgl_lhr']), 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '3. Kewarganegaraan/ Agama', 0, 0, 'L');
				$pdf->Cell(0, 5, ': Indonesia/ ' . $penduduk['agama'], 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '4. Pekerjaan', 0, 0, 'L');
				$pdf->Cell(0, 5, ': ' . @$pekerjaan[$penduduk['pekerjaan']], 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '5. Tempat Tinggal', 0, 0, 'L');
				$pdf->Cell(0, 5, ': ' . ucfirst(strtolower($penduduk['alamat'])) . ' RT ' . $penduduk['no_rt'] . ' RW ' . $penduduk['no_rw'], 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(5);
				$pdf->Cell(55, 5, 'Kabupaten', 0, 0, 'L');
				$pdf->Cell(40, 5, ': ' . ucfirst(strtolower($desa['kabupaten'])), 0, 0, 'L');
				$pdf->Cell(5);
				$pdf->Cell(17, 5, 'Provinsi', 0, 0, 'L');
				$provinsi = $desa['provinsi'];
				if (preg_match('~ ~', $provinsi)) {
					$tmp_provinsi = explode(' ', $provinsi);
					$provinsi = '';
					foreach ($tmp_provinsi as $key => $value) {
						$provinsi .= ucfirst(strtolower($value)) . ' ';
					}
				} else {
					$provinsi = ucfirst(strtolower($provinsi));
				}
				$pdf->Cell(0, 5, ': ' . $provinsi, 0, 1, 'L');
				$pdf->ln(2);
				$pdf->Cell(60, 5, '6. Surat Bukti', 0, 0, 'L');
				$pdf->Cell(52, 5, ': KTP : ' . $penduduk['nik'], 0, 0, 'L');
				// $pdf->Cell(5);
				$pdf->Cell(10, 5, 'KK', 0, 0, 'R');
				$pdf->Cell(0, 5, ': ' . $penduduk['no_kk'], 0, 1, 'L');
				$pdf->Ln(2);
				// $pdf->Cell(5);
				$pdf->Cell(60, 5, '7. Keperluan', 0, 0, 'L');
				$pdf->Cell(2, 5, ': ', 0, 0, 'L');
				$pdf->MultiCell(0, 5, ucfirst(strtolower($surat['keperluan'])), 0, 'L', false);
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '8. Berlaku Mulai', 0, 0, 'L');
				$pdf->Cell(0, 5, ': ' . content_date($surat['berlaku_mulai']) . ' s/d ' . content_date($surat['berlaku_sampai']), 0, 1, 'L');
				$pdf->Ln(2);
				$pdf->Cell(60, 5, '9. Keterangan lain-lain *)', 0, 0, 'L');
				$pdf->Cell(2, 5, ': ', 0, 0, 'L');
				$pdf->MultiCell(0, 5, @ucfirst($surat['keterangan']), 0, 'L', false);
				$pdf->Ln(2);

				$ln_kep = strlen($surat['keperluan']);
				$ln_ket = strlen($surat['keterangan']);
				$tot_ln = $ln_kep + $ln_ket;
				if ($tot_ln <= 100) {
					$height_stem = 205;
				} else if ($tot_ln <= 200) {
					$height_stem = 210;
				} else if ($tot_ln <= 300) {
					$height_stem = 220;
				} else if ($tot_ln <= 400) {
					$height_stem = 225;
				}

				// $pdf->cell(2,5, $ln_kep);
				// $pdf->cell(50);
				// $pdf->cell(2,5, $ln_ket);
				$pdf->Ln(10);
				$pdf->Cell(150, 5, 'Demikian untuk menjadikan maklum bagi yang berkepentingan', 0, 1, 'C');
				// $pdf->Cell(50);
				// $pdf->Cell(18,5,'Nomor',0,0,'L');
				// $pdf->Cell(50,5,': '.$surat['nomor'],0,1,'L');
				$pdf->Cell(50);
				$pdf->Cell(18, 5, 'Tanggal', 0, 0, 'L');
				$pdf->Cell(50, 5, ': ' . content_date($surat['tgl']), 0, 1, 'L');

				$pdf->Ln(15);

				$pdf->Cell(190, 5, 'Mengetahui', 0, 1, 'C');
				$pdf->Cell(65, 5, 'Tandatangan Pemegang', 0, 0, 'C');
				if (!empty($config['show_camat'])) {
					$pdf->Cell(60, 5, 'Camat ' . $desa['kecamatan'], 0, 0, 'C');
				} else {
					$pdf->Cell(60, 5, '', 0, 0, 'C');
				}
				if (!empty($desa['ttd_img'])) {
					if (!empty($config['show_ttd'])) {
						// $pdf->Image(image_module('desa',$desa['id'].'/'.$desa['ttd_img']),135,165,40,30);
						$pdf->Image(image_module('desa', $desa['id'] . '/' . $desa['ttd_img']), 135, $height_stem, 55, 40);
					}
				}
				$pdf->Cell(60, 5, 'Kepala Desa ' . ucfirst(strtolower($desa['nama'])), 0, 0, 'C');
				$pdf->Ln(30);

				$pdf->Cell(65, 5, $penduduk['nama'], 0, 0, 'C');
				$line_len = 107 + $ln_ket;
				$pdf->SetLineWidth(0);
				// $pdf->Line(61,$line_len,24,$line_len);
				if (!empty($config['show_camat'])) {
					$pdf->Cell(60, 5, '................................', 0, 0, 'C');
				} else {
					$pdf->Cell(60, 5, '', 0, 0, 'C');
				}
				$pdf->SetLineWidth(0);
				// $pdf->Line(123,$line_len,87,$line_len);
				if (!empty($config['show_kades'])) {
					$pdf->Cell(60, 5, @$kepdes['nama'], 0, 1, 'C');
				}
				$pdf->SetLineWidth(0);
				// $pdf->Line(183,$line_len,147,$line_len);
				$pdf->Ln(1);
				$pdf->Cell(65);
				if (!empty($config['show_camat'])) {
					$pdf->Cell(60, 5, 'NIP. .........................', 0, 0, 'C');
				} else {
					$pdf->Cell(60, 5, '', 0, 0, 'C');
				}
				if (!empty($config['show_nip'])) {
					$pdf->Cell(60, 5, 'NIP. ' . @$kepdes['nik'], 0, 1, 'C');
				} else {
					$pdf->Cell(60, 5, '', 0, 1, 'C');
				}
				$pdf->Output('Surat_Keterangan_Pengantar.pdf', 'I');
			}
		}
	}

	public function surat_group()
	{
		$data = $this->dilan_model->surat_group();
		$this->load->view('index', ['data' => $data]);
	}

	public function surat_list($group_id = 0)
	{
		$this->load->view('index', ['group_id' => $group_id]);
	}

	public function clear_surat_list()
	{
		$this->load->view('dilan/surat_list');
	}

	public function surat_used()
	{
		$this->load->view('index');
	}
	public function clear_surat_used()
	{
		$this->load->view('dilan/surat_used', ['sipapat_config' => $this->esg->get_esg('sipapat_config')]);
	}

	public function surat_used_detail($id = 0)
	{
		$surat = $this->dilan_model->surat_group($id);
		$this->load->view('index', ['surat' => $surat, 'id' => $id]);
	}

	public function surat_pengajuan($id = 0)
	{
		$this->load->view('index', ['id' => $id]);
	}
	public function surat_pengajuan_list()
	{
		$this->load->view('index');
	}
	public function surat_pengajuan_clear()
	{
		$this->load->view('admin/dilan/surat_pengajuan_list');
	}

	public function kecamatan_list()
	{
		$this->load->view('index', ['kec_option' => $this->pengguna_model->get_kecamatan()]);
	}

	public function desa_list()
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option' => $this->pengguna_model->get_desa($kec)]);
	}

	public function kecamatan_surat_list()
	{
		$this->load->view('index', ['kec_option' => $this->pengguna_model->get_kecamatan()]);
	}

	public function desa_surat_list()
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option' => $this->pengguna_model->get_desa($kec)]);
	}

	public function penduduk_excel()
	{
		$desa_id = $this->sipapat_model->get_desa_id();
		$data = $this->db->get_where('penduduk', ['desa_id' => $desa_id])->result_array();
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
			->setCellValue('A1', strtoupper('no'))
			->setCellValue('B1', strtoupper('nik'))
			->setCellValue('C1', strtoupper('username'))
			->setCellValue('D1', strtoupper('nama desa'))
			->setCellValue('E1', strtoupper('nama'))
			->setCellValue('F1', strtoupper('tempat lahir'))
			->setCellValue('G1', strtoupper('tgl lahir'))
			->setCellValue('H1', strtoupper('kelamin'))
			->setCellValue('I1', strtoupper('alamat'))
			->setCellValue('J1', strtoupper('telepon'))
			->setCellValue('K1', strtoupper('agama'))
			->setCellValue('L1', strtoupper('status perkawinan'))
			->setCellValue('M1', strtoupper('pendidikan terakhir'))
			->setCellValue('N1', strtoupper('jamkes'))
			->setCellValue('O1', strtoupper('jabatan'))
			->setCellValue('P1', strtoupper('no sk'))
			->setCellValue('Q1', strtoupper('sk penetapan kembali'))
			->setCellValue('R1', strtoupper('tgl pelantikan'))
			->setCellValue('S1', strtoupper('akhir masa jabatan'))
			->setCellValue('T1', strtoupper('pelantik'))
			->setCellValue('U1', strtoupper('bengkok'))
			->setCellValue('V1', strtoupper('penghasilan'))
			->setCellValue('W1', strtoupper('riwayat pendidikan'))
			->setCellValue('X1', strtoupper('riwayat diklat'));

		// Miscellaneous glyphs, UTF-8
		$i = 2;
		$j = 1;
		foreach ($data as $key => $value) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $i, $j)
				// ->setCellValueExplicit('B'.$i, strtoupper($value['nik']),PHPExcel_Cell_DataType::TYPE_STRING)
				->setCellValue('B' . $i, "'" . strtoupper($value['nik']))
				->setCellValue('C' . $i, strtoupper($value['username']))
				->setCellValue('D' . $i, strtoupper($value['nama_desa']))
				->setCellValue('E' . $i, strtoupper($value['nama']))
				->setCellValue('F' . $i, strtoupper($value['tempat_lahir']))
				->setCellValue('G' . $i, strtoupper($value['tgl_lahir']))
				->setCellValue('H' . $i, strtoupper($kelamin[$value['kelamin']]))
				->setCellValue('I' . $i, strtoupper($value['alamat']))
				->setCellValue('J' . $i, strtoupper($value['telepon']))
				->setCellValue('K' . $i, strtoupper($agama[$value['agama']]))
				->setCellValue('L' . $i, strtoupper($status_perkawinan[$value['status_perkawinan']]))
				->setCellValue('M' . $i, strtoupper($pendidikan_terakhir[$value['pendidikan_terakhir']]))
				->setCellValue('N' . $i, strtoupper($value['jamkes']))
				->setCellValue('O' . $i, strtoupper($jabatan[$value['jabatan']]))
				->setCellValue('P' . $i, strtoupper($value['no_sk']))
				->setCellValue('Q' . $i, strtoupper($value['sk_penetapan_kembali']))
				->setCellValue('R' . $i, strtoupper($value['tgl_pelantikan']))
				->setCellValue('S' . $i, strtoupper($value['akhir_masa_jabatan']))
				->setCellValue('T' . $i, strtoupper($value['pelantik']))
				->setCellValue('U' . $i, strtoupper($value['bengkok']))
				->setCellValue('V' . $i, strtoupper($value['penghasilan']))
				->setCellValue('W' . $i, strtoupper($value['riwayat_pendidikan']))
				->setCellValue('X' . $i, strtoupper($value['riwayat_diklat']));
			$i++;
			$j++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('data perangkat ' . date('d-m-Y H'));

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

	public function laporan()
	{
		$data = $this->dilan_model->laporan();
		$this->load->view('index', ['data' => $data]);
	}

	public function list($type = '')
	{
		$this->db->cache_off();
		$data = [];
		if ($type == 'pengajuan') {
			$data['aktif_num'] = 2;
			$data['type'] = $type;
		} else {
			$data['aktif_num'] = 1;
			$data['type'] = '';
		}
		$this->load->view('index', $data);
	}

	public function filter_by()
	{
		$data = [];
		if (!empty($_GET['group'])) {
			$group = $_GET['group'];
			switch ($group) {
				case 'gdr':
					$data['gdr'] = $this->dilan_model->golongan_darah();
					break;
				case 'agama':
					$data['agama'] = $this->dilan_model->agama();
					break;
				case 'jk':
					$data['jk'] = $this->dilan_model->kelamin();
					break;
				case 'status':
					$data['status'] = $this->dilan_model->status();
					break;
				case 'shdk':
					$data['shdk'] = $this->dilan_model->shdk();
					break;
				case 'pnydng_cct':
					$data['pnydng_cct'] = $this->dilan_model->cacat();
					break;
				case 'pddk_akhir':
					$data['pddk_akhir'] = $this->dilan_model->pendidikan();
					break;
				case 'pekerjaan':
					$data['pekerjaan'] = $this->dilan_model->pekerjaan();
					break;
				case 'umur':
					$data['umur'] = $this->dilan_model->umur();
					break;
				default:
					$data['jk'] = $this->dilan_model->kelamin();
					break;
			}
		}
		$this->load->view('index', ['data' => $data]);
	}

	public function clear_list($type = '')
	{
		$this->db->cache_off();
		$data = [];
		if ($type == 'pengajuan') {
			$data['aktif_num'] = 2;
			$data['type'] = $type;
		} else {
			$data['aktif_num'] = 1;
			$data['type'] = '';
		}
		$this->load->view('dilan/list', $data);
	}



	public function upload_penduduk()
	{
		$desa = [];
		if(is_root()){
			$sipapat_config = $this->esg->get_esg('sipapat_config');
			if(!empty($sipapat_config['regency_id']))
			{
				$this->db->select('id,nama,kecamatan');
				$desa = $this->db->get_where('desa',['regency_id'=>$sipapat_config['regency_id']])->result_array();
			}
		}
		$this->esg->add_js(base_url('assets/dilan/upload.js?'.time()));
		$this->load->view('index',['desa'=>$desa]);
	}

	private function special_col($data, $cell_value)
	{
		if(is_numeric($cell_value))
		{
			return $cell_value;
		}else{
			foreach ($data as $key => $value) 
			{
				if($value == $cell_value)
				{
					$cell_value = $key;
					break;
				}else{
					$cell_value = 0;
				}
			}
			return $cell_value;
		}
	}

	public function upload_process()
	{
		if(!empty($_FILES['file']['tmp_name']))
		{
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$reader->setReadDataOnly(TRUE);
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = array();
			$title = array();
			$i = 0;
			$desa_id = $_POST['desa_id'];
			// $desa_id = -1;
			$nik = [];

			$gdr = $this->dilan_model->golongan_darah();
			$kelamin = $this->dilan_model->kelamin();
			$agama = $this->dilan_model->agama();
			$status = $this->dilan_model->status();
			$shdk = $this->dilan_model->shdk();
			$pnydng_cct = $this->dilan_model->cacat();
			$pddk_akhir = $this->dilan_model->pendidikan();
			$pekerjaan = $this->dilan_model->pekerjaan();

			$all_nik = [];

			foreach ($worksheet->getRowIterator() as $row) 
			{
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE);
				$j = 1;
				$title[0] = 'desa_id';
				foreach ($cellIterator as $cell) 
				{
					$cell_value = $cell->getValue();
					if ($i == 0) {
						if($cell_value != ''){
							$title[] = strtolower($cell_value);
						}
					} else {
						if(!empty($title[$j])){
							if(strtolower($title[$j]) == 'nik'){
								if(empty($cell_value)){
									break;
								}
								if(in_array($cell_value, $all_nik)){
									break;
								}
								$all_nik[] = $cell_value;
								$nik[] = $cell_value;
							}
							if($title[$j] == 'jk')
							{
								$cell_value = $this->special_col($kelamin,$cell_value);
							}
							if($title[$j] == 'gdr')
							{
								$cell_value = $this->special_col($gdr,$cell_value);
								if($cell_value==0){
									$cell_value = 13;
								}
							}
							if($title[$j] == 'agama')
							{
								$cell_value = $this->special_col($agama,$cell_value);
								if($cell_value==0){
									$cell_value = 8;
								}
							}
							if($title[$j] == 'status')
							{
								$cell_value = $this->special_col($status,$cell_value);
								if($cell_value==0){
									$cell_value = 1;
								}
							}
							if($title[$j] == 'shdk')
							{
								$cell_value = $this->special_col($shdk,$cell_value);
								if($cell_value==0){
									$cell_value = 11;
								}
							}
							if($title[$j] == 'pnydng_cct')
							{
								$cell_value = $this->special_col($pnydng_cct,$cell_value);
							}
							if($title[$j] == 'pddk_akhir')
							{
								$cell_value = $this->special_col($pddk_akhir,$cell_value);
								if($cell_value==0){
									$cell_value = 1;
								}
							}
							if($title[$j] == 'pekerjaan')
							{
								$cell_value = $this->special_col($pekerjaan,$cell_value);
								if($cell_value==0){
									$cell_value = 89;
								}
							}
							$data[$i]['desa_id'] = $desa_id;
							$data[$i][$title[$j]] = $cell_value;
							$j++;
						}
					}

				}
				$i++;
				if($i % 1000 == 0){
					$this->db->select('nik');
					$this->db->where_in('nik',$nik);
					// $this->db->limit(25);
					$check_exist[] = $this->db->get('penduduk')->result_array();
					$nik = [];
				}
			}
			$exist_output = [];
			if(!empty($check_exist)){
				foreach ($check_exist as $key => $value) 
				{
					foreach ($value as $item) 
					{
						$exist_output[] = $item['nik'];
					}
				}
				foreach ($exist_output as $key => $value) 
				{
					foreach ($data as $dkey => $dvalue) 
					{
						if($dvalue['nik'] == $value){
							unset($data[$dkey]);
						}
					}
				}
				output_json(['status'=>'warning','msg'=>'Ada data penduduk yang sudah terdaftar','check_exist'=>$exist_output,'data'=>$data]);
			}else{
				output_json(['status'=>'success','msg'=>'Tidak Ada data duplikat','data'=>$data]);
			}
		}else{
			output_json(['status'=>'danger','msg'=>'File tidak valid,silahkan upload file excel yang valid']);
		}
		// echo json_encode(['data'=>$_POST,'file'=>$_FILES]);
	}
	public function insert_penduduk()
	{
		if(!empty($_POST['data']))
		{
			$data_tmp = $_POST['data'];
			$data = [];
			$dt = new DateTime();
			foreach ($data_tmp as $key => $value)
			{
				$value['tgl_lhr'] = (is_string($value['tgl_lhr']) && !empty($value['tgl_lhr'])) ? date('Y-m-d',strtotime($value['tgl_lhr'])) : '0000-00-00';
				$data[] = $value;
			}
			if($this->db->insert_batch('penduduk',$data)){
				output_json(['status'=>'success','msg'=>'50 Data berhasil di upload']);
			}else{
				output_json(['status'=>'danger','msg'=>'Data gagal di upload']);
			}
		}else{
			output_json(['data kosong']);
		}
	}
}
