<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rawat_jalan_model extends CI_Model
{
	protected $poli = "ak_data_master_poliklinik";
	// 
	protected $rj = "data_pendaftaran_rj";

	public function get_data()
	{
		$this->db->where($this->poli . '.deleted', false);
		return $this->db->get($this->poli)->result();
	}

	public function get_poli($id)
	{
		$this->db->where($this->poli . '.poliklinik_id', $id);
		return $this->db->get($this->poli)->row('poliklinik_deskripsi');
	}

	public function get_jumlah_pasien($poli, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->rj . '.date>=', $tgl_awal);
		$sidawangi->where($this->rj . '.date<=', $tgl_akhir);
		if (!empty($poli)) {
			$sidawangi->like($this->rj . '.poliklinik', $poli, "both");
		}
		return $sidawangi->get($this->rj)->num_rows();
	}

	public function search_value($month, $poli, $tahun_awal, $tahun_akhir, $bulan_awal, $bulan_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where('YEAR(Date)>=', $tahun_awal);
		$sidawangi->where('YEAR(Date)<=', $tahun_akhir);
		$sidawangi->like($this->rj . '.poliklinik', $poli, "both");
		return $sidawangi->get($this->rj)->num_rows();
	}

	public function get_table_data($poli, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->select('date, dokter_konsul, count(id) as pasien, poliklinik');
		$sidawangi->where($this->rj . '.date>=', $tgl_awal);
		$sidawangi->where($this->rj . '.date<=', $tgl_akhir);
		$sidawangi->like($this->rj . '.poliklinik', $poli, "both");
		$sidawangi->group_by('dokter_konsul');
		return $sidawangi->get($this->rj)->result_array();
	}
}
