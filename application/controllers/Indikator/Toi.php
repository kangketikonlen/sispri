<?php defined('BASEPATH') or exit('No direct script access allowed');
class Toi extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Indikator/Toi_model', 'm');
	}

	public function get_jumlah()
	{
		$results = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$results[$ruangan->id] = $this->hitung($ruangan->kapasitas, $jumlah_pasien);
		}
		echo json_encode($results);
	}

	private function hitung($jumlah_bed, $jumlah_pasien_keluar)
	{
		$tgl_awal = $this->input->get('tanggal_awal');
		$tgl_akhir = $this->input->get('tanggal_akhir');
		return toi($tgl_awal, $tgl_akhir, $jumlah_bed, $jumlah_pasien_keluar);
	}

	public function get_table()
	{
		$data = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$data[$ruangan->kelas] = array(
				array(
					'kelas' => $ruangan->kelas,
					'kapasitas' => $ruangan->kapasitas,
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
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas);
			$labels[] = $ruangan->kelas;
			$backgroundColor[] = ($i++ % 2 == 0) ? '#1CC5DC' : '#867AE9';
			$data[] = $this->hitung($ruangan->kapasitas, $jumlah_pasien);
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}
}
