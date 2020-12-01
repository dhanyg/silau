<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	/** Validation for role table */
	public $roleRules = [
		'name' => [
			'label' => 'role name',
			'rules' => 'required|regex_match[/^[a-z-]*$/]|is_unique[roles.name]',
			'errors' => [
				'required' => '{field} is required!',
				'regex_match' => '{field} must be only lowercase letter and can contain dash (-).',
				'is_unique' => '{field} already exist!'
			]
		],
		'display_name' => [
			'label' => 'display name',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		]
	];

	/** Validation for menu table */
	public $menuRules = [
		'name' => [
			'label' => 'menu name',
			'rules' => 'required|regex_match[/^[a-z-]*$/]|is_unique[menu.name]',
			'errors' => [
				'required' => '{field} is required!',
				'regex_match' => '{field} must be only lowercase letter and can contain dash (-).',
				'is_unique' => '{field} already exist!'
			]
		],
		'display_name' => [
			'label' => 'display name',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
		'type' => 'required',
	];

	/** Validation for submenu table */
	public $submenuRules = [
		'menu_id' => [
			'label' => 'menu parent',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
		'name' => [
			'label' => 'submenu name',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
		'display_name' => [
			'label' => 'display name',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
	];

	/** Validation for user table */
	public $userRules = [
		'role_id' => [
			'label' => 'role',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
		'username' => [
			'rules' => 'required|is_unique[users.username]',
			'errors' => [
				'required' => '{field} is required!',
				'is_unique' => '{field} already exist!',
			]
		],
		'display_name' => [
			'label' => 'display name',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} is required!'
			]
		],
		'password' => [
			'rules' => 'required|min_length[4]',
			'errors' => [
				'required' => '{field} is required!',
				'min_length' => '{field} minimum 4 characters!',
			]
		],
		'confirm' => [
			'label' => 'password confirm',
			'rules' => 'required|matches[password]',
			'errors' => [
				'required' => '{field} is required!',
				'matches' => '{field} doesn\'t match with password'
			]
		]
	];

	/** Validation for transaksi_masuk table */
	public $transaksiMasukRules = [
		'nama' => [
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
		'layanan_id' => [
			'label' => 'layanan',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
		'tgl_masuk' => [
			'label' => 'tgl. masuk',
			'rules' => 'required|valid_date',
			'errors' => [
				'required' => '{field} harus diisi!',
				'valid_date' => 'format {field} tidak valid!'
			]
		],
		'tgl_selesai' => [
			'label' => 'tgl. jadi',
			'rules' => 'required|valid_date',
			'errors' => [
				'required' => '{field} harus diisi!',
				'valid_date' => 'format {field} tidak valid!'
			]
		],
		'lunas' => [
			'label' => 'pembayaran',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
		'jumlah_item' => [
			'label' => 'jumlah item',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
		'total_harga' => [
			'label' => 'total harga',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
	];

	/** Validation for transaksi_pengambilan table */
	public $transaksiPengambilanRules = [
		'tgl_ambil' => [
			'label' => 'tgl. ambil',
			'rules' => 'required|valid_date',
			'errors' => [
				'required' => '{field} harus diisi!',
				'valid_date' => 'format {field} tidak valid!',
			]
		],
		'transaksi_masuk_id' => [
			'label' => 'no. transaksi',
			'rules' => 'required|numeric|is_unique[transaksi_pengambilan.transaksi_masuk_id]',
			'errors' => [
				'required' => '{field} harus diisi!',
				'numeric' => '{field} harus angka!',
				'is_unique' => '{field} sudah pernah disimpan!'
			]
		]
	];

	public $pengeluaranRules = [
		'keterangan' => [
			'label' => 'keterangan pengeluaran',
			'rules' => 'required',
			'errors' => [
				'required' => '{field} harus diisi!'
			]
		],
		'tanggal' => [
			'rules' => 'required|valid_date',
			'errors' => [
				'required' => '{field} harus diisi!',
				'valid_date' => 'format {field} tidak valid!'
			]
		],
		'jumlah' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => '{field} harus diisi!',
				'valid_date' => 'format {field} tidak valid!'
			]
		],
	];
}
