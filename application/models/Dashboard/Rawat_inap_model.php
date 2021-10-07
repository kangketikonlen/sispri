<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rawat_inap_model extends CI_Model
{
	protected $ruangan = "daftar_ruangan";
	protected $kelas = "ak_data_master_kelas";
	protected $indikator = "ak_data_master_indikator";
	protected $ri = "data_pendaftaran_ri";

	public function get_data()
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->group_by('nama_ruang');
		return $sidawangi->get($this->ruangan)->result();
	}

	public function get_kelas()
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ruangan . '.nama_ruang', $this->input->get('ruangan'));
		$sidawangi->order_by('kelas');
		return $sidawangi->get($this->ruangan)->result();
	}

	public function get_indikator()
	{
		$this->db->where($this->indikator . '.deleted', false);
		return $this->db->get($this->indikator)->result();
	}

	public function get_jumlah_pasien($ruang, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ri . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->ri . '.date_in<=', $tgl_akhir);
		if (!empty($ruang)) {
			$sidawangi->where($this->ri . '.ruang', $ruang);
		}
		return $sidawangi->get($this->ri)->num_rows();
	}
}
