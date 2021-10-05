<?php defined('BASEPATH') or exit('No direct script access allowed');
class Bto_model extends CI_Model
{
	protected $poli = "ak_data_master_poli";
	// 
	protected $sdw_ruangan = "daftar_ruangan";

	public function get_data()
	{
		$sidawangi = $this->load->database('sidawangi', TRUE);
		return $sidawangi->get($this->sdw_ruangan)->result();
	}

	public function get_poli($id)
	{
		$this->db->where($this->poli . '.poli_id', $id);
		return $this->db->get($this->poli)->row('poli_deskripsi');
	}

	public function colors()
	{
		$colors = array("EC9CD3", "FF7878", "6ECB63", "664E88", "63B4B8", "3DB2FF");
		return $colors[array_rand($colors)];
	}
}
