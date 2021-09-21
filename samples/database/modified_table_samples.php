<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Modified_table_samples extends CI_Migration
{
	protected $table_name_new = "ak_data_master_modified";
	protected $table_name_old = "ak_data_samples";
	protected $prefix_new = "modified_";
	protected $prefix_old = "samples_";

	public function up()
	{
		// Generate fields
		$fields = array(
			$this->prefix_old . 'id' => array(
				'name' => $this->prefix_new . 'id',
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			$this->prefix_old . 'deskripsi' => array(
				'name' => $this->prefix_new . 'deskripsi',
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			)
		);
		// Modifying columns
		$this->dbforge->modify_column($this->table_name_old, $fields);
		// Dropping columns
		$this->dbforge->drop_column($this->table_name_old, $this->prefix_old . 'unfaedah');
		// Renaming table
		$this->dbforge->rename_table($this->table_name_old, $this->table_name_new);
	}

	public function down()
	{
		// Restore modifyed columns
		$fields = array(
			$this->prefix_new . 'id' => array(
				'name' => $this->prefix_old . 'id',
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			$this->prefix_new . 'deskripsi' => array(
				'name' => $this->prefix_old . 'deskripsi',
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
		);
		$this->dbforge->modify_column($this->table_name_new, $fields);
		// Restore deleted columns
		$fields = array(
			$this->prefix_old . 'unfaedah' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
		);
		$this->dbforge->add_column($this->table_name_new, $fields);
		// Restore old name
		$this->dbforge->rename_table($this->table_name_new, $this->table_name_old);
	}
}
