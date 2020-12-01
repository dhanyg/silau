<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLayananTable extends Migration
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
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('layanan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('layanan');
	}
}
