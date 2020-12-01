<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuRolesTable extends Migration
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
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('menu_id', 'menu', 'id', 'cascade', 'cascade');
		$this->forge->addForeignKey('role_id', 'roles', 'id', 'cascade', 'cascade');
		$this->forge->createTable('menu_roles');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('menu_roles');
	}
}
