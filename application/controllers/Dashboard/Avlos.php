<?php defined('BASEPATH') or exit('No direct script access allowed');
class Avlos extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if (!$isLogin) {
			redirect('portal');
		} else {
			$this->load->model('Dashboard/Avlos_model', 'm');
		}
	}

	public function index()
	{
		$data['Root'] = "Dashboard";
		$data['Title'] = "Average Length of Stay";
		$data['Breadcrumb'] = array();
		$data['Template'] = "templates/private";
		$data['Components'] = array(
			'main' => "/v_private_topbar",
			'header' => $data['Template'] . "/components/v_header",
			'navbar' => $data['Template'] . "/components/v_navbar_landing",
			'footer' => $data['Template'] . "/components/v_footer",
			'content' => str_replace("/", "/v_", $this->session->userdata('UrlDash'))
		);
		$data['poli'] = $this->m->get_data();
		$this->load->view('v_main', $data);
	}

	public function chart_data()
	{
		$dataset = array();
		$poli = $this->m->get_data();

		foreach ($poli as $lists) {
			$dataset[] = array(
				'label' => $lists->poli_deskripsi,
				'backgroundColor' => '#' . $lists->poli_color,
				'borderColor' => '#' . $lists->poli_color,
				'pointColor' => '#' . $lists->poli_color,
				'pointStrokeColor' => '#' . $lists->poli_color,
				'pointHighlightFill' => '#fff',
				'pointRadius' => false,
				'data' => array(rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000)),
			);
		}

		echo json_encode($dataset);
	}

	public function get_table()
	{
		$data = array();

		for ($i = 1; $i <= 10; $i++) {
			$data[] = array(
				'nomor' => $i,
				'tanggal' => date("Y-m-d"),
				'pasien' => "Pasien " . $i,
				'dokter' => "Dokter " . $i,
				'poli' => $this->m->get_poli($i)
			);
		}

		echo json_encode($data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('portal');
	}
}
