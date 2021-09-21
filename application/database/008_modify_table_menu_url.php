<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Modify_table_menu_url extends CI_Migration
{
	protected $table_name = "ak_data_system_menu";
	protected $prefix = "menu_";

	private function generate_fields()
	{
		$fields = array(
			$this->prefix . 'url' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => '#',
				'null' => false,
			),
			$this->prefix . 'roles' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => '0,1',
				'null' => false,
			),
		);

		return $fields;
	}

	public function up()
	{
		// Generate fields
		$fields = $this->generate_fields();
		// Add field from above variables
		$this->dbforge->modify_column($this->table_name, $fields);
	}

	public function down()
	{
		$fields = array(
			$this->prefix . 'url' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => '',
				'null' => true
			),
			$this->prefix . 'roles' => array(
				'type' => 'VARCHAR',
				'constraint' => 128,
				'default' => '',
				'null' => true
			),
		);
		$this->dbforge->modify_column($this->table_name, $fields);
	}
}
