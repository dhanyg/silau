<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmenuTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment'  => true
			],
			'menu_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
			],
			'display_name' => [
				'type' => 'VARCHAR',
				'constraint' => '64',
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => true
			],
			'is_active' => [
				'type' => 'INT',
				'constraint' => 1
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('menu_id', 'menu', 'id', 'cascade', 'cascade');
		$this->forge->createTable('submenu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('submenu');
	}
}
