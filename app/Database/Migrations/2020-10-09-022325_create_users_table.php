<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '64'
			],
			'display_name' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => true
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => '15',
				'null' => true
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('role_id', 'roles', 'id', 'cascade', 'cascade');
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
