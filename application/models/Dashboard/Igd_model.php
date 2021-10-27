<?php defined('BASEPATH') or exit('No direct script access allowed');
class Igd_model extends CI_Model
{
	protected $rd = "data_pendaftaran_rd";

	public function get_jumlah_pasien($query, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->rd . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->rd . '.date_in<=', $tgl_akhir);
		if (!empty($query)) {
			$sidawangi->where($this->rd . '.rujukan', 'YA');
		}
		return $sidawangi->get($this->rd)->num_rows();
	}

	public function get_table_data($tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->select('date_in, diagnosa, count(id) as pasien');
		$sidawangi->where($this->rd . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->rd . '.date_in<=', $tgl_akhir);
		$sidawangi->where($this->rd . '.diagnosa!=', "");
		$sidawangi->group_by('diagnosa');
		return $sidawangi->get($this->rd)->result_array();
	}
}
