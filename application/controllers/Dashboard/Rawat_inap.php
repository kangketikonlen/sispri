<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rawat_inap extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/Rawat_inap_model', 'm');
	}

	public function index()
	{
		$data['Root'] = "Dashboard";
		$data['Title'] = "Rawat Inap";
		$data['Breadcrumb'] = array();
		$data['Template'] = "templates/private";
		$data['Components'] = array(
			'main' => "/v_private_topbar",
			'header' => $data['Template'] . "/components/v_header",
			'navbar' => $data['Template'] . "/components/v_navbar_landing",
			'footer' => $data['Template'] . "/components/v_footer"
		);
		if (empty($this->input->get('ruangan'))) {
			$data['ruangan'] = $this->m->get_data();
			$data['Components']['content'] = str_replace("/", "/v_", $this->session->userdata('UrlDash'));
		} elseif ((!empty($this->input->get('indikator')))) {
			$data['ruangan'] = $this->input->get('ruangan');
			$data['indikator'] = $this->input->get('indikator');
			$data['kelas'] = $this->m->get_kelas();
			$data['Components']['content'] = "indikator/v_" . $data['indikator'];
		} else {
			$data['ruangan'] = $this->input->get('ruangan');
			$data['indikator'] = $this->m->get_indikator();
			$data['Components']['content'] = "dashboard/v_indikator";
		}
		$this->load->view('v_main', $data);
	}

	public function jumlah_pasien()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$results = array();
		$ruangan = $this->m->get_data();
		foreach ($ruangan as $ruang) {
			$results[$ruang->id] = $this->m->get_jumlah_pasien($ruang->nama_ruang, $tgl_awal, $tgl_akhir);
		}
		echo json_encode($results);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('portal');
	}
}
