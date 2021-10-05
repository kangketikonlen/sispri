<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bor_model extends CI_Model
{
	protected $ruangan = "daftar_ruangan";

	public function get_ruangan()
	{
		$sidawangi = $this->load->database('sdw', TRUE);
		$sidawangi->where($this->ruangan . '.nama_ruang', $this->input->get('ruangan'));
		$sidawangi->order_by('kelas');
		return $sidawangi->get($this->ruangan)->result();
	}
}
