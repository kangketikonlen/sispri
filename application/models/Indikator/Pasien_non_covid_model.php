<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pasien_non_covid_model extends CI_Model
{
	protected $poli = "ak_data_master_poli";

	public function get_data()
	{
		$this->db->where($this->poli . '.deleted', false);
		return $this->db->get($this->poli)->result();
	}

	public function get_poli($id)
	{
		$this->db->where($this->poli . '.poli_id', $id);
		return $this->db->get($this->poli)->row('poli_deskripsi');
	}
}
