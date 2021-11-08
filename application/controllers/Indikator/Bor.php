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
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		$ruangan = $this->m->get_ruangan();
		foreach ($ruangan as $ruangan) {
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas, $tgl_awal, $tgl_akhir);
			$results[$ruangan->id] = $this->hitung_bor($jumlah_pasien, $ruangan->kapasitas, $tgl_awal, $tgl_akhir);
			$total_bed += $ruangan->kapasitas;
		}
		$results['total'] = $this->hitung_bor($jumlah_pasien, $ruangan->kapasitas, $tgl_awal, $tgl_akhir);

		echo json_encode($results);
	}

	private function hitung_bor($jumlah_pasien, $total_bed, $tgl_awal, $tgl_akhir)
	{
		return bor($jumlah_pasien, $total_bed, $tgl_awal, $tgl_akhir);
	}

	public function get_table()
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
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
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		$ruangan = $this->m->get_ruangan();
		$i = 0;
		foreach ($ruangan as $ruangan) {
			$jumlah_pasien = $this->m->get_jumlah_pasien($ruangan->nama_ruang, $ruangan->kelas, $tgl_awal, $tgl_akhir);
			$labels[] = $ruangan->kelas;
			$backgroundColor[] = ($i++ % 2 == 0) ? '#39A388' : '#6ECB63';
			$data[] = $this->hitung_bor($jumlah_pasien, $ruangan->kapasitas, $tgl_awal, $tgl_akhir);
		}

		$data = array(
			'labels' => $labels,
			'backgroundColor' => $backgroundColor,
			'data' => $data
		);

		echo json_encode($data);
	}
}
