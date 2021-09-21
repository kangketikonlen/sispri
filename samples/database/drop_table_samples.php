<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Drop_table_samples extends CI_Migration
{
	protected $table_name = "ak_data_master_modified";
	protected $prefix = "modified_";

	public function up()
	{
		// Droping table
		$this->dbforge->drop_table($this->table_name, TRUE);
	}

	public function down()
	{
		// Generate fields
		$fields = array(
			$this->prefix . 'id' => array(
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			$this->prefix . 'deskripsi' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			$this->prefix . 'unfaedah' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			'created_by' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => 'System'
			),
			'created_date' => array(
				'type' => 'DATETIME'
			),
			'updated_by' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => NULL,
				'null' => TRUE
			),
			'updated_date' => array(
				'type' => 'DATETIME',
				'default' => NULL,
				'null' => TRUE
			),
			'deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1
			),
		);
		// Add field from above variables
		$this->dbforge->add_field($fields);
		// Assign key
		$this->dbforge->add_key($this->prefix . 'id', TRUE);
		// Create table
		$this->dbforge->create_table($this->table_name);
	}
}
