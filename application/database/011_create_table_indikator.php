<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_indikator extends CI_Migration
{
	protected $table_name = "ak_data_master_indikator";
	protected $prefix = "indikator_";

	public function up()
	{
		// Generate fields
		$fields = array(
			$this->prefix . 'id' => array(
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			$this->prefix . 'kode' => array(
				'type' => 'CHAR',
				'constraint' => 20,
				'unsigned' => TRUE,
			),
			$this->prefix . 'deskripsi' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			),
			$this->prefix . 'slug' => array(
				'type' => 'CHAR',
				'constraint' => 20,
				'unsigned' => TRUE,
			),
			$this->prefix . 'color' => array(
				'type' => 'CHAR',
				'constraint' => 20,
				'unsigned' => TRUE,
			),
			$this->prefix . 'icon' => array(
				'type' => 'CHAR',
				'constraint' => 20,
				'unsigned' => TRUE,
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
				'default' => 0
			),
		);
		// Add field from above variables
		$this->dbforge->add_field($fields);
		// Assign key
		$this->dbforge->add_key($this->prefix . 'id', TRUE);
		// Create table
		$this->dbforge->create_table($this->table_name);
	}

	public function down()
	{
		$this->dbforge->drop_table($this->table_name, TRUE);
	}
}
