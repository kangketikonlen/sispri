<?php defined('BASEPATH') or exit('No direct script access allowed');
class Daftar_poliklinik_model extends CI_Model
{
	protected $poliklinik = "ak_data_master_poliklinik";

	public function get_list_data()
	{
		$this->datatables->select('poliklinik_id, poliklinik_deskripsi, poliklinik_slug, poliklinik_color, poliklinik_icon');
		$this->datatables->from($this->poliklinik);
		$this->datatables->where($this->poliklinik . '.deleted', FALSE);
		$this->datatables->add_column('view', "<button id='edit' class='m-1 btn btn-sm btn-primary' data='$1'><i class='fa fa-pencil-alt'></i></button> <button id='hapus' class='m-1 btn btn-sm btn-danger' data='$1'><i class='fa fa-trash'></i></button>", "poliklinik_id");
		return $this->datatables->generate();
	}

	public function simpan($data)
	{
		return $this->db->insert($this->poliklinik, $data);
	}

	public function get_data()
	{
		$this->db->where($this->poliklinik . '.poliklinik_id', $this->input->post('poliklinik_id'));
		return $this->db->get($this->poliklinik)->row();
	}

	public function edit($data)
	{
		$this->db->where($this->poliklinik . '.poliklinik_id', $this->input->post('poliklinik_id'));
		return $this->db->update($this->poliklinik, $data);
	}

	public function hapus($data)
	{
		$this->db->where($this->poliklinik . '.poliklinik_id', $this->input->post('poliklinik_id'));
		return $this->db->update($this->poliklinik, $data);
	}

	public function options()
	{
		$this->db->where($this->poliklinik . '.deleted', FALSE);
		$opt = $this->db->get($this->poliklinik)->result();

		$data = array();
		foreach ($opt as $opt) {
			$data[] = array("id" => $opt->poliklinik_id, "text" => $opt->poliklinik_deskripsi);
		}

		return $data;
	}
}
