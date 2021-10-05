<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rawat_inap_model extends CI_Model
{
	protected $ruangan = "daftar_ruangan";
	protected $kelas = "ak_data_master_kelas";
	protected $indikator = "ak_data_master_indikator";

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
}
