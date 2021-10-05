<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bor extends MY_Dashboard
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Indikator/Bor_model', 'm');
	}

	public function get_jumlah()
	{
		$results = array();
		$total_bed = 0;
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$results[$ruangan->id] = $this->hitung_bor($ruangan->kapasitas);
			$total_bed += $ruangan->kapasitas;
		}
		$results['total'] = $this->hitung_bor($ruangan->kapasitas);

		echo json_encode($results);
	}

	private function hitung_bor($total_bed)
	{
		$tgl_awal = $this->input->get('tanggal_awal');
		$tgl_akhir = $this->input->get('tanggal_akhir');
		return bor($tgl_awal, $tgl_akhir, $total_bed);
	}

	public function get_table()
	{
		$tgl_awal = $this->input->get('tanggal_awal');
		$tgl_akhir = $this->input->get('tanggal_akhir');
		// 
		$data = array();
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$data[$ruangan->kelas] = array(
				array(
					'kelas' => $ruangan->kelas,
					'kapasitas' => $ruangan->kapasitas,
					'periode' => count_date($tgl_awal, $tgl_akhir),
					'perawatan' => count_date($tgl_awal, $tgl_akhir),
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
			$labels[] = $ruangan->kelas;
			$backgroundColor[] = ($i++ % 2 == 0) ? '#1CC5DC' : '#867AE9';
			$data[] = $this->hitung_bor($ruangan->kapasitas);
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}
}
