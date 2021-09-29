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
		$data['ruangan'] = $this->m->get_data();
		$this->load->view('v_main', $data);
	}

	public function chart_data()
	{
		$dataset = array();
		$ruangan = $this->m->get_data();

		foreach ($ruangan as $lists) {
			$dataset[] = array(
				'label' => $lists->nama_ruang,
				'backgroundColor' => '#' . $this->m->colors(),
				'borderColor' => '#' . $this->m->colors(),
				'pointColor' => '#' . $this->m->colors(),
				'pointStrokeColor' => '#' . $this->m->colors(),
				'pointHighlightFill' => '#fff',
				'pointRadius' => false,
				'data' => array(rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100)),
			);
		}

		echo json_encode($dataset);
	}

	public function get_table()
	{
		$data = array();
		$ruangan = $this->m->get_data();
		$i = 1;
		foreach ($ruangan as $lists) {
			$data[] = array(
				'nomor' => $i++,
				'ruangan' => $lists->nama_ruang,
				'kapasitas' => $lists->kapasitas,
				'isi' => $lists->isi,
				'avlos' => rand(0, 100) . "%"
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
