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
			'footer' => $data['Template'] . "/components/v_footer",
			'content' => str_replace("/", "/v_", $this->session->userdata('UrlDash'))
		);
		$this->load->view('v_main', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('portal');
	}
}
