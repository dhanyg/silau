<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LaundrySeeder extends Seeder
{
	public function run()
	{
		// roles table
		$roles = [
			[
				'id' => 1,
				'name' => 'administrator',
				'display_name' => 'Administrator'
			],
			[
				'id' => 2,
				'name' => 'user',
				'display_name' => 'User'
			],
			[
				'id' => 3,
				'name' => 'owner',
				'display_name' => 'Owner'
			],
		];
		$this->db->table('roles')->insertBatch($roles);

		// users table
		$users = [
			[
				'role_id' => 1,
				'username' => 'admin',
				'display_name' => 'Admin OOPS',
				'password' => password_hash('letmein123', PASSWORD_DEFAULT),
				'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
				'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
			],
			[
				'role_id' => 2,
				'username' => 'op',
				'display_name' => 'OP',
				'password' => password_hash('letmein', PASSWORD_DEFAULT),
				'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
				'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
			],
			[
				'role_id' => 3,
				'username' => 'oops',
				'display_name' => 'Owner OOPS',
				'password' => password_hash('letmein', PASSWORD_DEFAULT),
				'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
				'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
			],
		];
		$this->db->table('users')->insertBatch($users);

		// menu table
		$menus = [
			[
				'id' => 1,
				'name' => 'dashboard',
				'display_name' => 'Dashboard',
				'type' => 'static',
				'url' => 'dashboard',
				'icon' => 'fas fa-fw fa-home',
				'is_active' => 1
			],
			[
				'id' => 2,
				'name' => 'roles',
				'display_name' => 'Roles',
				'type' => 'static',
				'url' => 'roles',
				'icon' => 'fas fa-fw fa-user-tag',
				'is_active' => 1
			],
			[
				'id' => 3,
				'name' => 'tools',
				'display_name' => 'Tools',
				'type' => 'dynamic',
				'url' => null,
				'icon' => 'fas fa-fw fa-cogs',
				'is_active' => 1
			],
			[
				'id' => 4,
				'name' => 'users',
				'display_name' => 'Users',
				'type' => 'static',
				'url' => 'users',
				'icon' => 'fas fa-fw fa-users',
				'is_active' => 1
			],
			[
				'id' => 5,
				'name' => 'transactions',
				'display_name' => 'Transactions',
				'type' => 'dynamic',
				'url' => null,
				'icon' => 'fas fa-fw fa-tasks',
				'is_active' => 1
			],
			[
				'id' => 6,
				'name' => 'cash-flow',
				'display_name' => 'Cash Flow',
				'type' => 'dynamic',
				'url' => null,
				'icon' => 'fas fa-fw fa-cash-register',
				'is_active' => 1
			],
			[
				'id' => 7,
				'name' => 'reports',
				'display_name' => 'Reports',
				'type' => 'dynamic',
				'url' => null,
				'icon' => 'fas fa-fw fa-book',
				'is_active' => 1
			],
		];
		$this->db->table('menu')->insertBatch($menus);

		// submenu table
		$submenus = [
			[
				'id' => 1,
				'menu_id' => 3,
				'name' => 'access',
				'display_name' => 'Access',
				'url' => 'tools/access',
				'is_active' => 1
			],
			[
				'id' => 2,
				'menu_id' => 3,
				'name' => 'menu',
				'display_name' => 'Menu',
				'url' => 'tools/menu',
				'is_active' => 1
			],
			[
				'id' => 3,
				'menu_id' => 3,
				'name' => 'submenu',
				'display_name' => 'Submenu',
				'url' => 'tools/submenu',
				'is_active' => 1
			],
			[
				'id' => 4,
				'menu_id' => 5,
				'name' => 'transaksi-masuk',
				'display_name' => 'Transaksi Masuk',
				'url' => 'transactions/transaksi-masuk',
				'is_active' => 1
			],
			[
				'id' => 5,
				'menu_id' => 5,
				'name' => 'transaksi-pengambilan',
				'display_name' => 'Transaksi Pengambilan',
				'url' => 'transactions/transaksi-pengambilan',
				'is_active' => 1
			],
			[
				'id' => 6,
				'menu_id' => 6,
				'name' => 'pemasukan',
				'display_name' => 'Pemasukan',
				'url' => 'cash-flow/pemasukan',
				'is_active' => 1
			],
			[
				'id' => 7,
				'menu_id' => 6,
				'name' => 'pengeluaran',
				'display_name' => 'Pengeluaran',
				'url' => 'cash-flow/pengeluaran',
				'is_active' => 1
			],
			[
				'id' => 8,
				'menu_id' => 7,
				'name' => 'report-transaksi-masuk',
				'display_name' => 'Report Transaksi Masuk',
				'url' => 'reports/transaksi-masuk',
				'is_active' => 1
			],
			[
				'id' => 9,
				'menu_id' => 7,
				'name' => 'report-transaksi-pengambilan',
				'display_name' => 'Report Transaksi Pengambilan',
				'url' => 'reports/transaksi-pengambilan',
				'is_active' => 1
			],
			[
				'id' => 10,
				'menu_id' => 7,
				'name' => 'report-pemasukan',
				'display_name' => 'Report Pemasukan',
				'url' => 'reports/pemasukan',
				'is_active' => 1
			],
			[
				'id' => 11,
				'menu_id' => 7,
				'name' => 'report-pengeluaran',
				'display_name' => 'Report Pengeluaran',
				'url' => 'reports/pengeluaran',
				'is_active' => 1
			],
		];
		$this->db->table('submenu')->insertBatch($submenus);

		// menu_roles table
		$menu_roles = [
			[
				'id' => 1,
				'menu_id' => 1,
				'role_id' => 1,
			],
			[
				'id' => 2,
				'menu_id' => 2,
				'role_id' => 1,
			],
			[
				'id' => 3,
				'menu_id' => 3,
				'role_id' => 1,
			],
			[
				'id' => 4,
				'menu_id' => 4,
				'role_id' => 1,
			],

			[
				'id' => 5,
				'menu_id' => 5,
				'role_id' => 1,
			],
			[
				'id' => 6,
				'menu_id' => 6,
				'role_id' => 1,
			],
			[
				'id' => 7,
				'menu_id' => 7,
				'role_id' => 1,
			],
			[
				'id' => 8,
				'menu_id' => 1,
				'role_id' => 2,
			],
			[
				'id' => 9,
				'menu_id' => 5,
				'role_id' => 2,
			],
			[
				'id' => 10,
				'menu_id' => 6,
				'role_id' => 2,
			],
			[
				'id' => 11,
				'menu_id' => 1,
				'role_id' => 3,
			],
			[
				'id' => 12,
				'menu_id' => 5,
				'role_id' => 3,
			],
			[
				'id' => 13,
				'menu_id' => 6,
				'role_id' => 3,
			],
			[
				'id' => 14,
				'menu_id' => 7,
				'role_id' => 3,
			],
		];
		$this->db->table('menu_roles')->insertBatch($menu_roles);

		// layanan table
		$layanan = [
			[
				'id' => 1,
				'nama' => 'cuci bersih'
			],
			[
				'id' => 2,
				'nama' => 'cuci 1 hari'
			],
			[
				'id' => 3,
				'nama' => 'cuci express'
			],
			[
				'id' => 4,
				'nama' => 'setrika'
			],
			[
				'id' => 5,
				'nama' => 'laundry'
			],
			[
				'id' => 6,
				'nama' => 'laundry 1 hari'
			],
			[
				'id' => 7,
				'nama' => 'laundry express'
			],
		];
		$this->db->table('layanan')->insertBatch($layanan);
	}
}
