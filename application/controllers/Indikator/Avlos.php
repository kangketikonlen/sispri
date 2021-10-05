<?php defined('BASEPATH') or exit('No direct script access allowed');
class Avlos extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Indikator/Avlos_model', 'm');
	}

	public function get_jumlah()
	{
		$results = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$lama_dirawat = $this->m->get_lama_dirawat($ruangan->nama_ruang, $ruangan->kelas);
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$results[$ruangan->id] = $this->hitung($lama_dirawat, $jumlah_pasien);
		}
		echo json_encode($results);
	}

	private function hitung($lama_dirawat, $jumlah_pasien)
	{
		return avlos($lama_dirawat, $jumlah_pasien);
	}

	public function get_table()
	{
		$data = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$lama_dirawat = $this->m->get_lama_dirawat($ruangan->nama_ruang, $ruangan->kelas);
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$data[$ruangan->kelas] = array(
				array(
					'kelas' => $ruangan->kelas,
					'dirawat' => $lama_dirawat,
					'pasien' => $jumlah_pasien,
				)
			);
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
			$lama_dirawat = $this->m->get_lama_dirawat($ruangan->nama_ruang, $ruangan->kelas);
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$labels[] = $ruangan->kelas;
			$backgroundColor[] = ($i++ % 2 == 0) ? '#1CC5DC' : '#867AE9';
			$data[] = $this->hitung($lama_dirawat, $jumlah_pasien);
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}
}
