<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rawat_jalan extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/Rawat_jalan_model', 'm');
	}

	public function index()
	{
		$data['Root'] = "Dashboard";
		$data['Title'] = "Rawat Jalan";
		$data['Breadcrumb'] = array();
		$data['Template'] = "templates/private";
		$data['Components'] = array(
			'main' => "/v_private_topbar",
			'header' => $data['Template'] . "/components/v_header",
			'navbar' => $data['Template'] . "/components/v_navbar_landing",
			'footer' => $data['Template'] . "/components/v_footer",
			'content' => str_replace("/", "/v_", $this->session->userdata('UrlDash'))
		);
		$data['poliklinik'] = $this->m->get_data();
		$this->load->view('v_main', $data);
	}

	public function jumlah_pasien()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$results = array();
		$poliklinik = $this->m->get_data();
		foreach ($poliklinik as $poli) {
			$results[$poli->poliklinik_kode] = $this->m->get_jumlah_pasien($poli->poliklinik_slug, $tgl_awal, $tgl_akhir);
		}
		$results['total'] = $this->m->get_jumlah_pasien(0, $tgl_awal, $tgl_akhir);
		echo json_encode($results);
	}

	public function chart_data()
	{
		$labels = array();
		$backgroundColor = array();
		$data = array();
		$poliklinik = $this->m->get_data();

		foreach ($poliklinik as $lists) {
			$labels[] = $lists->poliklinik_deskripsi;
			$backgroundColor[] = $lists->poliklinik_color;
			$data[] = $this->chart_value($lists->poliklinik_slug);
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}

	public function chart_value($poliklinik)
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		return $this->m->get_jumlah_pasien($poliklinik, $tgl_awal, $tgl_akhir);
	}

	public function get_table()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$poliklinik = $this->m->get_data();
		$data = array();
		foreach ($poliklinik as $lists) {
			$data[$lists->poliklinik_deskripsi] = $this->m->get_table_data($lists->poliklinik_slug, $tgl_awal, $tgl_akhir);
		}
		echo json_encode($data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('portal');
	}
}
