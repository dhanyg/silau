<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
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
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '64',
			],
			'display_name' => [
				'type' => 'VARCHAR',
				'constraint' => '64',
			],
			'type' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => true
			],
			'icon' => [
				'type' => 'VARCHAR',
				'constraint' => '64',
				'null' => true
			],
			'is_active' => [
				'type' => 'INT',
				'constraint' => 1,
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('menu');
	}
}
