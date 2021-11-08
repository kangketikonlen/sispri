<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bor_model extends CI_Model
{
	protected $ruangan = "daftar_ruangan";
	protected $rawat_inap = "data_pendaftaran_ri";

	public function get_ruangan()
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ruangan . '.nama_ruang', $this->input->get('ruangan'));
		$sidawangi->order_by('kelas');
		return $sidawangi->get($this->ruangan)->result();
	}

	public function get_jumlah_pasien($ruang, $kelas, $tgl_awal, $tgl_akhir)
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->rawat_inap . '.ruang', $ruang);
		$sidawangi->where($this->rawat_inap . '.kelas', $kelas);
		$sidawangi->where($this->rawat_inap . '.date_in>=', $tgl_awal);
		$sidawangi->where($this->rawat_inap . '.date_in<=', $tgl_akhir);
		return $sidawangi->get($this->rawat_inap)->num_rows();
	}
}
