<?php

namespace App\Controllers;

use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\Role;

class MenuAccessController extends BaseController
{
    public function __construct()
    {
        $this->Role = new Role();
        $this->Menu = new Menu();
        $this->MenuRole = new MenuRole();
    }
    public function index()
    {
        $data = [
            'title' => 'Access Management',
            'header' => 'Browse Access',
            'roles' => $this->Role->orderBy('display_name', 'ASC')->findAll(),
            'all_menu' => $this->Menu->orderBy('display_name', 'ASC')->findAll()
        ];
        return view('access/index', $data);
    }

    public function edit($roleID)
    {
        $data = [
            'title' => 'Access Management',
            'header' => 'Browse Access',
            'role' => $this->Role->find($roleID),
            'all_menu' => $this->Menu->orderBy('display_name', 'ASC')->findAll()
        ];
        return view('access/edit', $data);
    }

    public function update($roleID)
    {
        $is_exist = $this->MenuRole->where('role_id', $roleID)->findAll();
        // cek apakah ada menu_id yang dikirim
        // jika tidak,
        if (!$this->request->getPost('menu_id')) {
            // cek apakah role_id sudah ada di dalam table
            if ($is_exist) {
                // jika ada, hapus data
                $this->MenuRole->where('role_id', $roleID)->delete();

                session()->setFlashdata('success', 'Akses berhasil diubah!');
                return redirect()->to('/tools/access');
            }

            return redirect()->to('/tools/access');
        }
        // jika ada menu_id yang dikirim
        // ambil input menu_id (tersimpan dalam bentuk array)
        $menu_id = $this->request->getPost('menu_id');
        // looping array dan tambahkan ke array baru
        $array_menu = [];
        $data = [];
        foreach ($menu_id as $key => $m_id) {
            $array_menu['menu_id'] = $m_id;
            $array_menu['role_id'] = $roleID;
            $data[] = $array_menu;
        }
        // cek apakah role_id sudah ada di dalam table
        if ($is_exist) {
            // jika ada, hapus data
            $this->MenuRole->where('role_id', $roleID)->delete();
        }
        // insert batch access baru
        $this->MenuRole->insertBatch($data);

        session()->setFlashdata('success', 'Akses berhasil diubah!');
        return redirect()->to('/tools/access');
    }
    //--------------------------------------------------------------------

}
