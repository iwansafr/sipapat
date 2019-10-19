<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bumdes extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('sipapat_model');
		$this->load->model('pengguna_model');
		$this->load->model('bumdes_model');
		$this->load->model('pembangunan_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	// public function detail()
	// {
	// 	$data             = $this->bumdes_model->get_bumdes(@intval($_GET['id']));
	// 	$alamat           = $this->bumdes_model->get_alamat($data['alamat']);
	// 	$pengurus         = $this->bumdes_model->get_alamat($data['pengurus']);
	// 	$pengawas         = $this->bumdes_model->get_alamat($data['pengawas']);
	// 	$data['alamat']   = $alamat;
	// 	$data['pengurus'] = $pengurus;
	// 	$data['pengawas'] = $pengawas;

	// 	$this->load->view('index',['data'=>$data,'kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	// }

	public function index()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna]);
	}

	public function edit()
	{
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function detail()
	{
		$id        = @intval($_GET['id']);
		$pengguna  = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$status    = true;
		$data      = [];
		$alamat    = '';

		if(is_desa())	
		{
			if($id!=$bumdes_id)
			{
				$status = false;
			}
		}
		if($status)
		{
			$data             = $this->bumdes_model->get_bumdes($id);
			$alamat           = $this->bumdes_model->get_alamat($data['alamat']);
			$data['alamat']   = $alamat;
		}
		$this->load->view('index',['id'=>$id,'status'=>$status,'data'=>$data]);
	}

	public function list()
	{
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}

	public function clear_list()
	{
		$this->load->view('bumdes/list',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan()]);
	}


	public function pengurus_edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$id = @intval($_GET['id']);
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id,'id'=>$id]);
	}

	public function pengurus()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function pengurus_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('bumdes/pengurus',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}


	public function lembaga_edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$this->esg->add_js(base_url('assets/bumdes/script.js'));
		$this->load->view('index',['kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function kecamatan_lembaga()
	{
		$this->load->view('index',['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}

	public function lembaga()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
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
		$this->load->view('index',['desa_id_get'=>$desa_id_get,'kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function lembaga_list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		// $this->esg->add_js(base_url('assets/bumdes/script.js'));
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
		$this->load->view('bumdes/lembaga',['desa_id_get'=>$desa_id_get,'kategori_usaha'=>$this->bumdes_model->kategori_usaha(),'tingkat_pemeringkatan'=>$this->bumdes_model->tingkat_pemeringkatan(),'pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id]);
	}

	public function dana()
	{
		$this->load->view('index');
	}
	
	public function dana_kat()
	{
		$this->load->view('index');
	}
	public function clear_dana()
	{
		$this->load->view('bumdes/dana');
	}

	public function clear_dana_kat()
	{
		$this->load->view('bumdes/dana_kat');
	}

	public function usaha()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$usaha = $this->bumdes_model->get_usaha($bumdes_id);
		$this->load->view('index',['pengguna'=>$pengguna,'bumdes_id'=>$bumdes_id,'usaha'=>$usaha]);
	}

	public function indikator_usaha()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$dana_kat = $this->bumdes_model->get_dana_kat();
		$this->load->view('index',['dana_kat'=>$dana_kat,'bumdes_id'=>$bumdes_id,'desa_id'=>$pengguna['desa_id'],'user_id'=>$pengguna['user_id']]);
	}

	public function simpan_pinjam()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$bumdes_id = $this->bumdes_model->get_bumdes_id($pengguna['desa_id']);
		$dana_kat = $this->bumdes_model->get_dana_kat();
		$this->load->view('index',['dana_kat'=>$dana_kat,'bumdes_id'=>$bumdes_id,'desa_id'=>$pengguna['desa_id'],'user_id'=>$pengguna['user_id']]);
	}

	public function bumdesma_pdf($id = 0)
	{
		if(!empty($id))
		{
			$bumdesma = $this->bumdes_model->get_bumdesma($id);

			if(!empty($bumdesma))
			{
				$desa  = $this->sipapat_model->get_desa($bumdesma['desa_id']);
				$image = $this->sipapat_model->get_image_kab();

				$teks1 = 'PEMERINTAH KABUPATEN PATI';
				$teks2 = 'KECAMATAN '.@$desa['kecamatan'];
				$teks3 = 'DESA '.$desa['nama'];
				// $teks4 = 'Alamat Kantor Kepala Desa '.strtolower(@$desa['nama']).' '.substr(@$desa['alamat'],0,20).' Kec. '.strtolower(@$desa['kecamatan']).' kab. '.$desa['kabupaten'];
				$teks4 = ': '.strtolower(substr(@$desa['alamat'],0,20));
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
				$pdf->Cell(31);
				$pdf->SetFont('Times','','13');
				// $pdf->MultiCell(0,5,$teks4,0,1,false);
				// $pdf->Cell(0,5,$teks4,0,1,'L');
				$pdf->Cell(30,5,'Alamat Kantor',0,0,'L');
				$pdf->Cell(30,5,$teks4,0,0,'L');
				$pdf->Cell(17);
				$pdf->Cell(15,5,'Email',0,0,'L');
				$pdf->Cell(60,5,$teks6,0,1,'L');
				$pdf->Cell(31);
				$pdf->Cell(30,5,'Telepon',0,0,'L');
				$pdf->Cell(30,5,$teks5,0,0,'L');
				$pdf->Cell(17);
				$pdf->Cell(15,5,'Website',0,0,'L');
				$pdf->Cell(60,5,$teks8,0,1,'L');
				$pdf->Cell(31);
				$pdf->Cell(30,5,'Kode Pos',0,0,'L');
				$pdf->Cell(30,5,$teks7,0,1,'L');
				$pdf->SetLineWidth(1);
				$pdf->Line(10,45,200,45);
				$pdf->SetLineWidth(0);
				$pdf->Line(10,46,200,46);
				$pdf->Ln(10);

				$pdf->Cell(60,5,'- Modal',0,0,'L');
				$pdf->Cell(0,5,': '.money($bumdesma['modal']),0,1,'L');

				$pdf->Cell(60,5,'- Sumber Dana',0,0,'L');
				$pdf->Cell(0,5,': '.$this->pembangunan_model->sumber_dana()[$bumdesma['sumber_dana']],0,1,'L');

				$pdf->Cell(60,5,'- Tahun Anggaran',0,0,'L');
				$pdf->Cell(0,5,': '.$bumdesma['th_anggaran'],0,1,'L');
				$pdf->Cell(60,5,'- Termin',0,0,'L');
				$pdf->Cell(0,5,': '.$this->bumdes_model->termin()[$bumdesma['termin']],0,1,'L');

		    $pdf->Output('bumdesma_korporasi.pdf','I');
			}
		}
	}

	public function bumdesma_mandiri_sejahtera()
	{
		$sumber = $this->pembangunan_model->sumber_dana();
		$id = @intval($_GET['id']);
		$pengguna = $this->pengguna_model->get_pengguna();
		$sumber_selected = @$_GET['sumber'];
		$bumdesma = [];
		if(!empty($id))
		{
			$bumdesma = $this->bumdes_model->get_bumdesma($id);
		}
		$this->load->view('index',['pengguna'=>$pengguna,'sumber'=>$sumber,'sumber_selected'=>$sumber_selected,'bumdesma'=>$bumdesma]);
	}

	public function bumdesma_mandiri_sejahtera_detail()
	{
		$id = @intval($_GET['id']);
		$data = $this->bumdes_model->get_bumdesma($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function clear_bumdesma_mandiri_sejahtera()
	{
		$sumber = $this->pembangunan_model->sumber_dana();
		$id = @intval($_GET['id']);
		$pengguna = $this->pengguna_model->get_pengguna();
		$sumber_selected = @$_GET['sumber'];
		$bumdesma = [];
		if(!empty($id))
		{
			$bumdesma = $this->bumdes_model->get_bumdesma($id);
		}
		$this->load->view('bumdes/bumdesma_mandiri_sejahtera',['pengguna'=>$pengguna,'sumber'=>$sumber,'sumber_selected'=>$sumber_selected,'bumdesma'=>$bumdesma]);
	}


	public function product_cat()
	{
		$this->load->view('index');
	}
	public function clear_product_cat()
	{
		$this->load->view('bumdes/product_cat');
	}

	public function product_list($cat_id = 0)
	{
		$this->load->view('index',['desa_id'=>$this->sipapat_model->get_desa_id(),'cat_id'=>$cat_id]);
	}
	public function clear_product_list()
	{
		$this->load->view('bumdes/product_list');
	}

	public function product_edit($cat_id = 0)
	{
		$this->load->view('index',['desa_id'=>$this->sipapat_model->get_desa_id(),'cat_id'=>$cat_id]);
	}

	public function kebutuhan_edit()
	{
		$this->load->view('index');
	}
	public function kebutuhan_list()
	{
		$this->load->view('index');
	}
	public function clear_kebutuhan_list()
	{
		$this->load->view('bumdes/kebutuhan_list');
	}
	public function kecamatan_kebutuhan_list()
	{
		$this->load->view('index',['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}
	public function desa_kebutuhan_list()
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option'=>$this->pengguna_model->get_desa($kec)]);
	}

	public function kecamatan_product_list()
	{
		$this->load->view('index',['kec_option'=>$this->pengguna_model->get_kecamatan()]);
	}
	public function desa_product_list()
	{
		$kec = !empty(@$_GET['kec']) ? $_GET['kec'] : '';
		$this->load->view('index', ['desa_option'=>$this->pengguna_model->get_desa($kec)]);
	}

}