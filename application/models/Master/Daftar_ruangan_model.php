<?php defined('BASEPATH') or exit('No direct script access allowed');
class Daftar_ruangan_model extends CI_Model
{
	protected $ruangan = "ak_data_master_ruangan";

	public function get_list_data()
	{
		$this->datatables->select('ruangan_id, ruangan_deskripsi, ruangan_slug, ruangan_color, ruangan_icon');
		$this->datatables->from($this->ruangan);
		$this->datatables->where($this->ruangan . '.deleted', FALSE);
		$this->datatables->add_column('view', "<button id='edit' class='m-1 btn btn-sm btn-primary' data='$1'><i class='fa fa-pencil-alt'></i></button> <button id='hapus' class='m-1 btn btn-sm btn-danger' data='$1'><i class='fa fa-trash'></i></button>", "ruangan_id");
		return $this->datatables->generate();
	}

	public function simpan($data)
	{
		return $this->db->insert($this->ruangan, $data);
	}

	public function get_data()
	{
		$this->db->where($this->ruangan . '.ruangan_id', $this->input->post('ruangan_id'));
		return $this->db->get($this->ruangan)->row();
	}

	public function edit($data)
	{
		$this->db->where($this->ruangan . '.ruangan_id', $this->input->post('ruangan_id'));
		return $this->db->update($this->ruangan, $data);
	}

	public function hapus($data)
	{
		$this->db->where($this->ruangan . '.ruangan_id', $this->input->post('ruangan_id'));
		return $this->db->update($this->ruangan, $data);
	}

	public function options()
	{
		$this->db->where($this->ruangan . '.deleted', FALSE);
		$opt = $this->db->get($this->ruangan)->result();

		$data = array();
		foreach ($opt as $opt) {
			$data[] = array("id" => $opt->ruangan_id, "text" => $opt->ruangan_deskripsi);
		}

		return $data;
	}
}
