<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiPengambilanTable extends Migration
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
			'tgl_ambil' => [
				'type' => 'DATE',
			],
			'user_creator' => [
				'type' => 'VARCHAR',
				'constraint' => '30'
			],
			'user_editor' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => true
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
		$this->forge->addForeignKey('transaksi_masuk_id', 'transaksi_masuk', 'id', 'cascade', 'cascade');
		$this->forge->createTable('transaksi_pengambilan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('transaksi_pengambilan');
	}
}
