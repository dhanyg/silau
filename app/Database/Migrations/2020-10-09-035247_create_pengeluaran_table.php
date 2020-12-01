<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengeluaranTable extends Migration
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
			'tanggal' => [
				'type' => 'DATE',
			],
			'keterangan' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'jumlah' => [
				'type' => 'INT',
				'constraint' => 11
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('pengeluaran');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pengeluaran');
	}
}
