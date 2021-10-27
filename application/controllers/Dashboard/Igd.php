<?php defined('BASEPATH') or exit('No direct script access allowed');
class Igd extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/Igd_model', 'm');
	}

	public function index()
	{
		$data['Root'] = "Dashboard";
		$data['Title'] = "IGD";
		$data['Breadcrumb'] = array();
		$data['Template'] = "templates/private";
		$data['Components'] = array(
			'main' => "/v_private_topbar",
			'header' => $data['Template'] . "/components/v_header",
			'navbar' => $data['Template'] . "/components/v_navbar_landing",
			'footer' => $data['Template'] . "/components/v_footer",
			'content' => str_replace("/", "/v_", $this->session->userdata('UrlDash'))
		);
		$data['parameter'] = $this->get_parameter();
		$this->load->view('v_main', $data);
	}

	public function get_parameter()
	{
		$data = array(
			array(
				'kode' => 'jrujuk',
				'background' => '#FF449F',
				'icon' => 'fa-ambulance',
				'deskripsi' => 'Jumlah Pasien Rujuk',
				'query' => 1
			),
			array(
				'kode' => 'jnonrujuk',
				'background' => '#4E9F3D',
				'icon' => 'fa-bed',
				'deskripsi' => 'Jumlah Pasien Tidak Rujuk',
				'query' => 2
			),
			array(
				'kode' => 'jpasien',
				'background' => '#00EAD3',
				'icon' => 'fa-users',
				'deskripsi' => 'Jumlah Pasien Keseluruhan',
				'query' => 3
			)
		);
		return $data;
	}

	public function jumlah_pasien()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$results = array();
		$parameters = $this->get_parameter();
		foreach ($parameters as $param) {
			$results[$param['kode']] = $this->m->get_jumlah_pasien($param['query'], $tgl_awal, $tgl_akhir);
		}
		echo json_encode($results);
	}

	public function get_table()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$parameters = $this->get_parameter();
		$data = array();
		foreach ($parameters as $param) {
			$data[$param['deskripsi']] = $this->m->get_table_data($tgl_awal, $tgl_akhir);
		}
		echo json_encode($data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('portal');
	}
}
