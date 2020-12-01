<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiMasukTable extends Migration
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
			'layanan_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
			'tgl_masuk' => [
				'type' => 'DATE',
				'null' => true,
			],
			'tgl_selesai' => [
				'type' => 'DATE',
				'null' => true,
			],
			'total_harga' => [
				'type' => 'INT',
				'constraint' => 11
			],
			'jumlah_item' => [
				'type' => 'INT',
				'constraint' => 5
			],
			'lunas' => [
				'type' => 'INT',
				'constraint' => 1
			],
			'status' => [
				'type' => 'INT',
				'constraint' => 1
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
		$this->forge->addForeignKey('layanan_id', 'layanan', 'id', 'cascade', 'cascade');
		$this->forge->createTable('transaksi_masuk');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('transaksi_masuk');
	}
}
