<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sipapat_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$sipapat_config = $this->esg->get_config(base_url());
		if (!empty($sipapat_config)) {
			$this->esg->set_esg('sipapat_config', $sipapat_config);
			if (!empty($this->session->userdata()[base_url('_logged_in')])) {
				$user = $this->session->userdata()[base_url('_logged_in')];
			}
			if (!empty($user)) {
				if (empty($user['pengguna'])) {
					$pengguna = $this->db->get_where('user_desa', ['user_id' => $user['id']])->row_array();
					if (!empty($pengguna['district_id'])) {
						$user['district'] = $this->db->get_where('districts', ['id' => $pengguna['district_id']])->row_array();
					}
					$user['pengguna'] = $pengguna;
					$this->session->set_userdata(base_url() . '_logged_in', $user);
					$user = $this->session->userdata()[base_url('_logged_in')];
				}
			}
		}
	}

	public function get_districts()
	{
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		if (!empty($sipapat_config)) {
			$regency_id = $sipapat_config['regency_id'];
			return $this->db->query('SELECT * FROM districts WHERE regency_id = ?', $regency_id)->result_array();
		}
	}

	public function desa_id_get()
	{
		$desa_id_get = '';
		if (!empty($_GET)) {
			$desa_id_get = [];
			foreach ($_GET as $key => $value) {
				$desa_id_get[] = $key . '=' . str_replace(' ', '+', $value);
			}
			if (!empty($desa_id_get)) {
				$desa_id_get = '?' . implode('&', $desa_id_get);
			}
		}
		return $desa_id_get;
	}

	public function set_meta($data = array())
	{
		// if(empty($data) || !is_array($data))
		// {
		// 	$data = array(
		// 				'title' => 'sipapat',
		// 				'keyword' => 'software development',
		// 				'description' => 'PT media nusa perkasa',
		// 				'developer' => 'esoftgreat',
		// 				'author' => 'esoftgreat',
		// 				'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
		// 				'phone' => '6285640510460',
		// 				'icon' => base_url('images/icon.png'),
		// 			);
		// }
		// $this->esg->set_esg('meta', $data);
	}

	public function rekening_data_rekap()
	{
		$regency_id = @intval($this->esg->get_esg('sipapat_config')['regency_id']);
		return $this->db->query('SELECT desa_id,desa.nama FROM desa_rekening INNER JOIN desa ON(desa.id=desa_rekening.desa_id) WHERE desa.regency_id = ?', $regency_id)->result_array();
	}

	public function get_rekening($desa_id = 0)
	{
		return $this->db->query('SELECT * FROM desa_rekening WHERE desa_id = ?', $desa_id)->row_array();
	}

	public function get_rekening_list($district_id = 0)
	{
		$sipapat_config = $this->esg->get_esg('sipapat_config');
		if (!empty($sipapat_config)) {
			$regency_id = @intval($sipapat_config['regency_id']);
			$q = 'SELECT r.*,d.nama AS desa,d.kode_pos FROM desa_rekening AS r INNER JOIN desa AS d ON(d.id=r.desa_id) WHERE d.regency_id = ?';
			if (!empty($district_id)) {
				$q .= ' AND d.district_id = ?';
				$data = $this->db->query($q, [$regency_id, $district_id])->result_array();
			} else {
				$data = $this->db->query($q, $regency_id)->result_array();
			}
			return $data;
		}
	}

	public function get_desa_id()
	{
		$user = $this->session->userdata(base_url() . '_logged_in');
		if (!empty($user)) {
			$desa = $this->db->query('SELECT desa_id FROM user_desa WHERE user_id = ?', $user['id'])->row_array();
			if (!empty($desa)) {
				return @intval($desa['desa_id']);
			}
		}
	}

	public function get_pengumuman($name = '')
	{
		$data = array();
		if (!empty($name)) {
			$value = $this->db->query('SELECT value FROM pengumuman WHERE name = ?', 'kec_' . $name)->row_array();
			if (!empty($value)) {
				$data = json_decode($value['value'], 1);
			}
		}
		return $data;
	}
	public function get_desa($id = 0)
	{
		if (!empty($id)) {
			// $this->db->join('villages','desa.village_id=villages.id');
			// $this->db->select('desa.*,villages.id AS kode');
			$data = $this->db->get_where('desa', ['desa.id' => $id])->row_array();
			return $data;
		}
	}

	public function get_image_kab()
	{
		// $data = $this->db->query('SELECT id,image FROM user WHERE user_role_id = 2')->row_array();
		$data = $this->esg->get_config(base_url());
		if (!empty($data['image'])) {
			$image = $data['image'];
			return image_module('config', 'kabupaten_image_' . str_replace('/', '_', base_url()) . '/' . $image);
		}
	}

	public function perangkat_alert()
	{
		$user = $this->session->userdata(base_url() . '_logged_in');
		if (is_desa()) {
			$perangkat = $this->db->query('SELECT * FROM perangkat_desa WHERE user_id = ?', $user['id'])->result_array();
			if (!empty($perangkat)) {
				$amj = array();
				foreach ($perangkat as $key => $value) {
					if (!empty($value['akhir_masa_jabatan']) && $value['akhir_masa_jabatan'] != '0000-00-00') {
						$alert_time = date('Y-m-d', strtotime($value['akhir_masa_jabatan'] . ' -3 month'));
						$current = date('Y-m-d');
						if ($current >= $alert_time) {
							$amj[$value['id']]['amj'] = $value['akhir_masa_jabatan'];
							$amj[$value['id']]['kelompok'] = $value['kelompok'];
							$amj[$value['id']]['jabatan'] = $value['jabatan'];
							$amj[$value['id']]['nama'] = $value['nama'];
							if ($value['kelompok'] == 6 || $value['kelompok'] == 7) {
								$amj[$value['id']]['rt'] = $value['rt'];
								$amj[$value['id']]['rw'] = $value['rw'];
							}
							$amj[$value['id']]['desa'] = $user['username'];
							$amj[$value['id']]['jabatan'] = $this->get_jabatan($value['kelompok'], $value['jabatan']);
						}
					}
				}
				return $amj;
			}
		} else if (is_kecamatan()) {
			$kecamatan_name = strtoupper(str_replace('kec_', '', $user['username']));
			$desa_ids = $this->db->query('SELECT id,nama FROM desa WHERE kecamatan = ?', $kecamatan_name)->result_array();
			if (!empty($desa_ids)) {
				$amj = array();
				foreach ($desa_ids as $desa_ids_key => $desa_ids_value) {
					$perangkat = $this->db->query('SELECT * FROM perangkat_desa WHERE desa_id = ? AND (kelompok = 1 OR kelompok = 2)', $desa_ids_value['id'])->result_array();
					if (!empty($perangkat)) {
						foreach ($perangkat as $key => $value) {
							if (!empty($value['akhir_masa_jabatan']) && $value['akhir_masa_jabatan'] != '0000-00-00') {
								$alert_time = date('Y-m-d', strtotime($value['akhir_masa_jabatan'] . ' -3 month'));
								$current = date('Y-m-d');
								if ($current >= $alert_time) {
									$amj[$value['id']]['amj'] = $value['akhir_masa_jabatan'];
									$amj[$value['id']]['kelompok'] = $value['kelompok'];
									$amj[$value['id']]['nama'] = $value['nama'];
									$amj[$value['id']]['desa'] = $desa_ids_value['nama'];
									if ($value['kelompok'] == 6 || $value['kelompok'] == 7) {
										$amj[$value['id']]['rt'] = $value['rt'];
										$amj[$value['id']]['rw'] = $value['rw'];
									}
									$amj[$value['id']]['jabatan'] = $this->get_jabatan($value['kelompok'], $value['jabatan']);
								}
							}
						}
					}
				}
				return $amj;
			}
		} else if (is_admin()) {
			$amj = array();
			$perangkat = $this->db->query('SELECT perangkat_desa.*,desa.nama AS nama_desa FROM perangkat_desa,desa WHERE desa.id=perangkat_desa.desa_id AND kelompok = 1 AND jabatan = 1')->result_array();
			if (!empty($perangkat)) {
				foreach ($perangkat as $key => $value) {
					if (!empty($value['akhir_masa_jabatan']) && $value['akhir_masa_jabatan'] != '0000-00-00') {
						$alert_time = date('Y-m-d', strtotime($value['akhir_masa_jabatan'] . ' -3 month'));
						$current = date('Y-m-d');
						if ($current >= $alert_time) {
							$amj[$value['id']]['amj'] = $value['akhir_masa_jabatan'];
							$amj[$value['id']]['kelompok'] = $value['kelompok'];
							$amj[$value['id']]['nama'] = $value['nama'];
							$amj[$value['id']]['desa'] = $value['nama_desa'];
							if ($value['kelompok'] == 6 || $value['kelompok'] == 7) {
								$amj[$value['id']]['rt'] = $value['rt'];
								$amj[$value['id']]['rw'] = $value['rw'];
							}
							$amj[$value['id']]['jabatan'] = $this->get_jabatan($value['kelompok'], $value['jabatan']);
						}
					}
				}
				return $amj;
			}
		}
	}

	public function site()
	{
		$data = array();

		$base_url_name = str_replace('/', '_', base_url());
		$site_title = $base_url_name . '_site';

		$data['logo'] = $this->esg->get_config($base_url_name . '_logo');
		$data['site'] = $this->esg->get_config($base_url_name . '_site');

		if (empty($data['logo'])) {
			$data['logo'] = $this->esg->get_config('logo');
		}
		if (empty($data['site'])) {
			$site_title = 'site';
			$data['site'] = $this->esg->get_config('site');
		}
		// pr($data);die();


		$this->esg->set_esg('site', $data);

		$site = $this->esg->get_esg('site')['site'];
		$meta = $this->esg->get_esg('meta');
		if (!empty($site)) {
			foreach ($site as $key => $value) {
				if ($key == 'image' && !empty($value)) {
					$meta['icon'] = image_module('config/' . $site_title, $value);
				}
				$meta[$key] = $value;
			}
			$this->esg->set_esg('meta', $meta);
		}
	}

	public function get_jabatan($kelompok_id = 0, $jabatan_id = 0)
	{
		if (!empty($kelompok_id)) {
			$this->load->model('pengguna_model');
			$kelompok = ['1' => 'perangkat', '2' => 'bpd', '3' => 'lpmd', '4' => 'pkk', '5' => 'karang_taruna', '6' => 'rt', '7' => 'rw', '8' => 'kpmd', '9' => 'linmas'];
			$jabatan = $this->pengguna_model->jabatan();
			return ['kelompok' => $kelompok[$kelompok_id], 'jabatan' => $jabatan[$kelompok_id][$jabatan_id]];
		}
	}

	public function get_regency($regency_id = 0)
	{
		return $this->db->query('SELECT * FROM regencies WHERE id = ?', $regency_id)->row_array();
	}

	public function kepdes_alert()
	{
		$user = $this->session->userdata(base_url() . '_logged_in');
		if (!empty($user)) {
			$data = $this->db->query('SELECT * FROM perangkat_desa WHERE user_id = ? AND kelompok = 1 AND jabatan = 1 LIMIT 1', $user['id'])->row_array();
			$akhir_masa_jabatan = @$data['akhir_masa_jabatan'];
			if (!empty($akhir_masa_jabatan) && $akhir_masa_jabatan != '0000-00-00') {
				$alert_time = date('Y-m-d', strtotime($akhir_masa_jabatan . ' -3 month'));
				$current = date('Y-m-d');
				if ($current >= $alert_time) {
					return ['msg' => 'masa jabatan kepala desa ' . $data['nama'] . ' akan berakhir pada tanggal ' . $data['akhir_masa_jabatan'], 'alert' => 'danger'];
				}
			}
		}
	}
}
