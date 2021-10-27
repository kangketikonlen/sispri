<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pasien_covid_model extends CI_Model
{
	protected $ruangan = "daftar_ruangan";
	protected $ri = "data_pendaftaran_ri";

	public function get_ruangan()
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ruangan . '.nama_ruang', $this->input->get('ruangan'));
		$sidawangi->order_by('kelas');
		return $sidawangi->get($this->ruangan)->result();
	}

	public function hitung_pasien($ruang, $kelas)
	{
		$tgl_awal = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_awal') . '- 1 day'));
		$tgl_akhir = date("Y-m-d H:i:s", strtotime($this->input->get('tanggal_akhir') . '+ 1 day'));
		// 
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ri . '.ruang', $ruang);
		$sidawangi->where($this->ri . '.kelas', $kelas);
		$sidawangi->where($this->ri . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->ri . '.date_in<=', $tgl_akhir);
		$sidawangi->like($this->ri . '.diagnosa_masuk', "covid", "both");
		$sidawangi->order_by('kelas');
		return $sidawangi->get($this->ri)->num_rows();
	}

	public function get_table_data($ruang, $kelas, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->select('date_in, dokter_rs, count(id) as pasien, kelas');
		$sidawangi->where($this->ri . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->ri . '.date_in<=', $tgl_akhir);
		$sidawangi->where($this->ri . '.ruang', $ruang);
		$sidawangi->where($this->ri . '.kelas', $kelas);
		$sidawangi->like($this->ri . '.diagnosa_masuk', "covid", "both");
		$sidawangi->group_by('dokter_rs');
		return $sidawangi->get($this->ri)->result_array();
	}
}
