<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pasien_non_covid extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Indikator/Pasien_covid_model', 'm');
	}

	public function get_jumlah()
	{
		$results = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			if ($ruangan->kelas != "ICU") {
				$results[$ruangan->id] = $this->m->hitung_pasien($ruangan->nama_ruang, $ruangan->kelas);
			} else {
				$results[$ruangan->id] = 0;
			}
		}
		echo json_encode($results);
	}

	public function get_table()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$data = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			if ($ruangan->kelas != "ICU") {
				$data[$ruangan->kelas] = $this->m->get_table_data($ruangan->nama_ruang, $ruangan->kelas, $tgl_awal, $tgl_akhir);
			} else {
				$data[$ruangan->kelas] = 0;
			}
		}
		echo json_encode($data);
	}

	public function chart_data()
	{
		$labels = array();
		$backgroundColor = array();
		$data = array();
		$ruangan = $this->m->get_ruangan();
		$i = 0;
		foreach ($ruangan as $ruangan) {
			$labels[] = $ruangan->kelas;
			$backgroundColor[] = ($i++ % 2 == 0) ? '#39A388' : '#6ECB63';
			if ($ruangan->kelas != "ICU") {
				$data[] = $this->m->hitung_pasien($ruangan->nama_ruang, $ruangan->kelas);
			} else {
				$data[] = 0;
			}
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}
}
