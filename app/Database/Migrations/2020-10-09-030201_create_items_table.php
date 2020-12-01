<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
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
			'transaksi_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
			'nama_item' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'jumlah' => [
				'type' => 'FLOAT',
			],
			'satuan' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
			],
			'harga' => [
				'type' => 'INT',
				'constraint' => 11
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('transaksi_id', 'transaksi_masuk', 'id', 'cascade', 'cascade');
		$this->forge->createTable('items');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('items');
	}
}
