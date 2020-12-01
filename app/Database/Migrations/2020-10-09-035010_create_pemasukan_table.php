<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemasukanTable extends Migration
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
			'transaksi_masuk_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
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
		$this->forge->addForeignKey('transaksi_masuk_id', 'transaksi_masuk', 'id', 'cascade', 'cascade');
		$this->forge->createTable('pemasukan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pemasukan');
	}
}
