<?php defined('BASEPATH') or exit('No direct script access allowed');
class Migration_model extends CI_Model
{
	protected $samples = "ak_data_system_samples";

	public function get_list_data()
	{
		$this->datatables->select('samples_id, samples_nama, samples_deskripsi');
		$this->datatables->from($this->samples);
		$this->datatables->where($this->samples . '.deleted', FALSE);
		$this->datatables->where($this->samples . '.samples_id>', 2);
		$this->datatables->add_column('view', "<button id='edit' class='m-1 btn btn-sm btn-primary' data='$1'><i class='fa fa-pencil-alt'></i></button> <button id='hapus' class='m-1 btn btn-sm btn-danger' data='$1'><i class='fa fa-trash'></i></button>", "samples_id");
		return $this->datatables->generate();
	}

	public function simpan($data)
	{
		return $this->db->insert($this->samples, $data);
	}

	public function get_data()
	{
		return $this->db->where($this->samples . '.deleted', false)->where($this->samples . '.samples_id', $this->input->post('samples_id'))->get($this->samples)->row();
	}

	public function edit($data)
	{
		return $this->db->where($this->samples . '.deleted', false)->where($this->samples . '.samples_id', $this->input->post('samples_id'))->update($this->samples, $data);
	}

	public function hapus($data)
	{
		return $this->db->where($this->samples . '.samples_id', $this->input->post('samples_id'))->update($this->samples, $data);
	}

	public function options($src)
	{
		$opt = $this->db->like('samples_nama', $src, 'both')->where('deleted', FALSE)->where('samples_id!=', 1)->get($this->samples)->result();

		$data = array();
		foreach ($opt as $opt) {
			$data[] = array("id" => $opt->samples_id, "text" => $opt->samples_nama);
		}

		return $data;
	}
}
